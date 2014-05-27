<div
    <div class="content_det">
        <div class="titulo_det"><strong><h1 style="font: normal 48px/60px 'bonzai', Arial, sans-serif; background: transparent;"> <?php echo $detalle->titulo_art; ?> </h1></strong></div><br>


        <center><div class="contenido_det">
                <div class="imagen_det"><img width="630" height="450"  style="border-radius: 5%; "src="<?php echo $detalle->imagen_art ?>"></div>
                <p><?php echo $detalle->contenido_art; ?> </p> <br>
                <hr>
                <strong>Fecha publicación: <?php echo $detalle->fecha_art; ?></strong>
                <p> <?php echo $detalle->autor_art; ?> </p><br><br>

            </div>
        </center>
    </div>
</div>
<div id="bambu_grande">
    <img class="bambuG_det" src="<?php echo base_url(); ?>assets/images/bambu.png" alt="Moonlight cooking" />
</div>
<div id="bambu_pequeño">
    <img class="bambuP_det"src="<?php echo base_url(); ?>assets/images/bambu.png" alt="Moonlight cooking" />

</div>