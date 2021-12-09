<?php

/**
 * DataAccessObject de Empleado
 */
class EmpleadoDAO extends BaseDAO
{

  /**
   * Agregar Empleado.
   *
   * @param Empleado $empleado Empleado a añadir.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function add($empleado)
  {
    try {
      $sql = "INSERT INTO empleados (IdUsuario, DNI, Cargo, Tipo, Sueldo) 
		        VALUES (?, ?, ?, ?, ?)";

      $this->pdo->prepare($sql)
        ->execute(
          array(
            $empleado->getIdUsuario(),
            $empleado->getDNI(),
            $empleado->getCargo(),
            $empleado->getTipo(),
            $empleado->getSueldo()
          )
        );
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Select de todos los empleados.
   *
   * @return array|false<b> Si tuvo exito devuelve el array con los empleados, en caso contrario false.
   */
  public function findAll()
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT usuarios.IdUsuario, usuarios.Nombre, usuarios.Email, usuarios.Contrasena, usuarios.Apellidos, usuarios.Direccion, usuarios.Telefono, empleados.DNI, empleados.Cargo, empleados.Tipo, empleados.Sueldo 
                    FROM usuarios JOIN empleados
                    ON usuarios.IdUsuario = empleados.IdUsuario");
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_CLASS, 'Empleado');
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Select del empleado especificado.
   *
   * @param numeric $id Id del empleado a buscar.
   * @return Empleado|false<b> Si tuvo exito devuelve el empleado, en caso contrario false.
   */
  public function getById($id)
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT * FROM empleados WHERE IdUsuario = ?");

      $stm->execute(array($id));
      return $stm->fetchObject("Empleado");
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Select del empleado especificado.
   *
   * @param string $dni DNI del empleado a buscar.
   * @return Empleado|false<b> Si tuvo exito devuelve el empleado, en caso contrario false.
   */
  public function getByDni($dni)
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT * FROM empleados WHERE dni = ?");

      $stm->execute(array($dni));
      return $stm->fetchObject("Empleado");
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Select de todos los admins.
   *
   * @return array|false<b> Si tuvo exito devuelve el array con los empleados, en caso contrario false.
   */
  public function getCantidadAdmins()
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT count(*)
                    FROM empleados
                    WHERE Tipo = 0");
      $stm->execute();

      return $stm->fetchColumn();
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Select de todos los clientes.
   *
   * @return array|false<b> Si tuvo exito devuelve el array con los empleados, en caso contrario false.
   */
  public function getClientes()
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT * FROM usuarios WHERE IdUsuario NOT IN (SELECT IdUsuario FROM empleados)");
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Modificar Empleado.
   *
   * @param Empleado $empleado Empleado a moodificar.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function update($empleado)
  {
    try {
      $sql = "UPDATE empleados SET 
						DNI = ?, 
						Cargo = ?,
            Tipo = ?,
						Sueldo = ?
				    WHERE IdUsuario = ?";

      $this->pdo->prepare($sql)
        ->execute(
          array(
            $empleado->getDNI(),
            $empleado->getCargo(),
            $empleado->getTipo(),
            $empleado->getSueldo(),
            $empleado->getIdUsuario()
          )
        );
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Borrar Empleado.
   *
   * @param numeric $id Id del empleado a borrar.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function delete($id)
  {
    try {
      $stm = $this->pdo
        ->prepare("DELETE FROM empleados WHERE IdUsuario = ?");

      $stm->execute(array($id));
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
}
