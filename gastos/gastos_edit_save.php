<?php

session_start();
include("../include/bbddconexion.php");

$nombre = $_REQUEST['buscar_obra'];
$gasto = $_REQUEST['tipo_gasto'];
$importe = $_REQUEST['importe'];
$comentario = $_REQUEST['comentario'];
$id_gasto = $_REQUEST['id_gasto'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    $query = "update gastos set nombre='$nombre', tipo_gasto='$gasto', importe=$importe, comentario='$comentario', work_id=(select id from works where name='$nombre') where id=$id_gasto; ";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    
    if ($consulta){

        echo "<script language='javascript'>
        alert('¡¡ Gasto editado con exito !!');
        window.location.replace('./gastos.php');
        </script>"; 

    }
    else{
        echo "<script language='javascript'>
        alert('¡¡ Error al editar gasto !!');
        window.location.replace('./gastos_conf.php');
        </script>";
    }
    }

?>

