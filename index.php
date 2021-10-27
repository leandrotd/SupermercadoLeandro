<?php

//Inicio de la autocarga
require "app/autoloader.php";

spl_autoload_register("autoloader");

//Carga del front controller
require "app/frontcontroller.php";
