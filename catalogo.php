<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="./css/custom.css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <title>Mueblería San Francisco | Catálogo</title>
</head>

<body>

   
       <!-- NAVBAR -->
       <nav class="navbar navbar-expand-lg navbar-dark" id="INICIO">
        <a class="navbar-brand" href="#">
            <img src="img/header/logo.png" height="70px;" width="300px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
           
            <ul class="navbar-nav mr-auto" style="width: 100%;">
                <li class="nav-item">
                    <a class="nav-link" style="color: white;" href="javascript:redireccionarIndexSeccion('#INICIO')">
                        <i class="icon-home"></i>
                            Inicio
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" style="color: white;" href="javascript:redireccionarIndexSeccion('#SOBRE_NOSOTROS')">
                        <i class="icon-group"></i>
                            Sobre nosotros
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" style="color: white;" href="javascript:redireccionarIndexSeccion('#ESTILOS')">
                        <i class="icon-th"></i>
                        Estilos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" style="color: white;" href="javascript:redireccionarIndexSeccion('#TIENDAS')">
                        <i class="icon-briefcase"></i>
                        Tiendas
                    </a>
                </li>
            </ul>

        </div>
    </nav> 


    <div class="container" style="margin-top: 20px;">

        <!-- BUSQUEDA-->
        <div class="row">
            <div class="col input-group">
                <input type="text" class="form-control" placeholder="Buscar" id="txtBusqueda">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-secondary mb-2" onclick="buscarEnCatalogo()">Buscar</button>
                </span>
            </div>
        </div>

        <!-- ENCABEZADOS -->
        <!--div class="row encabezado encabezadoCategoria">
                <div style="width:100%;">
                    CATEGORÍAS
                </div>
        </div>
        <div class="row encabezado" style="padding-left: 30px;">
            <!--?php
                if(isset($_GET['buscar']) && $_GET['buscar']!=""){
                    $busqueda = $_GET['buscar'];
                    echo 
                    '<div>
                        RESULTADOS DE BUSQUEDA PARA "'.$busqueda.'"
                    </div>';
                }else{
                    echo 
                    '<div>
                        RESULTADOS DE BÚSQUEDA:
                    </div>';
                }
            ?>
        </div-->

        <div class="encabezado">
            <div style="width:100%;">
                CATEGORÍAS
            </div>
        </div>

        <div class="leftPanelSearch">

            <?php
                $query = "SELECT DISTINCT linea FROM muebles";
                $sql = mysqli_query($con, $query);
                echo '<div class="accordion" id="accordionExample">';
                if(mysqli_num_rows($sql) != 0){
                    while($row = mysqli_fetch_assoc($sql)){
                        echo 
                        '<div class="menu-item" data-toggle="collapse" href="#'.$row['linea'].'" data-target="#'.$row['linea'].'" role="button" aria-expanded="false" aria-controls="'.$row['linea'].'">
                            <i class="icon-chevron-sign-right"></i>&nbsp&nbsp
                            '.$row['linea'].'
                        </div>';

                        $queryTipo = "SELECT * FROM muebles WHERE linea LIKE '";
                        $queryTipo.=$row['linea']."' ";
                        $queryTipo.= "GROUP BY tipo";
                        $sqlTipo = mysqli_query($con, $queryTipo);

                        if(mysqli_num_rows($sqlTipo) != 0){
                            while($rowTipo = mysqli_fetch_assoc($sqlTipo)){
                                echo '<div class="collapse" id="'.$rowTipo['linea'].'" data-parent="#accordionExample">
                                    <div class="card card-body card-custom" onclick="buscarEnCatalogoDesdeMenu(this)">
                                    <i class="icon-hand-right">&nbsp&nbsp'.$rowTipo['tipo'].'</i>
                                    </div>
                                </div>';
                            }
                        }
                        
                    }
                }
                echo '</div>';
            ?>
        </div>


        <div class="encabezado" style="margin-top: 20px;">
            <?php
                if(isset($_GET['buscar']) && $_GET['buscar']!=""){
                    $busqueda = $_GET['buscar'];
                    echo 
                    '<div>
                        RESULTADOS DE BUSQUEDA PARA "'.$busqueda.'"
                    </div>';
                }else{
                    echo 
                    '<div>
                        RESULTADOS DE BÚSQUEDA:
                    </div>';
                }
            ?>
        </div>
        <div class="row catalog-content">
            
            <?php
                $query = "SELECT * FROM muebles";

                if(isset($_GET['buscar'])){
                    $busqueda = $_GET['buscar'];
                    $query=$query." WHERE nombre LIKE '%$busqueda%' OR tipo LIKE '%$busqueda%'";
                }

                $sql = mysqli_query($con, $query);

                if(mysqli_num_rows($sql) == 0){
                    //echo 'No se encontraron resultados'.mysqli_connect_error();
                    //echo mysqli_connect_error();
                    echo 
                        '<div class="col-12 col-sm-12">
                            <div class="alert alert-danger" role="alert" style="text-align:center">
                                No se encontraron resultados.
                            </div>
                        </div>';
                }else{
                    while($row = mysqli_fetch_assoc($sql)){
                        echo 
                            '<div class="col-12 col-sm-6">
                                <div class="card" style="width: 100%">
                                    <img src="img/catalogo/DSC_0'.$row['fotografia'].'.png" class="card-img-top cardImage">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$row['nombre'].'</h5>
                                        <div class="card-text"><strong>Categoría:</strong> '.$row['tipo'].'</div>
                                        <div class="card-text"><strong>Clave:</strong> '.$row['clave'].'</div>
                                        <div class="card-text"><strong>Medidas:</strong> '.$row['medidas'].'</div>
                                    </div>
                                </div>
                            </div>';
                    }
                }
            ?>
       
        </div>

    </div>


<!-- Footer -->
<footer class="page-footer font-small indigo footer">

<!-- Footer Links -->
<div class="container text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

        <!-- Grid column -->
        <div class="col-md-6 mx-auto">

            <!-- Links -->
            <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
                Contacto:
            </h5>

            <ul class="list-unstyled">
                <li>
                    q@q.com
                </li>
            </ul>

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none">

        <!-- Grid column -->
        <div class="col-md-6 mx-auto">

            <!-- Links -->
            <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
                Ubicación
            </h5>

            <ul style="text-align: left;">
                <li>
                    Calle Florencio Espinoza Oriente #305 local 2 colonia centro San Martin Texmelucan, Puebla
                </li>
                <li>
                    Calle Florencio Espinoza Oriente #306 colonia centro San Martin Texmelucan, Puebla
                </li>
                <li>
                    Calle Juárez #19 Nanacamilpa, Tlaxcala
                </li>
                <li>
                    Xicoténcatl No. 11 San Martin Texmelucan, Puebla
                </li>
            </ul>

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none">

    </div>
    <!-- Grid row -->

</div>
<!-- Footer Links -->

<!-- Copyright -->
<div class="text-center py-3">© 2019 Copyright:
    <a> Mueblería San Francisco</a>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->


<!-- SCROLL TOP-->
<a href="javascript:" id="return-to-top" style="display: block;"><i class="icon-chevron-up"></i></a>
    

</body>

    <!-- JS -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>

</html>