<?php

session_start();
include("../include/bbddconexion.php");

$nombre = $_REQUEST['buscar_obra'];
$gasto = $_REQUEST['tipo_gasto'];
$importe = $_REQUEST['importe'];
$comentario = $_REQUEST['comentario'];
$fecha = $_REQUEST['fecha'];
$id_gasto = $_REQUEST['id_gasto'];
$id = $_SESSION['id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if (isset($_REQUEST['act'])) {
        if($gasto == "KM"){
            $query = "update gastos set nombre='$nombre', tipo_gasto='$gasto', importe=(select $importe*km_importe from importe_gasto where user_id=$id), fecha='$fecha', comentario='$comentario', work_id=(select id from works where name like '%$nombre%') where id=$id_gasto; ";
            $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
            if ($consulta) {
                echo "<script language='javascript'>
                alert('¡¡ Gasto editado con exito !!');
                window.location.replace('./gastos.php');
                </script>";
            } else {
                echo "<script language='javascript'>
                alert('¡¡ Error al añadir gasto !!');
                window.location.replace('./gastos_conf.php');
                </script>";
            }
        }
        else if ($gasto == "DIETA") {
            $query2 = "update gastos set nombre='$nombre', tipo_gasto='$gasto', importe=(select $importe*dieta_importe from importe_gasto where user_id=$id), fecha='$fecha', comentario='$comentario', work_id=(select id from works where name like '%$nombre%') where id=$id_gasto; ";
            $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
            if ($consulta) {
                echo "<script language='javascript'>
                alert('¡¡ Gasto editado con exito !!');
                window.location.replace('./gastos.php');
                </script>";
            } else {
                echo "<script language='javascript'>
                alert('¡¡ Error al añadir gasto !!');
                window.location.replace('./gastos_conf.php');
                </script>";
            }
        }
        else if ($gasto == "VARIOS"){
            $query3 = "update gastos set nombre='$nombre', tipo_gasto='$gasto', importe=$importe, fecha='$fecha', comentario='$comentario', work_id=(select id from works where name like '%$nombre%') where id=$id_gasto; ";
            $consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
            if ($consulta) {
                echo "<script language='javascript'>
                alert('¡¡ Gasto editado con exito !!');
                window.location.replace('./gastos.php');
                </script>";
            } else {
                echo "<script language='javascript'>
                alert('¡¡ Error al añadir gasto !!');
                window.location.replace('./gastos_conf.php');
                </script>";
            }
        }

        } 
        else if (isset($_REQUEST['close'])) {
        header('Location:./gastos.php');
        }  
    }

?>

