<?php

/**
 * Controlador de las Facturas.
 */
class FacturaController extends BaseController
{

  /**
   * Usado para llamar a métodos del controlador de productos.
   *
   * @var ProductoController
   */
  protected $controllerProductos;

  /**
   * Inicializa los DAO de usuario, empleado, factura y producto y el controlador de productos.
   */
  public function __construct()
  {
    $this->usuario = new UsuarioDAO();
    $this->empleado = new EmpleadoDAO();
    $this->factura = new FacturaDAO();
    $this->producto = new ProductoDAO();
    //Es necesario para las llamadas a operaciones que se encuentran en ek controlador de Productos
    $this->controllerProductos = new ProductoController();
  }

  /**
   * Obtiene los detalles del carrito de la compra.
   * Solo se puede acceder si el usuario es un cliente (Tipo = -1).
   *
   * @return void
   */
  public function detalles()
  {
    if (isset($_SESSION['usuario']) && $this->getPermisos($_SESSION['usuario']) != 0 && $this->getPermisos($_SESSION['usuario']) != 1) {
      require_once 'vista/header.view.php';
      require_once 'vista/factura/factura.detalles.view.php';
      require_once 'vista/footer.view.php';
    } else {
      header('Location:/SupermercadoLeandro/index.php/producto/lista');
    }
  }

  /**
   * Obtiene la página de fin de la compra con el codigo de factura.
   * Solo se puede acceder si el usuario es un cliente (Tipo = -1).
   *
   * @return void
   */
  public function fin()
  {
    if (isset($_SESSION['usuario']) && $this->getPermisos($_SESSION['usuario']) != 0 && $this->getPermisos($_SESSION['usuario']) != 1) {
      require_once 'vista/header.view.php';
      require_once 'vista/factura/factura.fin.view.php';
      require_once 'vista/footer.view.php';
    } else {
      header('Location:/SupermercadoLeandro/index.php/producto/lista');
    }
  }

  /**
   * Obtiene los productos que se encuentran actualmente en la cookie de la lista.
   *
   * @param string $lista La cookie de la lista.
   * @return array Un array con formato [producto1, cantidad1, producto2, cantidad2, ...].
   */
  public function obtenerProductos($lista)
  {
    //Darle formato al parametro lista para que sea un array
    $lista = explode(",", str_replace(array('[', ']'), '', $lista));
    $prod = null;
    $array = array();

    //Transformar el array $lista para que por cada uno de los id de productos que tenga sean objetos Producto
    for ($i = 0; $i < count($lista); $i = $i + 2) {
      if (!($i % 2)) {
        if (gettype($prod = $this->producto->getById($lista[$i])) != 'boolean') {
          //En la primera posicion se escribe el producto con la cantidad máxima de la base de datos 
          //y en la segunda posicion la cantidad establecida por el usuario.
          $array[] = $prod;
          $array[] = $lista[$i + 1];
        }
      }
    }
    return $array;
  }

  /**
   * Comprueba que las cantidades de los productos de la lista no superen la cantidad maxima de la base de datos.
   *
   * @param array $lista El array con los datos de los productos con el formato de la funcion obtenerProductos($lista).
   * @return array Un array con la lista de productos con las cantidades de la cookie y un bool indicando si hubo algun cambio en las cantidades.
   */
  public function comprobarCantidades($lista)
  {
    $carrito = array();
    $cambios = false;

    //Va agregando al array $carrito todos los productos con la cantidad establecida
    for ($i = 0; $i < count($lista); $i = $i + 2) {
      $producto = $lista[$i];

      //Si la cantidad establecida por el usuario es mayor a la existente acutualmente, escribe la cantidad máxima posible
      if ($producto->getCantidad() > $lista[$i + 1]) {
        $producto->setCantidad($lista[$i + 1]);
      } else if ($producto->getCantidad() < $lista[$i + 1]) {
        //Si se realiza un cambio en las cantidades se cambia $cambios a true para indicarle esto al usuario
        $cambios = true;
      }

      $carrito[] = $producto;
    }

    return array($carrito, $cambios);
  }

  /**
   * Crea una factura con todos los ItemFactura que vaya a llevar, además de actualizar las cantidades de los productos que se compren.
   *
   * @param array $carrito Array que contiene todos los Productos que se vayan a comprar con la cantidad actualizada.
   * @param numeric $idUsuario El Id del usuario que compra.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function crearFactura($carrito, $idUsuario)
  {
    //Agrega una factura nueva
    if ($this->factura->add($idUsuario)) {

      //Obtiene la factura creada actualmente
      $factura = $this->factura->getFacturaNueva($idUsuario);
      $error = false;

      foreach ($carrito as $producto) {
        //Reduce la cantidad de productos en el inventario y lo añade a la factura
        if ($this->controllerProductos->actualizarCantidad($producto)) {
          if (!$this->factura->addItem($factura->getNumFactura(), $producto)) {
            $error = true;
            return;
          }
        } else {
          $error = true;
          return;
        }
      }

      //Indica si hubo algun error en la operacion
      if ($error) {
        return false;
      }

      //Borra la lista de la compra en el cliente
      if (isset($_COOKIE['carrito'])) {
        unset($_COOKIE['carrito']);
        setcookie('carrito', null, -1, '/');
      }

      return $factura->getNumFactura();
    }
    return false;
  }
}
