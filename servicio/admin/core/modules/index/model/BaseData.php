<?php
class BaseData {
    public function __construct(){}
        function backupDatabaseTables(){
            $host="localhost";
            $username=USER;
            $password=PASS;
            $database_name=DB;    
            $conn=mysqli_connect($host,$username,$password,$database_name);    
            $tables=array();
            $sql="SHOW TABLES";
        
            //print_r($query);
            $result=mysqli_query($conn,$sql);
            
            while($row=mysqli_fetch_row($result)){
            $tables[]=$row[0];    }
            
            $backupSQL="";
            foreach($tables as $table){
            $query="SHOW CREATE TABLE $table";
            $result=mysqli_query($conn,$query);
            $row=mysqli_fetch_row($result);
            $backupSQL.="\n\n".$row[1].";\n\n";
            
            $query="SELECT * FROM $table";
            $result=mysqli_query($conn,$query);
            
            $columnCount=mysqli_num_fields($result);
            
            for($i=0;$i<$columnCount;$i++){
            while($row=mysqli_fetch_row($result)){
            $backupSQL.="INSERT INTO $table VALUES(";
            for($j=0;$j<$columnCount;$j++){
            $row[$j]=$row[$j];
            
            if(isset($row[$j])){
            $backupSQL.='"'.$row[$j].'"';
            }else{
            $backupSQL.='""';
            }
            if($j<($columnCount-1)){
            $backupSQL.=',';
            }
            }
            $backupSQL.=");\n";
            }
            }
            $backupSQL.="\n";
            }    
          
            return $backupSQL;
        }
    }
?>