<?php

session_start();
include("../include/bbddconexion.php");
$id = $_REQUEST['id_gastos'];
$id_user = $_SESSION['id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    $query = "select * from gastos where id=$id";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    $resultado = mysqli_fetch_array($consulta);

    $query4 = "select * from works";
    $consulta4 = mysqli_query($conn, $query4) or die("Fallo en la consulta");
    $num_filas4 = mysqli_num_rows($consulta4);

    if (isset($_REQUEST['delete'])) {
        $query3 = "delete from gastos where id=$id";
        $consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
        if ($consulta3){
            echo "<script language='javascript'>
                alert('¡¡ Fila de gasto eliminada !!');
                window.location.replace('./gastos.php');
                </script>";
        }
        else{
            echo "<script language='javascript'>
                alert('¡¡ Error al eliminar !!');
                window.location.replace('./gastos.php');
                </script>";
        }
        
    }


}

?>