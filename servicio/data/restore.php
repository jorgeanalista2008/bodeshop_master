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

// Intentar conectar al servidor MySQL
try {
    $conn = new PDO("mysql:host=$db_host", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Crear la base de datos si no existe
    $conn->exec("CREATE DATABASE IF NOT EXISTS `$db_name`");
    $conn->exec("USE `$db_name`");
    
    echo "Base de datos '$db_name' creada/existe. Preparándose para importar...\n";
    
    // Verificar si el archivo SQL existe
    if (!file_exists($sql_file)) {
        die("Error: El archivo $sql_file no existe.");
    }
    
    // Leer el archivo SQL
    $sql = file_get_contents($sql_file);
    $sql = str_replace('utf8mb4_0900_ai_ci', 'utf8mb4_unicode_ci', $sql);
    
    // Dividir las consultas SQL (separadas por ;)
    // Nota: Esto es básico y puede fallar con procedimientos almacenados o triggers
    $queries = explode(';', $sql);
    
    // Ejecutar cada consulta
    foreach ($queries as $query) {
        if (trim($query) != '') {
            try {
                $conn->exec($query);
            } catch (PDOException $e) {
                echo "Error al ejecutar consulta: " . $e->getMessage() . "\n";
            }
        }
    }
    
    echo "Importación completada con éxito!\n";
    
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Cerrar conexión
$conn = null;
?>