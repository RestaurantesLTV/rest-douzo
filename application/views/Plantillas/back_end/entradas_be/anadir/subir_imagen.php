<aside>    
    <!--<div class="foto_prueba">
        <?php //foreach ($upload_data as $item): ?>
            <img src="<?php //echo $item->ruta; ?>"/>
            
        <?php //endforeach; ?>
        </div>-->
    
        <?php  @$error ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/btnUp.js"> </script> 
        <div class="upload_foto">
            <?php $attr = array('class' => 'form_img'); ?>
            <span><?php // echo validation_errors();  ?></span>
            <?= form_open_multipart(base_url() . "imagenes/tratar_imagen",$attr) ?>
            <label>Título:</label><input type="text" name="titulo" style="width: 100%; border-radius: 5px; background-color: #f7f7f7"/>
            <label>Imagen articulo</label><input type="file" name="userfile" class="filestyle" data-icon="false" data-buttonText="Selecciona" /><br /><br />
            <input type="submit" class="btn btn-success"value="Subir imagen" />
            <?= form_close() ?>
         </div>
</aside>
 