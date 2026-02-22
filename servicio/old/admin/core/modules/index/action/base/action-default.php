<?php

$objeto_base = New BaseData();
$backupSQL=$objeto_base->backupDatabaseTables();
//print_r($backupSQL);
if(!empty($backupSQL)){
    $backup_file_name='_backup_'.time().'.sql';
    //$fileHandler=fopen('base/'.$backup_file_name,'w+');
    $fileHandler=fopen('storage/'.$backup_file_name,'w+');
  
    $number_of_lines=fwrite($fileHandler,$backupSQL);
    fclose($fileHandler);    
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: '.filesize('storage/'.$backup_file_name));
    //readfile('storage/'.$backup_file_name);
    echo "1";
    } else{
        echo "2";
    }


?>