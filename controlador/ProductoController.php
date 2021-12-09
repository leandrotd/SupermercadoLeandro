<?php

/**
 * Controlador de los Productos.
 */
class ProductoController extends BaseController
{
    /**
     * Inicializa los DAO de usuario, empleado y producto.
     */
    public function __construct()
    {
        $this->usuario = new UsuarioDAO();
        $this->empleado = new EmpleadoDAO();
        $this->producto = new ProductoDAO();
    }

    /**
     * Obtiene los detalles del producto.
     * Solo se puede acceder si el usuario es un empleado (Tipo = 0 | 1).
     *
     * @return void
     */
    public function detalles()
    {
        if (isset($_SESSION['usuario']) && ($this->getPermisos($_SESSION['usuario']) == 0 || $this->getPermisos($_SESSION['usuario']) == 1)) {
            require_once 'vista/header.view.php';
            require_once 'vista/productos/productos.detalles.view.php';
            require_once 'vista/footer.view.php';
        } else {
            header('Location:/SupermercadoLeandro/index.php/usuario/login');
        }
    }

    /**
     * Obtiene la lista de productos.
     *
     * @return void
     */
    public function lista()
    {
        require_once 'vista/header.view.php';
        require_once 'vista/productos/productos.lista.view.php';
        require_once 'vista/footer.view.php';
    }

    /**
     * Obtiene el Producto por el id especificado.
     *
     * @param numeric $id
     * @return Producto|false<b> Si tuvo exito devuelve el Producto, en caso contrario false.
     */
    public function getProducto($id)
    {
        return $this->producto->getById($id);
    }

    /**
     * Obtiene la lista de Productos.
     *
     * @return array|false<b> Si tuvo exito devuelve el array de Productos, en caso contrario false.
     */
    public function getProductos()
    {
        return $this->producto->findAll();
    }

    /**
     * Comprueba que la foto no exista y le cambia el nombre si fuese necesario y agrega el Producto
     *
     * @param Producto $producto El Producto a crear.
     * @return void
     */
    public function add($producto)
    {
        //Obtiene el nombre real de la foto o null
        $foto = $this->comprobarVacios($producto);

        //Añadir el producto a la base de datos
        $hecho = $this->producto->add($producto);

        //Si no hubo errores y existe la foto, que se suba al servidor
        if ($hecho) {
            if (isset($foto)) {
                $this->producto->subirFoto($foto);
            }
        }
    }

    /**
     * Modifica el Producto en la base de datos junto a la imagen que se agreguene.
     *
     * @param Producto $producto El Producto a modificar.
     * @return void
     */
    public function modificar($producto)
    {
        //Obtiene el nombre real de la foto o null
        $foto = $this->comprobarVacios($producto);

        //Modifica el producto de la base de datos
        $hecho = $this->producto->update($producto);

        //Si no hubo errores y existe la foto, que se suba al servidor
        if ($hecho) {
            if (isset($foto)) {
                $this->producto->subirFoto($foto);
            }
        }
    }

    /**
     * Borra el producto según el id especificado y la imagen asociada.
     *
     * @param numeric $id El Id del producto a borrar.
     * @return void
     */
    public function borrar($id)
    {
        $producto = $this->getProducto($id);

        //Si el producto buscado existe, lo borra y si no hay error al borrarlo, la imagen también
        if (gettype($producto) == 'object') {
            if ($this->producto->delete($producto->getNumProd())) {
                $this->borrarFoto($producto->getFoto());
            }
        }
    }

    /**
     * Comprueba que la foto no exista en el servidor y si existe le cambia el nombre.
     *
     * @param string $carpetaDestino La carpeta donde estan las imagenes guardadas.
     * @param string $name Nombre de la imagen.
     * @return string Nombre de la imagen final.
     */
    public function comprobarFoto($carpetaDestino, $name)
    {
        $imagen = basename($name);
        $i = 0;

        //Comprueba que la imagen no exista en el servidor y si existe le escribe un numero identificativo delante y vuelve a comprobar
        while (file_exists($carpetaDestino . $imagen)) {
            $imagen = $i++ . basename($name);
        }
        return $imagen;
    }

    /**
     * Realiza las validaciones oportunas del producto.
     *
     * @param array $respuesta Contiene los datos del Producto
     * @param array $archivos Es la variable $_FILES en la que esta la foto a introducir.
     * @return array Array con los errores que puedan haberse hecho o un array vacio.
     */
    public function validarCampos($respuesta, $archivos)
    {
        $errores = array();

        if (strlen($respuesta['nombre']) > 50) {
            $errores['nombre'] = "El nombre es muy largo";
        }

        if (strlen($respuesta['precio']) > UNSIGNED_INT_MAX) {
            $errores['precio'] = "El precio es muy grande";
        }

        if (strlen($respuesta['cantidad']) > UNSIGNED_INT_MAX) {
            $errores['cantidad'] = "La cantidad es muy grande";
        }

        //Comprueba que el archivo enviado sea un jpg, jpeg o png
        if ($archivos["foto"]["tmp_name"] != '') {
            $archivo = "/SupermercadoLeandro/public/assets/images/" .  $archivos["foto"]["name"];
            $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

            if ($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
                $errores['foto'] = "Solo se admiten jpg, jpeg y png";
            }
        }

        return $errores;
    }

    /**
     * Comprueba si el nombre de la foto está vacío, introduzca null en la base de datos, o que cambie el nombre de la foto a la nueva seleccionada.
     *
     * @param Producto $producto Producto el cual tiene el array de $_FILES.
     * @return string|null String con el nombre de la foto o null si no hay.
     */
    public function comprobarVacios($producto)
    {
        $foto = null;

        if (gettype($producto->getFoto()) == "array") {
            //Si el nombre de la imagen esta vacío, establece un null en la foto del producto
            if ($producto->getFoto()['name'] == '') {
                $producto->setFoto(null);
            } else {
                $foto = $producto->getFoto();
                $producto->setFoto($producto->getFoto()['name']);
            }
        }
        return $foto;
    }

    /**
     * Borra la foto
     *
     * @param string $foto Nombre de la foto a borrar.
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function borrarFoto($foto)
    {
        return $this->producto->borrarFoto($foto);
    }

    /**
     * Actualiza la cantida especificada del producto elegido.
     *
     * @param Producto $producto Producto con la cantidad a restar del total
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function actualizarCantidad($producto)
    {
        return $this->producto->borrarCantidad($producto->getNumProd(), $producto->getCantidad());
    }
}
