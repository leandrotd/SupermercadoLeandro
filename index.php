<?php

//Inicio de la autocarga
require "app/autoloader.php";

//Registrar el método de autoloader.php como tal
spl_autoload_register("autoloader");

//Carga del front controller
require "app/frontcontroller.php";
