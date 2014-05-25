//Environment variables

var gTurno = "";
var gDatos = new Array(); // Para Reservas
var gNotificaciones = new Array(); // Para notificaciones
var gTurnos = undefined;

// Variables de filtracion. Nos sirve para alternar entre orden ascendente y descendente.
var gToggle = {
    'nombre': true,
    'id': true,
    'menu': true
}


$(document).ready(function() {
    CargarTurnosFromDB(); // Carga los Strings correspondientes a los numeros de los turnos en el restaurante.
    CambiarSeccion("reserva-inicio");
    SetInitialBindings();
    SetPageLoading(false);
});

/**
 * Ocultan todos los divs de la pagina, y muestra aquel que corresponde
 * a esa seccion en el backend.
 * Leyenda 'gSeccionActual':
 *      reserva-tabla
 *      reserva-inicio
 *      reserva-notificaciones
 * 
 * @param {type} id_seccion
 * @returns {undefined}
 */
function CambiarSeccion(id_seccion) {
    gSeccionActual = id_seccion;
    $("#Contenido-Principal").children().hide();
    $("#" + id_seccion).show();
}

/*
 * Desplaza el menu (Oculta o lo hace visible).
 * Para ello, el objeto a ser movido debe tener la siguiente propieda CSS:
 * 'Position: relative', ya que se mueve relativamente desde su posicion 'x' pixeles.
 * @param boolean b
 * @returns {undefined}
 */
function ShowMenu(b) {
    var desplazamiento;
    if (b) {
        desplazamiento = "+=200px";
        if (gToggle['menu'])
            return; // Evitamos el desplazamiento si ya esta visible
        gToggle['menu'] = true;
    } else {
        desplazamiento = "-=200px";
        if (!gToggle['menu'])
            return; // Evitamos el desplazamiento si ya esta oculto
        gToggle['menu'] = false;
    }
    $("#cssmenu").clearQueue().stop();

    $("#cssmenu").animate({
        left: desplazamiento,
    }, 1000);
}

function SetInitialBindings() {
    var pInicio = $("#reserva-menu-inicio");
    var pProximas_reservas = $("#proximas_reservas");
    var pReservas_completadas = $("#reservas_completadas");
    var pTodas_las_reservas = $("#todas_las_reservas");
    var pUtimos7dias = $("#ultimos7dias");

    $("#reserva-nombre-restaurante").click(function() {
        var string = prompt("Introduzca un nuevo nombre del restaurante: ");
        ModificarConfig("nombre", string);
    });

    $("#reserva-email-restaurante").click(function() {
        var string = prompt("Introduzca un nuevo email para el restaurante: ");
        ModificarConfig("email", string);
    });

    $("#reserva-horarios").click(function() {
        alert("Por implementar");
    });
    $("#reserva-festivos").click(function() {
        alert("Por implementar");
    });

    $(pInicio).click(function() {
        CambiarSeccion("reserva-inicio");
    });

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

    $("#reserva-menu-notificaciones").click(function() {
        //CambiarSeccion("reserva-notificaciones");
        //CleanTable("reserva-notificaciones");
        $.get("notificaciones",
                function(data) {
                    gNotificaciones = data;
                    //console.log(data);
                    PrintNotificacionesTable(data);
                }, "json");
    });

    $("#reserva-visto-btn").click(function() {
        DeleteSelectedRows();
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
        //FiltrarPorFecha();
        alert("Por implementar")
    });

    $(".reserva-backend table td").eq(4).click(function() { // Columna "Turno"
        alert("Por implementar")
    });


}

function PrintNotificacionesTable(data, debug) {
    CambiarSeccion("reserva-notificaciones");
    CleanTable("reserva-notificaciones");
    SetPageLoading(true);
    var html = "";

    for (var i = 0; i < data.length; i++) {
        html = html + "<tr id='NotifRef-" + i + "'>";
        html = html + "<td>" + '<input type="checkbox" id="notif' + data[i]["id"] + '"><label for="1"></label>' + "</td>";
        html = html + "<td>" + data[i]["datetime_registro"] + "</td>";
        html = html + "<td>" + data[i]['asunto'] + "</td>";
        html = html + "</tr>";
    }
    html = html + "</table>";

    var pTabla = $("#reserva-notificaciones table").append(html);

    SetPageLoading(false);
    //SetRowBindingsNotificaciones();

}

/**
 * Hace una peticion ajax al servidor pidiendole que modifique
 * el fichero de configuracion del sistema de reservas.
 * @param String peticion
 * @param String valor
 */
function ModificarConfig(peticion, valor) {
    $.get("modificarconfig?req=" + peticion + "&valor=" + valor, function(data) {
        console.log("Nombre restaurante cambiado. El servidor dice: " + data);
    });
}

/**
 * Agrega nuevas filas a la tabla de reservas.
 * Antes de hacerlo limpia todas las filas que hay.
 * @param Object[] data
 * @param boolean debug
 */
function PrintReservasTable(data, debug) {
    //UnbindLastRows();    
    CambiarSeccion("reserva-tabla");
    CleanTable("reserva-tabla");
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

        html = html + "<tr id='DatosRef-" + i + "'>";
        html = html + "<td>" + '<input type="checkbox" id="res' + data[i]["id"] + '"><label for="1"></label>' + "</td>";
        html = html + "<td>" + data[i]["id"] + "</td>";
        html = html + "<td>" + data[i]["nombre"] + " " + data[i]['apellido'] + "</td>";
        html = html + "<td>" + data[i]["fecha_reservada"] + "</td>";
        html = html + "<td>" + data[i]["hora_reservada"] + "</td>";
        html = html + "<td>" + turno_string + "</td>";
        html = html + "</tr>";
    }
    html = html + "</table>";

    var pTabla = $("#reserva-tabla table").append(html);

    SetPageLoading(false);
    SetRowBindings();
}

function FiltrarPorFechaYHora(datos) {
    datos.sort(function() {

    });
}



/**
 * Esta rutina debe llamarse cada vez que se desee dibujar la tabla.
 * Su funcion es la de asignarle un evento click a cada fila de la tabla.
 * Al hacer click lo que hara es lo siguiente:
 * De la fila clickeada, obtendremos el ID que hace referencia
 * a la informacion a esa fila en el array "gDatos".
 * Una vez sepamos la el index del array en esa fila de la tabla,
 * llamamos a PrintJSON para que nos aparezca por pantalla la informacion
 * de esa reserva en concreto.
 * 
 * Funcion testeada. Funciona a la perfeccion.
 */
function SetRowBindings() {
    $('#reserva-tabla table tr:not(:eq(0))').each(function(index, element) {
        $(this).click(function() {

            datos_index = ($(element).attr("id")).split("-")[1];
            PrintJSON(gDatos[datos_index]);
        });
    });
}

/**
 * Funciona siempre y cuando no se filtre!
 * @returns {undefined}
 */
function DeleteSelectedRows() {
    var ids = new Array();
    $('#reserva-notificaciones table tr:not(:eq(0)) input[type=checkbox]').each(function(index, element) {
        //datos_index = ($(element).attr("id")).split("-")[1];
        if (element.checked) {
            ids[ids.length] = gNotificaciones[index]['id'];
        }


    });

    if (ids.length != 0) {
        var string_get = "";
        for (var i = 0; i < ids.length; i++) {
            string_get = string_get + "marcar[]=" + ids[i];
            if ((i + 1) != ids.length) {
                string_get = string_get + "&";
            }
        }
        $.get("marcarcomovisto?" + string_get, function(respuesta) {
                $.get("notificaciones",
                        function(data) {
                            gNotificaciones = data;
                            //console.log(data);
                            PrintNotificacionesTable(data);
                        }, "json");
            
        });
    }

}

/**
 * A partir de un objeto JSON de la reserva, imprimimos toda su informacion
 * en un pop up.
 * @param JSON json
 */
function PrintJSON(json) {
    var texto = "";
    var endline_ch = "\n";
    texto = texto + endline_ch + "Nombre: " + json['nombre'];
    texto = texto + endline_ch + "Apellido: " + json['apellido'];
    texto = texto + endline_ch + "Codigo: " + json['codigo'];
    texto = texto + endline_ch + "Datetime_registro: " + json['datetime_registro'];
    texto = texto + endline_ch + "email: " + json['email'];
    texto = texto + endline_ch + "fecha_reservada: " + json['fecha_reservada'];
    texto = texto + endline_ch + "hora_reservada: " + json['hora_reservada'];
    texto = texto + endline_ch + "id: " + json['id'];
    texto = texto + endline_ch + "id_turno: " + json['id_turno'];
    texto = texto + endline_ch + "ip: " + json['ip'];
    texto = texto + endline_ch + "num_personas" + json['num_personas'];
    texto = texto + endline_ch + "num_verificaciones: " + json['num_verificaciones'];
    texto = texto + endline_ch + "observaciones: " + json['observaciones'];
    texto = texto + endline_ch + "telefono: " + json['telefono'];
    texto = texto + endline_ch + "verificado: " + json['verificado'];
    alert(texto);
}

/**
 * Borra toda la tabla de reservas excepto la primera row
 * que contiene el encabezad de la tabla con los nombres de cada columna.
 */
function CleanTable(nombreTabla) {
    pTabla = $("#" + nombreTabla + " tr:not(:first)"); // Seleccionamos toda la tabla excepto su encabezado
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
        //ASCENDENTE
        if (gToggle['id']) {
            if (a['id'] > b['id']) {
                return 1;
            }
            if (a['id'] < b['id']) {
                return -1;
            }
        } else { // DESCENDENTE
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

function FiltrarPorNombre() {
    //Primero al reves
    gDatos.sort(function(a, b) {
        var nameA = a['nombre'].toLowerCase();
        var nameB = b['nombre'].toLowerCase();

        // ASCENDENTE
        if (gToggle['nombre']) {
            if (nameA > nameB)
                return -1
            if (nameA < nameB)
                return 1
        } else { // DESCENDENTE

            if (nameA < nameB)
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