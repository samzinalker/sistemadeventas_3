<?php
// Definir ruta raíz absoluta para facilitar includes futuros y normalizar rutas
if (!defined('ROOT_PATH')) define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/sistemadeventas');

// Definir constantes de configuración de la base de datos solo si no existen
if (!defined('SERVIDOR')) define('SERVIDOR', 'localhost');
if (!defined('USUARIO')) define('USUARIO', 'root');
if (!defined('PASSWORD')) define('PASSWORD', '');
if (!defined('BD')) define('BD', 'sistemadeventas');

// Cadena de conexión PDO
$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // echo "La conexión a la base de datos fue un éxito";
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos";
}

// URL base del sistema
$URL = "http://localhost/sistemadeventas";

// Zona horaria y fecha/hora global
date_default_timezone_set('America/Guayaquil');
$fechaHora = date('Y-m-d H:i:s');