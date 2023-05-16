<?php

session_start();
include("../include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    $query = "select gastos.id, gastos.estado, users.name as 'user_name', users.last_name, users.email, works.name as 'work_name', works.code, gastos.fecha, gastos.tipo_gasto, gastos.importe, gastos.comentario, gastos.who_approve from gastos, users, works where users.id=gastos.user_id and gastos.work_id=works.id";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta content="initial-scale=1, 
maximum-scale=1, user-scalable=0" name="viewport" />

    <meta name="viewport" content="width=device-width" />
    <title>BaumControl</title>
    <link rel="stylesheet" href="../css/nav-bar.css">

    <?php include("../include/tabla.php");
    include("../include/tabla2.php");
    include("../include/menu.php"); ?>

</head>

<body>
    <div class="fondo_naranja">
        <div class="nav-bar">
            <span>Pages / <b>Gastos</b></span>

            <!--include menu -->
            <?php include("../template/menu.php"); ?>
            <br><br>
            <div class="medio">
                <nav class="medio_ajuste">
                    <div class="items">
                        <span class="item_span"><a class="item_a" href="./add_gastos.php"> Añadir Gastos</a></span>
                    </div>

                </nav>
            </div><br>
        </div>

        <div class="tabla_estilo">
            <span>Gastos</span><br><br>
            <!--tables with data-->
            <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Nombre</th>
                        <th>Obra</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Importe</th>
                        <th>Observaciones</th>
                        <th>Aprobado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>

                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    for ($i = 0; $i < $num_filas; $i++) {
                        $resultado = mysqli_fetch_array($consulta);
                        print "<tr><td class='" . $resultado['estado'] . "'>" . $resultado['estado'] . " </td><td>" . $resultado['user_name'] . " " . $resultado['last_name'] . $resultado['email'] . "</td><td>" . $resultado['work_name'] . "<br>" . $resultado['code'] . "</td><td>" . $resultado['fecha'] . "</td><td>" . $resultado['tipo_gasto'] . "</td><td>" . $resultado['importe'] . "</td><td>" . $resultado['comentario'] . "</td><td>" . $resultado['who_approve'] . "</td><td><form action='gastos_conf.php' method='GET'><input name='id_gastos' type='hidden' value=" . $resultado['id'] . ">
                        <button class='no_boton2' name='delete' onclick='return confirmDelete()' title='Borrar' >
                            <i class='fa fa-trash-o' style='font-size:22px;color:red'></i>
                            </button>
                            <button name='edit' class='no_boton2' title='Editar'>
                            <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                            </button>
                            <button name='confirm' class='no_boton2'>
                            <i class='fa fa-check-circle-o' style='font-size:22px;color:green' title='Aprobar'></i>
                            </button>
</form></td></tr>";
                    }
                    ?>
                </tbody>
            </table><br>
        </div>
    </div>
    <script>
        /* Initialization of datatables */
        $(document).ready(function() {
            $("table.display").DataTable();
        });
    </script>
</body>

</html>