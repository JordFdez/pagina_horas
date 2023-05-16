<?php

session_start();
include("../include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {

    $query2 = "select name from schedules";
    $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
    $num_filas2 = mysqli_num_rows($consulta2);

    $query3 = "select name from roles";
    $consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
    $num_filas3 = mysqli_num_rows($consulta3);

    $query4 = "select * from works";
    $consulta4 = mysqli_query($conn, $query4) or die("Fallo en la consulta");
    $num_filas4 = mysqli_num_rows($consulta4);

    include("../template/formularios.php");
    print
    '<span> Gastos | Añadir </span>
        <form action="add_gasto_tabla.php" method="GET">

            <hr><br>
            <input type="search" name="buscar_obra" list="lista_obras" placeholder="Nombe de la obra" >
            <datalist id="lista_obras">';
    for ($i = 0; $i < $num_filas4; $i++) {
        $resultado4 = mysqli_fetch_array($consulta4);
        print ' <option name="lista_obras" value="' . $resultado4['name'] . '">';
    }
    print
        '</datalist> <br>
            Tipo de gasto: <select name="tipo_gasto">
                <option>DIETA</option>
                <option>KM</option>
                <option>VARIOS</option>
            </select><br>
            <br><input type="text" name="importe" placeholder="Importe" ><br><br>
            Fecha: <input type="date" name="fecha"><br>

            <br><textarea name="comentario" rows="10" cols="40" placeholder="Añada comentario sobre los gastos varios, km, dieta..."></textarea><br>

            <br><hr><br>

            <input type="submit" class="boton" name="add" value="Añadir">
        </form>
    </div>

</body>

</html>';
}
