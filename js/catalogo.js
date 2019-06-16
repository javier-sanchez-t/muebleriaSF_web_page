var redireccionarIndexSeccion = function (seccion) {
    var urlIndexSeccion = window.location.pathname.replace("catalogo.html", "index.html")+seccion;
    window.location = urlIndexSeccion;
}