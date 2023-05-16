<?php

session_start();
include("../include/bbddconexion.php");

$nombre = $_REQUEST['buscar_obra'];
$gasto = $_REQUEST['tipo_gasto'];
$importe = $_REQUEST['importe'];
$fecha = $_REQUEST['fecha'];
$comentario = $_REQUEST['comentario'];
$id = $_SESSION['id'];


if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if ($nombre == "" | $gasto == "" | $importe == "" | $fecha == ""){
        echo "<script language='javascript'>
        alert('¡¡ Faltan datos por rellenar !!');
        window.location.replace('./add_gastos.php');
        </script>"; 
    }
    else {
        $query = "insert into gastos (id, estado, nombre, work_id, tipo_gasto, importe, fecha, comentario, user_id) values (NULL, 'NO APROBADA', '$nombre' , (select id from works where name='$nombre'), '$gasto', '$importe', '$fecha', '$comentario', (select id from users where id=$id));";
        $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
        

        if ($consulta){

            echo "<script language='javascript'>
            alert('¡¡ Gasto añadido con exito !!');
            window.location.replace('./gastos.php');
            </script>"; 

        }
        else{
            echo "<script language='javascript'>
            alert('¡¡ Error al añadir gasto !!');
            window.location.replace('./add_gastos.php');
            </script>";
        }
    }
}
