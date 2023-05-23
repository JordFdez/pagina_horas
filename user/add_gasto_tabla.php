<?php

session_start();
include("../include/bbddconexion.php");

$nombre = $_REQUEST['buscar_obra'];
$gasto = $_REQUEST['tipo_gasto'];
$importe = $_REQUEST['importe'];
$fecha = $_REQUEST['fecha'];
$comentario = $_REQUEST['comentario'];
$id = $_SESSION['id'];
// $copiarFichero = false;

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if (isset($_REQUEST['add'])) {
        if ($nombre == "" | $gasto == "" | $importe == "" | $fecha == ""){
            echo "<script language='javascript'>
            alert('¡¡ Faltan datos por rellenar !!');
            window.location.replace('./add_gastos.php');
            </script>";
        }
        //  else if (is_uploaded_file($_FILES['miinput']['tmp_name'])) {
        //     $nombreDirectorio = "C:/laragon/www/horas/img_gastos/";
        //     $nombreFichero = $_FILES['miinput']['name'];
        //     $copiarFichero = true;

        //     //si ya existe un fichero con el mismo nombre, renombrarlo
        //     $nombreCompleto = $nombreDirectorio . $nombreFichero;
        //     if (is_file($nombreCompleto)) {
        //         $idUnico = time();
        //         $nombreFichero = $idUnico . "-" . $nombreFichero;
        //     }
        // } else if ($_FILES['miinput']['error'] == UPLOAD_ERR_FORM_SIZE) {
        //     $maxsize = $_REQUEST['MAX_FILE_SIZE'];
        //     $nombreFichero = "";
        // }

        // if ($copiarFichero) {
        //     move_uploaded_file($_FILES['miinput']['tmp_name'], $nombreDirectorio . $nombreFichero);
        // }
            

           else if ($gasto == "DIETA") {
                $query = "insert into gastos (id, estado, nombre, work_id, tipo_gasto, importe, fecha, comentario, user_id) values (NULL, 'NO APROBADA', '$nombre' , (select id from works where name='$nombre'), '$gasto', (select $importe*dieta_importe from importe_gasto where user_id=$id), '$fecha', '$comentario', (select id from users where id=$id));";
                $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
                if ($consulta) {
                    echo "<script language='javascript'>
                alert('¡¡ Gasto añadido con exito !!');
                window.location.replace('./gastos.php');
                </script>";
                } else {
                    echo "<script language='javascript'>
                alert('¡¡ Error al añadir gasto !!');
                window.location.replace('./add_gastos.php');
                </script>";
                }
            } else if ($gasto == "KM") {
                $query2 = "insert into gastos (id, estado, nombre, work_id, tipo_gasto, importe, fecha, comentario, user_id) values (NULL, 'NO APROBADA', '$nombre' , (select id from works where name='$nombre'), '$gasto', (select $importe*km_importe from importe_gasto where user_id=$id), '$fecha', '$comentario', (select id from users where id=$id));";
                $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
                if ($consulta2) {
                    echo "<script language='javascript'>
                alert('¡¡ Gasto añadido con exito !!');
                window.location.replace('./gastos.php');
                </script>";
                } 
                else {
                    echo "<script language='javascript'>
                alert('¡¡ Error al añadir gasto !!');
                window.location.replace('./add_gastos.php');
                </script>";
                }
            } else if ($gasto == "VARIOS") {
                $query2 = "insert into gastos (id, estado, nombre, work_id, tipo_gasto, importe, fecha, comentario, user_id) values (NULL, 'NO APROBADA', '$nombre' , (select id from works where name='$nombre'), '$gasto', $importe, '$fecha', '$comentario', (select id from users where id=$id));";
                $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
                if ($consulta2) {
                    echo "<script language='javascript'>
                alert('¡¡ Gasto añadido con exito !!');
                window.location.replace('./gastos.php');
                </script>";
                } else {
                    echo "<script language='javascript'>
                alert('¡¡ Error al añadir gasto !!');
                window.location.replace('./add_gastos.php');
                </script>";
                }
            }
    } 
    else if (isset($_REQUEST['close'])) {
        header('Location:./gastos.php');
    }
}

?>