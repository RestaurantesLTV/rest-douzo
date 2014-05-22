//Environment variables

var gTurno = "";
var gDatos = new Array();
var gTurnos = undefined;

var gMenuCoords = {
    x : 0,
    y : 0
};

var gSeccionActual = "";
/*Leyenda 'gSeccionActual':
 * #reserva-tabla
 */

// Variables de filtracion
var gToggle = {
    'nombre': true,
    'id': true,
    'menu' : true
}


$(document).ready(function() {
    CargarTurnosFromDB(); // Carga los Strings correspondientes a los numeros de los turnos en el restaurante.
    SetInitialBindings();
    SetPageLoading(false);
    //ShowMenu(false);
    
    $("#reserva-tabla").hide();
    
    /* ocultamos el menu*/
    

    /*$.get(  "proximasreservas",
     function(data){
     gDatos = data;
     PrintReservasTable(data, true);
     },"json");*/
});

/*
 * Desplaza el menu (Oculta o lo hace visible).
 * Para ello, el objeto a ser movido debe tener la siguiente propieda CSS:
 * 'Position: relative', ya que se mueve relativamente desde su posicion 'x' pixeles.
 * @param boolean b
 * @returns {undefined}
 */
function ShowMenu(b){
    var desplazamiento; 
    if(b){
        desplazamiento = "+=200px";
        if(gToggle['menu']) return; // Evitamos el desplazamiento si ya esta visible
        gToggle['menu'] = true;
    }else{
        desplazamiento = "-=200px";
        if(!gToggle['menu']) return; // Evitamos el desplazamiento si ya esta oculto
        gToggle['menu'] = false;
    }
    $("#cssmenu").clearQueue().stop();
    
    $("#cssmenu").animate({ 
        left: desplazamiento,
    },  1000);
}

function SetInitialBindings() {
    var pProximas_reservas = $("#proximas_reservas");
    var pReservas_completadas = $("#reservas_completadas");
    var pTodas_las_reservas = $("#todas_las_reservas");
    var pUtimos7dias = $("#ultimos7dias");
    
    /*$("#cssmenu").mouseenter(function(){
       ShowMenu(true);
    });
    
    $("#cssmenu").mouseleave(function(){
       ShowMenu(false);
    });*/

    $(pTodas_las_reservas).click(function() {
        $.get("todaslasreservas",
                function(data) {
                    gDatos = data;
                    PrintReservasTable(data, true);
                }, "json");
    });

    $(pReservas_completadas).click(function() {
        $.get("reservascompletadas",
                function(data) {
                    gDatos = data;
                    PrintReservasTable(data, true);
                }, "json");
    });

    $(pUtimos7dias).click(function() {
        $.get("ultimos7dias",
                function(data) {
                    gDatos = data;
                    PrintReservasTable(data, true);
                }, "json");
    });

    $(pProximas_reservas).click(function() {
        $.get("proximasreservas",
                function(data) {
                    gDatos = data;
                    PrintReservasTable(data, true);
                }, "json");
    });
    /*************************************************/
    // Filtrar por columna
    $(".reserva-backend table td").eq(0).click(function() { // Columna "Seleccionar"
        gDatos.reverse();
        PrintReservasTable(gDatos);
    });

    $(".reserva-backend table td").eq(1).click(function() { // Columna "ID Reserva"
        FiltrarPorIDReserva();
    });

    $(".reserva-backend table td").eq(2).click(function() { // Columna "Nombre"
        FiltrarPorNombre();
    });

    $(".reserva-backend table td").eq(3).click(function() { // Columna "Hora"
        FiltrarPorFecha();
    });

    $(".reserva-backend table td").eq(4).click(function() { // Columna "Turno"
        FiltrarPorHora();
    });


}

function FiltrarPorNombre() {
    //Primero al reves
    gDatos.sort(function(a, b) {
        var nameA = a['nombre'].toLowerCase();
        var nameB = b['nombre'].toLowerCase();
        console.log(nameA + " VS " + nameB);
        if (gToggle['nombre']) {
            if (nameA > nameB) //sort string ascending
                return -1
            if (nameA < nameB)
                return 1
        } else {

            if (nameA < nameB) //sort string ascending
                return -1
            if (nameA > nameB)
                return 1
        }
        return 0 //default return value (no sorting)
    });

    gToggle['nombre'] = !gToggle['nombre'];
    PrintReservasTable(gDatos);
}

/**
 * Agrega nuevas filas a la tabla de reservas.
 * Antes de hacerlo limpia todas las filas que hay.
 * @param Object[] data
 * @param boolean debug
 */
function PrintReservasTable(data, debug) {
    if(gSeccionActual != "#reserva-tabla"){
        gSeccionActual = "#reserva-tabla";
        $("#reserva-tabla").show();
    }
    CleanTable();
    SetPageLoading(true);
    setTimeout(function() {
        SetPageLoading(false)
    }, 500);

    if (!debug) {
        debug = false;
    } else {

    }
    var html = "";

    for (var i = 0; i < data.length; i++) {
        var id_turno = data[i]["id_turno"] - 1;
        var turno_string = gTurnos[id_turno];

        html = html + "<tr>";
        html = html + "<td>" + '<input type="checkbox" id="res' + data[i]["id"] + '"><label for="1"></label>' + "</td>";
        html = html + "<td>" + data[i]["id"] + "</td>";
        html = html + "<td>" + data[i]["nombre"] + " " + data[i]['apellido'] + "</td>";
        html = html + "<td>" + data[i]["fecha_reservada"] + "</td>";
        html = html + "<td>" + data[i]["hora_reservada"] + "</td>";
        html = html + "<td>" + turno_string + "</td>";
        html = html + "</tr>";
    }
    html = html + "</table>";
    //console.log(html);
    var pTabla = $(".reserva-backend table").append(html);

    SetPageLoading(false);

}

function SetBindings() {

}

/**
 * Borra toda la tabla de reservas excepto la primera row
 * que contiene el encabezad de la tabla con los nombres de cada columna.
 */
function CleanTable() {
    pTabla = $(".reserva-backend table tr:not(:first)"); // Seleccionamos toda la tabla excepto su encabezado
    $(pTabla).html("");
}

/**
 * Hace una llamada AJAX al servidor, pero no es ASINCRONA!! Esto esta hecho para que se le de tiempo a cargar
 * de la base de datos los turnos disponibles, para que mas adelante dichos string puedan ser cargados
 * sin ningun problema.
 */
function CargarTurnosFromDB() {
    gTurnos = new Array();

    $.ajax({
        url: "turnosdisponibles",
        data: null,
        success: function(data) {
            for (var i = 0; i < data.length; i++) {
                gTurnos[i] = ucfirst(data[i]['nombre']);
            }

            console.log(gTurnos);
        },
        dataType: "json",
        async: false
    });
}

/**
 * Convierte la primera letra del string a mayuscula.
 * @param String string
 * @returns String
 */
function ucfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

/***************************************************/

function SetPageLoading(loading) {
    console.log("estado carga: " + loading);
    if (loading) {
        $("#reserva-loading-screen").show();
        $("#reserva-loading-gif").show();
    } else {
        $("#reserva-loading-screen").hide();
        $("#reserva-loading-gif").hide();
    }
}

// Funciones de filtracion


function FiltrarPorIDReserva() {
    gDatos.sort(function(a, b) {
        if (gToggle['id']) {
            if (a['id'] > b['id']) {
                return 1;
            }
            if (a['id'] < b['id']) {
                return -1;
            }
        } else {
            if (a['id'] < b['id']) {
                return 1;
            }
            if (a['id'] > b['id']) {
                return -1;
            }
        }
        return 0;
    });
    gToggle['id'] = !gToggle['id'];
    PrintReservasTable(gDatos);
}

/**
 * Funcion auxiliar. Permite una Deep Copy (Diferente de Shallow Copy) de un objeto.
 * @param Object obj
 * @returns {Array|DeepCopy.copy}
 */
function DeepCopy(obj) {
    // Handle the 3 simple types, and null or undefined
    if (null == obj || "object" != typeof obj)
        return obj;

    // Handle Date
    if (obj instanceof Date) {
        var copy = new Date();
        copy.setTime(obj.getTime());
        return copy;
    }

    // Handle Array
    if (obj instanceof Array) {
        var copy = [];
        for (var i = 0, len = obj.length; i < len; i++) {
            copy[i] = DeepCopy(obj[i]);
        }
        return copy;
    }

    // Handle Object
    if (obj instanceof Object) {
        var copy = {};
        for (var attr in obj) {
            if (obj.hasOwnProperty(attr))
                copy[attr] = DeepCopy(obj[attr]);
        }
        return copy;
    }

    throw new Error("Unable to copy obj! Its type isn't supported.");
}