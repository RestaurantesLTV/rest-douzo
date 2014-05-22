<link rel="stylesheet" href="<?php base_url(); ?>/douzo/assets/css/menu.css">


<div id="btn-menu"></div>

<div id='cssmenu'>
    <ul>
        <li class='active'><a href='#'><span>Inicio</span></a></li>
        <li class='has-sub'><a href='#'><span>Notificaciones</span></a>
        <li class='has-sub'><a href='#'><span>Correo</span></a>
            <ul>
                <li><a href='#'><span>Bandeja de entrada</span></a></li>
                <li class='last'><a href='#'><span>Bandeja de salida</span></a></li>
            </ul>
        </li>
        <li class='has-sub'><a href='#'><span>Reservas</span></a>
            <ul>
                <li><a id="proximas_reservas" href='#'><span>Próximas reservas</span></a></li>
                <li><a id="ultimos7dias" href='#'><span>&Uacute;ltimos 7 dias</span></a></li>
                <li><a id="reservas_completadas" href='#'><span>Reservas completadas</span></a></li>
                <li class=''><a id="todas_las_reservas" href='#'><span>Todas las reservas</span></a></li>
                <li  class='last'><input id="calendar" placeholder="Fecha concreta" style='width:100%' type="text"/></li>
            </ul>
        </li>
        <li class='has-sub'><a href='#'><span>Configuracion</span></a>
            <ul>
                <li><a href='#'><span>Nombre restaurante</span></a></li>
                <li><a href='#'><span>Email restaurante</span></a></li>
                <li><a href='#'><span>Horarios</span></a></li>
                <li class='last'><a href='#'><span>Festivos</span></a></li>
            </ul>
        </li>
    </ul>

</div>
<script type="text/javascript" src= " <?php base_url(); ?>/douzo/assets/js/menu.js" ></script>