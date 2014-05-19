
<?php
echo"SHARINGAN";
foreach ($articulo as $item) {
    ?>
    <div class="ficha_articulos">
        <div class="articulos">
            <div class="descripcion_articulo">
                <table border="0" class="table " cellpadding="1">
                    <tr>
                        <td rowspan="3">
                            <input type='checkbox' value='activar' style="margin: 850% 0% 0% 0%">
                        </td>
                        <th colspan="2">
                    <center>
                        
                        <input type="hidden" id="id_art" value="<?php $item->id_art; ?>"/> 
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
                        <td colspan="2" style="background-color:   permanent; border-radius: 15px; ">
                    <center> Fecha: <strong><?php echo $item->fecha_art; ?></strong> -- by. <strong><?php echo $item->autor_art; ?></strong></center>  
                    </td>
                    <td>
                            
                    </td>
                    </tr>
                </table>
                
                <div class = "cols-xs-12 col-sm-12 col-md-12  col-lg-12">
                   <!-- <a href = "http://localhost/douzo/index.php/back_end/entradas/modificar"> -->
                   <a href="entradas/<?php echo $item->url_art; ?> ">
                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <button type = "button" class = "btn btn-info">Modificar articulo</button>
                        </div></a>
                    <a href = "#">
                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <button type = "button" class = "btn btn-danger">Borrar articulo</button>
                        </div></a>
                        
                </div>
            </div> 
       
                 
        </div>
     
          <?php
    }
    