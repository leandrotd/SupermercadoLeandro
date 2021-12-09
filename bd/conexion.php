<?php

class Conexion
{

    private static $host;
    private static $nomBBDD;
    private static $usuario;
    private static $clave;

    /**
     * Conexion con la base de datos
     *
     * @return PDO con la conexion iniciada
     */
    public static function connect()
    {
        //Lee el csv con los datos de conexion
        Conexion::leerCSV();

        //Conecta a la base de datos
        $pdo = new PDO("mysql:host=" . Conexion::$host . ";dbname=" . Conexion::$nomBBDD . ";charset=utf8", Conexion::$usuario, Conexion::$clave);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function leerCSV()
    {
        //Si no existe o no se puede leer el fichero, que termine de ejecutarse la aplicación
        if (!file_exists("bd/datosConexion.csv") || !is_readable("bd/datosConexion.csv")) {
            exit();
        }
        
        $file = fopen('bd/datosConexion.csv', 'r');

        //Leer la primera linea
        if (($data = fgetcsv($file)) != false) {
            Conexion::$host = $data[0];
            Conexion::$nomBBDD = $data[1];
            Conexion::$usuario = $data[2];
            Conexion::$clave = $data[3];
        }
    }
}
