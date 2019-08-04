//var serverPath = "http://localhost:8080/MuebleriaSanFrancisco/";
var serverPath = "https://jefe10jav.github.io/muebleriaSF_web_page/";

var buscarEnCatalogo = function () {
    var busqueda = document.getElementById("txtBusqueda").value;
    var urlCatalogo = serverPath + "catalogo.php";

    if (busqueda != null && busqueda != undefined) {
        urlCatalogo += "?buscar=" + busqueda;
    }

    window.location = urlCatalogo;
}

var buscarEnCatalogoDesdeMenu = function (event) {
    var tipo = event.textContent;
    var urlCatalogo = serverPath + "catalogo.php?buscar=" + tipo.trim();
    window.location = urlCatalogo;
}

var txtBusqueda = document.getElementById("txtBusqueda");
txtBusqueda.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {
        buscarEnCatalogo();
    }
});

var redireccionarIndexSeccion = function (seccion) {
    var urlIndexSeccion = serverPath + "index.html" + seccion;
    window.location = urlIndexSeccion;
}


// ===== Scroll to Top ==== 
$(window).scroll(function () {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function () {     // When arrow is clicked
    $('body,html').animate({
        scrollTop: 0                       // Scroll to top of body
    }, 500);
});

$('#INICIO_LINK').click(function () {
    $("html, body").delay(0).animate({
        scrollTop: $('#INICIO').offset().top
    }, 1000);
});

$('#SOBRE_NOSOTROS_LINK').click(function () {
    $("html, body").delay(0).animate({
        scrollTop: $('#SOBRE_NOSOTROS').offset().top
    }, 1000);
});

$('#ESTILOS_LINK').click(function () {
    $("html, body").delay(0).animate({
        scrollTop: $('#ESTILOS').offset().top
    }, 1000);
});

$('#TIENDAS_LINK').click(function () {
    $("html, body").delay(0).animate({
        scrollTop: $('#TIENDAS').offset().top
    }, 1000);
});