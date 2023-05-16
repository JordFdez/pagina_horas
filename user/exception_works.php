<?php

session_start();
include("../include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    $query = "select * from exception_works";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);

    if ($consulta) {

        echo '
        <!DOCTYPE html>
<html lang="es">

<head>
<meta content="initial-scale=1, 
maximum-scale=1, user-scalable=0"
name="viewport" />

<meta name="viewport" 
content="width=device-width" />
<title>BaumControl</title>
<link rel="stylesheet" href="../css/nav-bar.css">';

        include("../include/tabla.php");
        include("../include/tabla2.php");
        include("../include/menu.php");

        echo '</head>

<body>
<div class="fondo_naranja">
<div class="nav-bar">
<span>Pages / <b>Resto de Obras</b></span>

<!--include menu -->
';
        include("../template/menu_user.php");
        echo ' <br><br><br>
        <div class="medio">
            <nav class="medio_ajuste">
                <div class="items">
                    <span class="item_span"><a class="item_a" href="./obras.php"> Ir a obras</a></span>
                </div>
                
            </nav>
        </div><br>
</div>

<div class="tabla_estilo">
<span>Resto de obras</span><br><br>
<!--tables with data-->
        <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>

                    </tr>
                    </thead>
                    <tfoot>
                <tr>
                    <th>Filter..</th>
                    <th>Filter..</th>

                    
                </tr>
            </tfoot>
                    <tbody>';
        for ($i = 0; $i < $num_filas; $i++) {
            $resultado = mysqli_fetch_array($consulta);
            print "<tr><td>" . trim($resultado['code']) . " </td><td> " . trim($resultado['name']) . "</td></td>
                        </tr>";
        }
        echo '
                    </tbody>
                </table><br>
            </div>
        </div>
        <script>
        /* Initialization of datatables */
        $(document).ready(function () {
            $("table.display").DataTable();
        });
    </script>
    <script type="text/javascript">
    function confirmDelete(){
        var resp = confirm("¿Desea eliminarlo?");

        if ($resp == true){
            return true;
        }
        else{
            return false;
        }
    }
</script>
    </body>
  
</html>
        ';
    } else {
        echo "<script language='javascript'>
            alert('¡¡ Error al añadir las horas!!');
            window.location.replace('./horas.php');
            </script>";
    }
}
