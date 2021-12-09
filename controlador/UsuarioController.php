<?php

/**
 * Controlador de los Usuarios.
 */
class UsuarioController extends BaseController
{

    /**
     * Usado para llamar a métodos del controlador de empleados.
     *
     * @var EmpleadoController
     */
    protected $controllerEmpleado;

    /**
     * Inicializa los DAO de usuario y empleado y el controlador de empleados.
     */
    public function __construct()
    {
        $this->usuario = new UsuarioDAO();
        $this->empleado = new EmpleadoDAO();
        //Necesario para llamar a funciones del controlador de empleados
        $this->controllerEmpleado = new EmpleadoController();
    }

    /**
     * Obtiene los detalles del usuario actual.
     * Solo si se ha especificado el email por $_GET y si es administrador o el usuario actual es el mismo a visualizar.
     *
     * @return void
     */
    public function detalles()
    {
        if (isset($_SESSION['usuario'])) {
            require_once 'vista/header.view.php';
            require_once 'vista/usuarios/usuarios.detalles.view.php';
            require_once 'vista/footer.view.php';
        } else {
            header('Location:/SupermercadoLeandro/index.php/usuario/login');
        }
    }

    /**
     * Obtiene el formulario de inicio de sesion.
     *
     * @return void
     */
    public function login()
    {
        if (isset($_SESSION['usuario'])) {
            header('Location:/SupermercadoLeandro/index.php/producto/lista');
        } else {
            require_once 'vista/header.view.php';
            require_once 'vista/usuarios/usuarios.login.view.php';
            require_once 'vista/footer.view.php';
        }
    }

    /**
     * Obtiene el formulario de modificacion de usuario.
     * Si el usuario no tiene el permiso de administrador (Tipo = 0) o esta modificando su propio usuario.
     *
     * @return void
     */
    public function modificacion()
    {
        if (isset($_SESSION['usuario'])) {
            if ($this->getPermisos($_SESSION['usuario']) == 0 || $this->getUsuario($_SESSION['usuario'])->getEmail() == $_GET['email']) {
                require_once 'vista/header.view.php';
                require_once 'vista/usuarios/usuarios.modificacion.view.php';
                require_once 'vista/footer.view.php';
            } else {
                header('Location:/SupermercadoLeandro/index.php/producto/lista');
            }
        } else {
            header('Location:/SupermercadoLeandro/index.php/usuario/login');
        }
    }

    /**
     * Obtiene el formulario de registro.
     * Solo se podrá acceder si no hay una sesión iniciada o es administrador.
     *
     * @return void
     */
    public function registro()
    {
        if (!isset($_SESSION['usuario']) || $this->getPermisos($_SESSION['usuario']) == 0) {
            require_once 'vista/header.view.php';
            require_once 'vista/usuarios/usuarios.registro.view.php';
            require_once 'vista/footer.view.php';
        } else {
            header('Location:/SupermercadoLeandro/index.php/usuario/login');
        }
    }

    /**
     * Establece la variable $_SESSION['usuario'] con el id si se ha podido autenticar al usuario.
     *
     * @param string $correo El correo con el que inicia sesion.
     * @param string $contrasena La contraseña con la que inicia sesion.
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function iniciarSesion($correo, $contrasena)
    {
        $usuario = $this->usuario->getByEmail($correo);

        //Encripta la contraseña dada para comparar a la de la base de datos
        if ($usuario && password_verify($contrasena, $usuario->getContrasena())) {
            $_SESSION['usuario'] = $usuario->getIdUsuario();
            //Vacía la cookie del carrito por si habia otra de un usuario anterior
            if (isset($_COOKIE['carrito'])) {
                unset($_COOKIE['carrito']);
                setcookie('carrito', null, -1, '/');
            }
            return true;
        }
        return false;
    }

    /**
     * Comprueba la si contraseña es correcta con el correo especificado.
     *
     * @param string $correo Correo del que se obtiene el usuario.
     * @param string $contrasena Contraseña a comprobar.
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function comprobarContrasena($correo, $contrasena)
    {
        $usuario = $this->usuario->getByEmail($correo);
        //Encripta la contraseña dada para comparar a la de la base de datos
        return ($usuario && password_verify($contrasena, $usuario->getContrasena()));
    }

    /**
     * Obtiene el usuario especificado por el id.
     *
     * @param numeric $id Id del usuario.
     * @return Usuario|false<b> Si tuvo exito devuelve el usuario, en caso contrario false.
     */
    public function getUsuario($id)
    {
        return $this->usuario->getById($id);
    }

    /**
     * Obtiene el usuario especificado por el email.
     *
     * @param string $email El email del usuario.
     * @return Usuario|false<b> Si tuvo exito devuelve el usuario, en caso contrario false.
     */
    public function getUsuarioEmail($email)
    {
        return $this->usuario->getByEmail($email);
    }

    /**
     * Llama a la función de getEmpleado del controlador de Empleados.
     *
     * @param numeric $id
     * @return Empleado|false<b> Si tuvo exito devuelve el empleado, en caso contrario false.
     */
    public function getEmpleado($id)
    {
        return $this->controllerEmpleado->getEmpleado($id);
    }

    /**
     * Añade el usuario especificado.
     *
     * @param Usuario $usuario El usuario a añadir.
     * @return void
     */
    public function addUsuario($usuario)
    {
        //Codifica la contraseña
        $usuario->setContrasena(password_hash($usuario->getContrasena(), PASSWORD_DEFAULT, ['cost' => 12]));

        $this->usuario->add($usuario);
    }

    /**
     * Si el usuario a añadir era un empleado, lo añade a la base de datos, obtiene el id y lo añade a la tabla Empleados.
     *
     * @param Empleado $empleado El Empleado a añadir.
     * @return void
     */
    public function addEmpleado($empleado)
    {
        //Codifica la contraseña
        $empleado->setContrasena(password_hash($empleado->getContrasena(), PASSWORD_DEFAULT, ['cost' => 12]));

        if ($this->usuario->add($empleado)) {
            //Obtiene el id del usuario recien creado
            $id = ($this->usuario->getByEmail($empleado->getEmail()))->getIdUsuario();
            $empleado->setIdUsuario($id);
            $this->controllerEmpleado->addEmpleado($empleado);
        }
    }

    /**
     * Modifica el usuario y si anteriormente era un empleado, lo borra de la base de datos.
     *
     * @param Usuario $usuario El Usuario a modificar.
     * @param bool $contrasenaCambiada Indica si la contraseña ha sido cambiada.
     * @return void
     */
    public function updateUsuario($usuario, $contrasenaCambiada)
    {
        if ($contrasenaCambiada) {
        }

        $this->usuario->update($usuario);
        $this->controllerEmpleado->borrarSiEraEmpleado($usuario);
    }

    /**
     * Modifica el empleado. 
     * Si el empleado es quitado de administradores, comprueba si la cantidad de ellos sea como minimo 1 antes de modificar, en caso contrario, no lo modifica.
     *
     * @param Empleado $usuario El Empleado a modificar.
     * @param bool $contrasenaCambiada Indica si la contraseña ha sido cambiada.
     * @return void
     */
    public function updateEmpleado($usuario, $contrasenaCambiada)
    {
        //Solo realiza cambios en los datos de usuario (nombre, email,etc.) si coincide el usuario que ha iniciado sesión con el modificado
        if ($_SESSION['usuario'] == $usuario->getIdUsuario()) {
            if ($contrasenaCambiada) {
                $usuario->setContrasena(password_hash($usuario->getContrasena(), PASSWORD_DEFAULT, ['cost' => 12]));
            }
            $this->usuario->update($usuario);

            //Realiza la comprobación de los administradores
            if (($usuario->getTipo() == 1 && $this->controllerEmpleado->getCantidadAdmins() == 1)) {
                $usuario->setTipo(0);
            }
        }
        $this->controllerEmpleado->updateEmpleado($usuario);
    }

    /**
     * Validación de campos del usuario.
     *
     * @param array $respuesta Array con los valores del usuario y algunas variables extra.
     * @param boolean $update Indicativo de la operacion a realizar. Si es create = false y si es update = true.
     * @return array Devuelve un array con los errores cometidos o un array vacío si no hay.
     */
    public function validarCampos($respuesta, $update = false)
    {
        $errores = array();

        if (!filter_var($respuesta['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "La dirección de correo no es válida";
        } else {
            if (strlen($respuesta['email']) > 150) {
                $errores['email'] = "La dirección de correo es muy larga";
            } else {
                //Si existe el email en la base de datos
                if (($temp = $this->usuario->getByEmail($respuesta['email']))) {
                    //Si se está realizando una operación de update
                    if ($update) {
                        //Si el usuario modificado no es el mismo que tiene iniciada sesion
                        if ($temp->getIdUsuario() != $respuesta['id']) {
                            $errores['email'] = "La dirección de correo ya esta en uso";
                        }
                    } else {
                        $errores['email'] = "La dirección de correo ya esta en uso";
                    }
                }
            }
        }

        if (strlen($respuesta['nombre']) > 100) {
            $errores['nombre'] = "El nombre es muy largo";
        }

        if (strlen($respuesta['apellidos']) > 100) {
            $errores['apellidos'] = "Los apellidos son muy largos";
        }

        if (strlen($respuesta['direccion']) > 256) {
            $errores['direccion'] = "La direccion es muy larga";
        }

        if (!is_numeric($respuesta['telefono']) && $respuesta['telefono'] > UNSIGNED_INT_MAX) {
            $errores['telefono'] = "El telefono no es válido";
        }

        //Si es una operacion de modificacion y se está modificando la contraseña
        if (isset($respuesta['check'])) {
            if (!$this->comprobarContrasena($respuesta['email'], $respuesta['contrasena1'])) {
                $errores['contrasena1'] = "La contraseña es incorrecta";
            }

            if (!preg_match("/^(?=.*[a-z]|.*[A-Z])(?=.*\d)[a-zA-Z\d\w\W]{8,}$/", $respuesta['contrasena2'])) {
                $errores['contrasena2'] = "La contraseña debe tener al menos 8 caracteres, una letra y un numero";
            } else {
                if ($respuesta['contrasena2'] != $respuesta['contrasena3']) {
                    $errores['contrasena3'] = "La contraseñas no coinciden";
                }
            }
            //O si es una operación de create o modificación sin cambiar contraseña
        } else {
            //Si es una operación de create
            if (!$update) {
                if (!preg_match("/^(?=.*[a-z]|.*[A-Z])(?=.*\d)[a-zA-Z\d\w\W]{8,}$/", $respuesta['contrasena1'])) {
                    $errores['contrasena1'] = "La contraseña debe tener al menos 8 caracteres, una letra y un numero";
                } else {
                    if ($respuesta['contrasena1'] != $respuesta['contrasena2']) {
                        $errores['contrasena2'] = "La contraseñas no coinciden";
                    }
                }
            }
        }

        return $errores;
    }

    /**
     * Realiza la comprobación del empleado a crear o modificar.
     *
     * @param array $respuesta Array con los valores del usuario y algunas variables extra. 
     * @param Usuario $usuario Usuario con el que se ha iniciado sesion.
     * @param boolean $modificacion Indicativo de la operacion a realizar. Si es create = false y si es update = true.
     * @return array Un array con los errores cometidos o un array vacío.
     */
    public function validarEmpleado($respuesta, $usuario = null, $modificacion = false)
    {
        $erroresUsu = array();
        //Comprueba si el usuario a modificar es el mismo que tiene iniciada sesión
        if (isset($respuesta['id'])) {
            $erroresUsu = $this->validarCampos($respuesta, $modificacion);
        }

        $erroresEmp = $this->controllerEmpleado->validarEmpleado($respuesta, $usuario, $modificacion);

        return array_merge($erroresUsu, $erroresEmp);
    }
}
