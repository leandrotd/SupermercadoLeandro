<?php

/**
 * DataAccessObject de Usuario
 */
class UsuarioDAO extends BaseDAO
{

  /**
   * Agregar Usuario.
   *
   * @param Usuario $usuario Usuario a añadir.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function add($usuario)
  {
    try {
      $sql = "INSERT INTO usuarios (Nombre, Email, Contrasena, Apellidos, Direccion, Telefono) 
		        VALUES (?, ?, ?, ?, ?, ?)";

      $this->pdo->prepare($sql)
        ->execute(
          array(
            $usuario->getNombre(),
            $usuario->getEmail(),
            $usuario->getContrasena(),
            $usuario->getApellidos(),
            $usuario->getDireccion(),
            ($usuario->getTelefono() == '') ? null : $usuario->getTelefono()
          )
        );
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Select de todos los usuarios.
   *
   * @return array|false<b> Si tuvo exito devuelve el array con los usuarios, en caso contrario false.
   */
  public function findAll()
  {
    try {

      $stm = $this->pdo->prepare("SELECT * FROM usuarios");
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Select del usuario especificado.
   *
   * @param numeric $id Id del usuario a buscar.
   * @return Usuario|false<b> Si tuvo exito devuelve el usuario, en caso contrario false.
   */
  public function getById($id)
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT * FROM usuarios WHERE IdUsuario = ?");

      $stm->execute(array($id));
      return $stm->fetchObject("Usuario");
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * * Select del usuario especificado.
   *
   * @param string $email Email del usuario a buscar.
   * @return Usuario|false<b> Si tuvo exito devuelve el usuario, en caso contrario false.
   */
  public function getByEmail($email)
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT * FROM usuarios WHERE email = ?");

      $stm->execute(array($email));
      return $stm->fetchObject("Usuario");
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Modificar Usuario.
   *
   * @param Usuario $usuario Usuario a moodificar.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function update($usuario)
  {
    try {
      $sql = "UPDATE usuarios SET 
						Nombre = ?, 
						Email = ?,
            Contrasena = ?,
						Apellidos = ?, 
						Direccion = ?,
						Telefono = ?
				    WHERE IdUsuario = ?";

      $this->pdo->prepare($sql)
        ->execute(
          array(
            $usuario->getNombre(),
            $usuario->getEmail(),
            $usuario->getContrasena(),
            $usuario->getApellidos(),
            $usuario->getDireccion(),
            ($usuario->getTelefono() == '') ? null : $usuario->getTelefono(),
            $usuario->getIdUsuario()
          )
        );
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Borrar Usuario.
   *
   * @param numeric $id Id del usuario a borrar.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function delete($id)
  {
    try {
      $stm = $this->pdo
        ->prepare("DELETE FROM usuarios WHERE IdUsuario = ?");

      $stm->execute(array($id));
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

}
