<?php

/**
 * Controlador de los Empleados
 */
class EmpleadoController extends BaseController
{

    /**
     * Inicializa los DAO de usuario y empleado
     */
    public function __construct()
    {
        $this->usuario = new UsuarioDAO();
        $this->empleado = new EmpleadoDAO();
    }
    
    /**
     * Obtiene la lista de usuarios diferenciados entre clientes y empleados.
     * Solo se puede acceder si el usuario tiene iniciada la sesion como administrador.
     *
     * @return void
     */
    public function lista()
    {
        //Comprueba si la sesion está iniciada y si es administrador
        if (isset($_SESSION['usuario']) && $this->getPermisos($_SESSION['usuario']) == 0) {
            require_once 'vista/header.view.php';
            require_once 'vista/usuarios/usuarios.lista.view.php';
            require_once 'vista/footer.view.php';
        } else {
            header('Location:/SupermercadoLeandro/index.php/usuario/login');
        }
    }

    /**
     * Agrega un empleado a la base de datos.
     *
     * @param Empleado $empleado
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function addEmpleado($empleado)
    {
        return $this->empleado->add($empleado);
    }

    /**
     * Obtiene la lista de empleados en la base de datos.
     *
     * @return array|false<b> Si tuvo exito devuelve el array con los datos, en caso contrario false.
     */
    public function getEmpleados()
    {
        return $this->empleado->findAll();
    }

    /**
     * Obtiene la lista de clientes en la base de datos.
     *
     * @return array|false<b> Si tuvo exito devuelve el array con los datos, en caso contrario false.
     */
    public function getClientes()
    {
        return $this->empleado->getClientes();
    }

    /**
     * Obtiene el empleado especificado en el id.
     *
     * @param numeric $id
     * @return Empleado|false<b> Si tuvo exito devuelve el objeto Empleado sin los datos de cliente, en caso contrario false.
     */
    public function getEmpleado($id)
    {
        return $this->empleado->getById($id);
    }

    /**
     * Obtiene la cantidad de Administradores (Tipo = 0) que existe en la base de datos.
     *
     * @return numeric|false<b> Si tuvo exito devuelve la cantidad, en caso contrario false.
     */
    public function getCantidadAdmins()
    {
        return $this->empleado->getCantidadAdmins();
    }

    /**
     * Recibe un objeto Empleado y comprueba que existe en la base de datos.
     * Si existe lo modifica.
     * Si no existe crea una fila nueva.
     *
     * @param Empleado $empleado
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function updateEmpleado($empleado)
    {
        //Comprueba si el usuario esta en la tabla Empleado
        if (gettype($this->getEmpleado($empleado->getIdUsuario())) == 'object') {
            //Comprueba si hubo errores al aplicar el update
            if (!$this->empleado->update($empleado)) {
                return false;
            }
        } else {
            //Comprueba si hubo errores al aplicar el create
            if (!$this->addEmpleado($empleado)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Borra el empleado con el id especificado.
     *
     * @param numeric $id
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function deleteEmpleado($id)
    {
        return $this->empleado->delete($id);
    }

    /**
     * Comprueba si el Usuario especificado se encuetra en la tabla de Empleados.
     * Si cumple las condiciones para ser borrado, lo hará.
     *
     * @param Usuario|Empleado $usuario
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function borrarSiEraEmpleado($usuario)
    {
        //Comprueba si está en la tabla de Empleados y si el usuario con la sesión iniciada es administrador
        if (gettype($this->getEmpleado($usuario->getIdUsuario())) == 'object' && $this->getPermisos($_SESSION['usuario']) == 0) {
            //Comprueba que la cantidad de administradores en la base de datos sea mayor o igual a 1 si se pretende borrar uno de ellos
            if ($usuario->getTipo() == 1 || ($usuario->getTipo() == 0 && $this->getCantidadAdmins() > 1)) {
                return $this->deleteEmpleado($usuario->getIdUsuario());
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Borra el usuario especificado.
     *
     * @param numeric $id
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function borrarUsuario($id)
    {
        return $this->usuario->delete($id);
    }

    /**
     * Valida si los datos del empleado son correctos.
     *
     * @param array $respuesta Contiene los datos del empleado y datos extra si procede.
     * @param Usuario $usuario Usuario con el que se ha iniciado sesion.
     * @param boolean $modificacion Comprueba si la acción para validar es de crear usuario o modificar
     * @return array Si tuvo algún tipo de error en las comprobaciones se especificará aqui, en caso contrario devolverá un array vacío.
     */
    public function validarEmpleado($respuesta, $usuario, $modificacion = false)
    {
        $errores = array();

        if (strlen($respuesta['dni']) > 9) {
            $errores['dni'] = "El DNI es muy largo";
        } else {
            if (($temp = $this->empleado->getByDni($respuesta['dni']))) {
                if ($modificacion) {
                    if (!isset($respuesta['id']) && $temp->getIdUsuario() != $usuario->getIdUsuario()) {
                        $errores['dni'] = "El DNI ya esta en uso";
                    }
                } else {
                    $errores['dni'] = "El DNI ya esta en uso";
                }
            } else {
                if (!preg_match("/^(\d{8})([A-Z])$/", $respuesta['dni'])) {
                    $errores['dni'] = "El DNI es incorrecto";
                }
            }
        }

        if (strlen($respuesta['cargo']) > 9) {
            $errores['cargo'] = "El cargo es muy largo";
        }

        if ($respuesta['sueldo'] < 0) {
            $errores['sueldo'] = "El sueldo no puede ser menor de 0";
        }

        return $errores;
    }
}
