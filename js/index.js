var buscarEnCatalogo = function () {
    var busqueda = document.getElementById("txtBusqueda").value;
    var path = window.location.pathname.replace("index.html", "");
    var urlCatalogo = path + "catalogo.php";
    
    if(busqueda!=null && busqueda!=undefined){
        urlCatalogo+="?buscar="+busqueda;
    }

    window.location = urlCatalogo;
}