<?php
$m = new mysqli('localhost', 'root', '', 'u646234231_cristal_gus');
if ($m->connect_error) {
    echo "ERROR_CONN: " . $m->connect_error . "\n";
    exit(1);
}
echo "CONECTADO CON EXITO A MYSQL u646234231_cristal_gus\n";
$res = $m->query("SELECT id, username, email, first_name, last_name, group_id FROM sma_users");
while ($row = $res->fetch_assoc()) {
    echo json_encode($row) . "\n";
}
