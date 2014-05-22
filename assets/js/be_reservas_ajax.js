//Environment variables

var gTurno = "";
var gDatos = new Array();
var gTurnos = undefined;


$(document).ready(function(){
    CargarTurnosFromDB(); // Carga los Strings correspondientes a los numeros de los turnos en el restaurante.
    SetInitialBindings();
    SetPageLoading(false);
    
    /*$.get(  "proximasreservas",
            function(data){
                gDatos = data;
                PrintReservasTable(data, true);
    },"json");*/
});

function SetInitialBindings(){
    var pProximas_reservas = $("#proximas_reservas");
    var pReservas_completadas = $("#reservas_completadas");
    var pTodas_las_reservas = $("#todas_las_reservas");
    var pUtimos7dias = $("#ultimos7dias");
    
    $(pTodas_las_reservas).click(function(){
        $.get(  "todaslasreservas",
            function(data){
                gDatos = data;
                PrintReservasTable(data, true);
    },"json");
    });
}

/**
 * Agrega nuevas filas a la tabla de reservas.
 * @param Object[] data
 * @param boolean debug
 */
function PrintReservasTable(data, debug){
    CleanTable();
    //SetPageLoading(true);
    
    if(!debug){
        debug = false;
    }else{
        
    }
    var html = "";
    
    for(var i=0; i < data.length; i++){
        var id_turno = data[i]["id_turno"]-1;
        var turno_string = gTurnos[id_turno];
        
        html = html + "<tr>";
                html = html + "<td>" + '<input type="checkbox" id="res' + data[i]["id"]  +'"><label for="1"></label>'  + "</td>";
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
        
    //SetPageLoading(false);
    //SetBindings();
}

function SetBindings(){
    
}

/**
 * Borra toda la tabla de reservas excepto la primera row
 * que contiene el encabezad de la tabla con los nombres de cada columna.
 */
function CleanTable(){
    pTabla = $(".reserva-backend table tr:not(:first)"); // Seleccionamos toda la tabla excepto su encabezado
    $(pTabla).html("");
}

/**
 * Hace una llamada AJAX al servidor, pero no es ASINCRONA!! Esto esta hecho para que se le de tiempo a cargar
 * de la base de datos los turnos disponibles, para que mas adelante dichos string puedan ser cargados
 * sin ningun problema.
 */
function CargarTurnosFromDB(){
    gTurnos = new Array();
    
    $.ajax({
        url: "turnosdisponibles",
        data: null,
        success: function(data){
            for(var i=0; i < data.length; i++){
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
function ucfirst(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
}

/***************************************************/

function DisplayProximasReservas(){
    $.get(  "proximasreservas",
            function(data){
                gDatos = data;
                PrintReservasTable(data, true);
    },"json");
}

function Display(){
    $.get(  "proximasreservas",
            function(data){
                gDatos = data;
                PrintReservasTable(gData, true);
    },"json");
}

function SetPageLoading(loading){
    console.log("estado carga: " + loading);
    if(loading){
        $("#reserva-loading-screen").show();
        $("#reserva-loading-gif").show();
    }else{
        $("#reserva-loading-screen").hide();
        $("#reserva-loading-gif").hide();
    }
}