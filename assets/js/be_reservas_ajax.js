//Environment variables

var gTurno = "";
var gDatos = new Array(); // Para Reservas
var gNotificaciones = new Array(); // Para notificaciones
var gTurnos = undefined;
var gSeccionReserva = "";

// Variables de filtracion. Nos sirve para alternar entre orden ascendente y descendente.
var gToggle = {
    'nombre': false,
    'id': false,
    'menu': false,
    'fecha-notificaciones': false,
    "checkbox": false
}


$(document).ready(function() {
    CargarTurnosFromDB(); // Carga los Strings correspondientes a los numeros de los turnos en el restaurante.
    CambiarSeccion("reserva-inicio");
    SetInitialBindings();
    SetPageLoading(false);
});

function LimpiarVariables() {
    for (var propiedad in gToggle) {
        gToggle[propiedad] = false;
        //console.log(propiedad + ": " + gToggle[propiedad]);
    }
}

function PopUp(element_id) {
    $('#' + element_id).bPopup({
        modalClose: true,
        opacity: 0.6,
        positionStyle: 'fixed', //'fixed' or 'absolute'
        modalColor: "#99CCFF",
        onClose: function(element) {
            $("#" + element_id).remove();
        }
    });
}

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

    LimpiarVariables();
    gSeccionActual = id_seccion;
    $("#Contenido-Principal").children().hide();
    $("#" + id_seccion).show();
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
        CambiarSeccion("reserva-tabla");
        gSeccionReserva = "todaslasreservas";
        $.get("todaslasreservas",
                function(data) {
                    gDatos = data;
                    PrintReservasTable(data, true);
                }, "json");
    });

    $(pReservas_completadas).click(function() {
        CambiarSeccion("reserva-tabla");
        gSeccionReserva = "reservascompletadas";
        $.get("reservascompletadas",
                function(data) {
                    gDatos = data;
                    PrintReservasTable(data, true);
                }, "json");
    });

    $(pUtimos7dias).click(function() {
        CambiarSeccion("reserva-tabla");
        gSeccionReserva = "ultimos7dias";
        $.get("ultimos7dias",
                function(data) {
                    gDatos = data;
                    PrintReservasTable(data, true);
                }, "json");
    });

    $(pProximas_reservas).click(function() {
        CambiarSeccion("reserva-tabla");
        gSeccionReserva = "proximasreservas";
        console.log("Proximas reservas")
        $.get("proximasreservas",
                function(data) {
                    gDatos = data;
                    PrintReservasTable(data, true);
                }, "json");
    });

    $("#reserva_no_verificada").click(function() {
        CambiarSeccion("reserva-tabla");
        gSeccionReserva = "noverificadas";
        $.get("noverificadas",
                function(data) {
                    gDatos = data;
                    PrintReservasTable(data, true);
                }, "json");
    });

    $("#reserva-menu-notificaciones").click(function() {
        CambiarSeccion("reserva-notificaciones");
        $.get("notificaciones",
                function(data) {
                    gNotificaciones = data;
                    PrintNotificacionesTable(data);
                }, "json");
    });

    $("#reserva-visto-btn").click(function() {
        MarcarComoVistas();
    });

    $("#reserva-borrar").click(function() {
        BorrarReservas();
    });


    // SELECCIONAR TODOS LOS CHECKBOX

    $("#reserva-tabla table td").eq(0).click(function() { // Columna "Seleccionar"
        //Seleccionamos todos los checkbox
        console.log("Clickeado");
        SelectAllCheckbox("reserva-tabla");
    });
    
    $("#reserva-notificaciones table td").eq(0).click(function() { // Columna "Seleccionar"
        //Seleccionamos todos los checkbox
        SelectAllCheckbox("reserva-notificaciones");
    });

    /*************************************************/
    // Filtrar por columna

    $(".reserva-backend table td").eq(1).click(function() { // Columna "ID Reserva"
        FiltrarPorIDReserva();
    });

    $(".reserva-backend table td").eq(2).click(function() { // Columna "Nombre"
        FiltrarPorNombre();
    });

    $(".reserva-backend table td").eq(3).click(function() { // Columna "Hora"
        //FiltrarPorFecha(gDatos);
        alert("Por implementar");
    });

    $(".reserva-backend table td").eq(4).click(function() { // Columna "Turno"
        alert("Por implementar");
    });


}

function SelectAllCheckbox(id_element) {
    var valor;
    if (gToggle['checkbox']) {
        valor = false;
    } else {
        valor = true;
    }

    $("#" + id_element).find("input[type=checkbox]").prop("checked", valor);
    gToggle['checkbox'] = !gToggle['checkbox'];
}

function PrintNotificacionesTable(data, debug) {
    if (data == null) {
        alert("No hay notificaciones disponibles!");
        return;
    }
    LimpiarVariables();
    
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

function BorrarReservas() {
    var ids = new Array();
    $('#reserva-tabla table tr:not(:eq(0)) input[type=checkbox]').each(function(index, element) {
        //datos_index = ($(element).attr("id")).split("-")[1];
        if (element.checked) {
            ids[ids.length] = gDatos[index]['id'];
        }

    });

    if (ids.length != 0) {
        var string_get = "";
        for (var i = 0; i < ids.length; i++) {
            string_get = string_get + "borrar[]=" + ids[i];
            if ((i + 1) != ids.length) {
                string_get = string_get + "&";
            }
        }

        $.get("borrar_reserva?" + string_get, function(respuesta) {
            if (respuesta) {
                $.get(gSeccionReserva,
                        function(data) {
                            gDatos = data;
                            
                            PrintReservasTable(gDatos); // Actualizamos
                        }, "json");
            }
        });
    }
}

/**
 * Agrega nuevas filas a la tabla de reservas.
 * Antes de hacerlo limpia todas las filas que hay.
 * @param Object[] data
 * @param boolean debug
 */
function PrintReservasTable(data, debug) {
    gToggle['checkbox'] = false;
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

        var fecha_reserva = new Date(data[i]["fecha_reservada"]);


        html = html + "<tr id='DatosRef-" + i + "'>";
        html = html + "<td class='reserva_selec_col'>" + '<input type="checkbox" id="res' + data[i]["id"] + '"><label for="1"></label>' + "</td>";
        html = html + "<td>" + data[i]["id"] + "</td>";
        html = html + "<td>" + data[i]["nombre"] + " " + data[i]['apellido'] + "</td>";
        html = html + "<td>" + fecha_reserva.toLocaleDateString() + "</td>";
        html = html + "<td>" + data[i]["hora_reservada"] + "</td>";
        html = html + "<td>" + turno_string + "</td>";
        html = html + "</tr>";
    }
    html = html + "</table>";

    var pTabla = $("#reserva-tabla table").append(html);

    SetPageLoading(false);
    SetRowBindings();
}

/*function FiltrarPorFechaYHora(datos) {
 datos.sort(function(a, b) {
 if (gToggle['fecha-notificaciones']) {
 if (a['fecha'] > b['fecha']) {
 return 1;
 }
 if (a['fecha'] < b['fecha']) {
 return -1;
 }
 }
 
 });
 gToggle['fecha-notificaciones'] = !gToggle['fecha-notificaciones'];
 
 }*/



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
        $(this).click(function(e) {

            // Si no clickeamos la primera columna  (donde estan situados los checkbox)
            if ($(e.target).parents(".reserva_selec_col").length <= 0 && $(e.target).attr("class") != "reserva_selec_col") {
                datos_index = ($(element).attr("id")).split("-")[1];
                PrintJSON(gDatos[datos_index]);
            }
        });
    });
}

/**
 * Funciona siempre y cuando no se filtre!
 * @returns {undefined}
 */
function MarcarComoVistas() {
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
    $verificado = json['verificado'];

    if ($verificado == 1) {
        $verificado = "Si";
    } else {
        $verificado = "No";
    }

    var id_turno = parseInt(json['id_turno']) - 1;
    var turno_string = gTurnos[id_turno];

    var idElement = "reserva-popup-" + json['id'];
    texto = "<table id='" + idElement + "' class='CSSTableGenerator'>";
    // Header Tabla
    texto = texto + getPopUpTableHeader();
    texto = texto + "<tr>";
    texto = texto + "<td>" + json['nombre'] + " " + json['apellido'] + "</td>";
    texto = texto + "<td>" + json['codigo'] + "</td>";
    texto = texto + "<td>" + json['datetime_registro'] + "</td>";
    texto = texto + "<td>" + json['fecha_reservada'] + " " + json['hora_reservada'] + "</td>";
    texto = texto + "<td>" + json['email'] + "</td>";
    texto = texto + "<td>" + turno_string + "</td>";
    texto = texto + "<td>" + json['num_personas'] + "</td>";
    texto = texto + "<td>" + json['telefono'] + "</td>";
    texto = texto + "<td>" + $verificado + "</td>";
    texto = texto + "</tr>";


    //Observaciones
    texto = texto + "<tr><td colspan='9' style=''>";
    texto = texto + "<center><textarea readonly>" + json['observaciones'] + "</textarea></center>";
    texto = texto + "</td></tr>";



    texto = texto + "</table>";


    $("body").append(texto);
    PopUp(idElement);
    //alert(texto);
}

function getPopUpTableHeader() {
    var texto = "";
    texto = texto + "<tr>";
    texto = texto + "<td>Nombre completo</td>";
    texto = texto + "<td>Codigo</td>";
    texto = texto + "<td>Fecha de registro</td>";
    texto = texto + "<td>Fecha de reserva</td>";
    texto = texto + "<td>Email</td>";
    texto = texto + "<td>Turno</td>";
    texto = texto + "<td>Personas</td>";
    texto = texto + "<td>Telefono</td>";
    texto = texto + "<td>Verificado</td>";
    texto = texto + "</tr>";
    return texto;
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