
<?php
foreach ($articulo as $item) {
    //echo "SHARINGAN: ".$item->id_art;
    ?>
    <div class="ficha_articulos">
        <div class="articulos">
            <div class="descripcion_articulo">
                <table border="0" class="table " cellpadding="1">
                    <tr>

                        <td rowspan="3">
                           
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
                        <td colspan="2" style="background-color:   permanent; border-radius: 15px; ">
                    <center> Fecha: <strong><?php echo $item->fecha_art; ?></strong> -- by. <strong><?php echo $item->autor_art; ?></strong></center>  
                    </td>
                    <td>

                    </td>
                    </tr>
                </table>

                <div class = "cols-xs-12 col-sm-12 col-md-12  col-lg-12">
                    <!-- <a href = "<?php //echo base_url(); ?>/index.php/back_end/entradas/modificar"> -->

                    <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <form action="entradas/<?php echo $item->url_art; ?> ">
                            <input value="Modificar articulo" type = "submit" class = "btn btn-info">
                        </form>
                    </div>
                   
                        <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                           <form action="delete/<?php echo $item->url_art; ?> ">
                                <input value="Borrar articulo" type = "submit" class = "btn btn-danger "/>
                            </form>
                        </div>

                </div>
            </div> 


        </div>

        <?php
    }
    