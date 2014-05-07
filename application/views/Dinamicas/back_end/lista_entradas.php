
<?php
foreach ($articulo as $item) {
    ?>
    <div class="ficha_articulos">
        <div class="descripcion_articulo"> 
            <table border="0" class="tabla_articulos" cellpadding="1">
                <tr>
                    <td rowspan="3">
                        <input type='checkbox' value='activar'>
                    </td>
                    <th colspan="2">
                <center>
                    <h2><b><?php echo $item->titulo_art ?></b></h2> 
                </center>
                </th>
                <th>

                </th>
                </tr>
                <tr>
                    <td>
                        <?php echo $item->contenido_art; ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                <center> Fecha: <strong><?php echo $item->fecha_art; ?></strong> -- by. <strong><?php echo $item->autor_art; ?></strong></center>  
                </td>
                <td>

                </td>
                </tr>
        </div>
        
        </table>
            <hr  style=" color: black">
    </div>
    <?php
}
    