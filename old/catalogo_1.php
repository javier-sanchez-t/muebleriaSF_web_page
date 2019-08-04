<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mueblería San Francisco Catálogo</title>
</head>

<body>
    <?php
        $busqueda = $_GET['buscar'];
        $query = "SELECT * FROM muebles WHERE nombre LIKE '%$busqueda%' OR tipo LIKE '%$busqueda%'";
        $sql = mysqli_query($con, $query);

        if(mysqli_num_rows($sql) == 0){
            //echo 'No se encontraron resultados'.mysqli_connect_error();
            echo mysqli_connect_error();
        }else{
            echo '<table>
                    <tr>
                        <th>Nombre</th>
                        <th>Clave</th>
                        <th>Tipo</th>
                    </tr>';
            while($row = mysqli_fetch_assoc($sql)){
                echo 
                '<tr>
                    <td>'.$row['nombre'].'</td>
                    <td>'.$row['clave'].'</td>
                    <td>'.$row['tipo'].'</td>
                </tr>';
            }
            echo '</table>';
        }
    ?>
</body>

</html>