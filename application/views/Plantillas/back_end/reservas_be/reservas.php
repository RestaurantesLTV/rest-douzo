
<!-- CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-reserva.css">

<!-- JS -->
<script src="<?php echo base_url(); ?>assets/js/be_reservas_ajax.js"></script>
<div id="reserva-loading-screen"></div> <!-- Pantalla de carga trasparente que cubre toda la pantalla -->
<div id="reserva-loading-gif"></div> <!-- Barra de carga que aparece en la mitad de la pantalla cuando la web esta en fase de carga -->
<div id="Contenido-Principal">
    
    <!-- BEG INICIO -->
    
    <div id='reserva-inicio' class="reserva-backend">
        <img src="<?php echo base_url();?>assets/images/uncle_sam.jpg"/>
    </div>
    
    
    <!-- END INICIO -->
    
    <!-- BEG RESERVA TABLE -->
    <div id='reserva-tabla' class="reserva-backend">
        <table>
            <tr class="navegacion">
                <td>
                    Seleccionar
                </td>
                <td>
                    ID Reserva
                </td>
                <td>
                    Nombre
                </td>
                <td>
                    Fecha
                </td>
                <td>
                    Hora
                </td>
                <td>
                    Turno
                </td>
            </tr>
        </table>
        <footer id='reserva-tabla-footer'>
            <button class="reserva-button">ADASD</button>
            <button class="reserva-button">ADASD</button>
            <button class="reserva-button">ADASD</button>
            <button class="reserva-button">ADASD</button>
        </footer>
    </div>
    <!-- END RESERVA TABLE -->
    
        <!-- BEG RESERVA TABLE -->
    <div id='reserva-notificaciones' class="reserva-backend">
        <table>
            <tr class="navegacion">
                <td>
                    Seleccionar
                </td>
                <td>
                    Fecha
                </td>
                <td>
                    Asunto
                </td>
            </tr>
        </table>
        <footer id='reserva-tabla-footer'>
            <button class="reserva-button" id="reserva-visto-btn">Marcar como visto</button>
        </footer>
    </div>
    <!-- END RESERVA TABLE -->
    
    
    
    
</div>  <!-- Contenido-Principal.  -->