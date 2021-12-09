<?php

//Parametros de conexion a la base de datos
define('HOST', 'localhost');
define('NOMBBDD', 'supermercado');
define('USUARIO', 'root');
define('CLAVE', '');

class Conexion
{
    /**
     * Conexion con la base de datos
     *
     * @return PDO con la conexion iniciada
     */
    public static function connect()
    {
        $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . NOMBBDD . ";charset=utf8", USUARIO, CLAVE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
