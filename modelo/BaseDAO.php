<?php

/**
 * Clase abstracta de los DAO
 */
abstract class BaseDAO
{

    protected $pdo;

    /**
     * Conexion con la base de datos.
     */
    public function __construct()
    {
        try {
            $this->pdo = Conexion::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public abstract function add($obj);

    public abstract function findAll();

    public abstract function getById($id);

    public abstract function update($obj);

    public abstract function delete($id);
}
