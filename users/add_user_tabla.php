<?php

session_start();
include("../include/bbddconexion.php");

$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$email = $_REQUEST['email'];
$pass = $_REQUEST['pass'];
$estado = $_REQUEST['estado'];
$horario = $_REQUEST['buscar_horario'];
$rol = $_REQUEST['buscar_rol'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if ($nombre == "" | $apellido == "" | $email == "" | $pass == "" | $estado == "" | $horario == "" | $rol == ""){
        echo "<script language='javascript'>
        alert('¡¡ Faltan datos por rellenar !!');
        window.location.replace('./add_tabla_valores.php');
        </script>"; 
    }
    else {
        $query = "insert into users (id, name, last_name, email, password, type, schedule_id, rol_id, created_at ) values (NULL, '$nombre', '$apellido', '$email', MD5('$pass'), '$estado', (select id from schedules where name='$horario'), (select id from roles where name='$rol'), now()) ";
        $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
        

        if ($consulta){

            echo "<script language='javascript'>
            alert('¡¡ Usuario añadido con exito !!');
            window.location.replace('./usuario.php');
            </script>"; 

        }
        else{
            echo "<script language='javascript'>
            alert('¡¡ Error al añadir usuario !!');
            window.location.replace('./usuario.php');
            </script>";
        }
    }
}

?>