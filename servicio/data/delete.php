<?php

define('USER','u646234231_Servicio');
define('HOST','localhost');
define('PASS','Servicio.123##');
define('DB','u646234231_servicio');
// Configuración de la base de datos
$db_host = HOST;      // Servidor de la base de datos
$db_user = USER;           // Usuario de la base de datos
$db_pass = PASS;               // Contraseña del usuario
$db_name = DB; // Nombre de la base de datos a crear
$sql_file = 'backup.sql';    // Archivo SQL a importar

try {
    // Conectar al servidor MySQL
    $conn = new PDO("mysql:host=$db_host", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verificar existencia
    $stmt = $conn->query("SHOW DATABASES LIKE '$db_name'");
    
    if ($stmt->rowCount() === 0) {
        die("La base de datos '$db_name' no existe.\n");
    }
  

        $conn->exec("DROP DATABASE `$db_name`");
        echo "Base de datos '$db_name' eliminada con éxito.\n";
  
    
} catch (PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}

$conn = null;

// Cerrar conexión
$conn = null;
?>