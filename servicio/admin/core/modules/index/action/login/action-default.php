<?php
$nombreUsuario = $_POST['email'];
$password = sha1(md5($_POST['password']));
$user = new UserData(); 
$t = $user->login($nombreUsuario,$password);
$id = $t->dato1;	
$userlevel=$t->userLevel;
$confirmacion=$t->confirmacion;
//echo $id;
if($id==1){   
  $empresa = new EmpresaData();
  $data=$empresa->getById('01');
  $_SESSION['tenancy_name'] = $data->name;
  $_SESSION['tenancy_email'] = $data->email;
  $_SESSION['tenancy_dir'] = $data->dir;
  $_SESSION['tenancy_telefonos'] = $data->telefonos;
  $_SESSION['tenancy_rif'] = $data->rif;
  $_SESSION['tenancy_image'] = $data->image;
         
  if($userlevel==1){
    //administrador
  $_SESSION['logged_in'] = true; 
	$_SESSION['estado'] = $t->estatus;
  $_SESSION['nombre'] = $t->nombre;
  $_SESSION['nombreUsuario'] = $t->nombreUsuario;
  $_SESSION['nivel'] = $t->userLevel;
  $_SESSION['image'] = $t->image;
  $_SESSION['id'] = $t->id;
  $user->nombreUsuario =$t->nombreUsuario;
  $user->loginTime();
  echo "1";

    }
if($userlevel==2){
  //encargado
  if($confirmacion==1){
  $_SESSION['logged_in'] = true; 
	$_SESSION['estado'] = $t->estatus;
  $_SESSION['nombre'] = $t->nombre;
  $_SESSION['nombreUsuario'] = $t->nombreUsuario;
  $_SESSION['nivel'] = $t->userLevel;
  $_SESSION['image'] = $t->image;
  $_SESSION['id'] = $t->id;
  $user->nombreUsuario =$t->nombreUsuario;
  $user->loginTime();
 
  echo "2";
  }else{
    echo "9";
  }
}
if($userlevel==3){
  //mecanico
  if($confirmacion==1){
  $_SESSION['logged_in'] = true; 
	$_SESSION['estado'] = $t->estatus;
  $_SESSION['nombre'] = $t->nombre;
  $_SESSION['nombreUsuario'] = $t->nombreUsuario;
  $_SESSION['nivel'] = $t->userLevel;
  $_SESSION['image'] = $t->image;
  $_SESSION['id'] = $t->id;
  $user->nombreUsuario =$t->nombreUsuario;
  $user->loginTime();
 
  echo "3";
  }else{
    echo "9";
  }
}
if($userlevel==4){
  //chofer
  if($confirmacion==1){
  $_SESSION['logged_in'] = true; 
	$_SESSION['estado'] = $t->estatus;
  $_SESSION['nombre'] = $t->nombre;
  $_SESSION['nombreUsuario'] = $t->nombreUsuario;
  $_SESSION['nivel'] = $t->userLevel;
  $_SESSION['image'] = $t->image;
  $_SESSION['id'] = $t->id;
  $user->nombreUsuario =$t->nombreUsuario;
  $user->loginTime();
 
  echo "4";
  }else{
    echo "9";
  }
}

if($userlevel==5){
  // secretaria
  if($confirmacion==1){
  $_SESSION['logged_in'] = true; 
	$_SESSION['estado'] = $t->estatus;
  $_SESSION['nombre'] = $t->nombre;
  $_SESSION['nombreUsuario'] = $t->nombreUsuario;
  $_SESSION['nivel'] = $t->userLevel;
  $_SESSION['image'] = $t->image;
  $_SESSION['id'] = $t->id;
  $user->nombreUsuario =$t->nombreUsuario;
  $user->loginTime();
 
  echo "4";
  }else{
    echo "9";
  }
}

}else{
  echo "0";
}
?>
