<aside>    
    <!--<div class="foto_prueba">
        <?php //foreach ($upload_data as $item): ?>
            <img src="<?php echo $item->ruta; ?>"/>
            
        <?php //endforeach; ?>
        </div>-->
    
        <?php  @$error ?>
    
        <div class="upload_foto">
            <span><?php // echo validation_errors();  ?></span>
            <?= form_open_multipart(base_url() . "/index.php/imagenes/procesar_imagen") ?>
            <label>Título:</label><input type="text" name="titulo" />
            <label>Imagen 1:</label><input type="file" name="userfile" /><br /><br />
            <input type="submit" value="Subir imágenes" />
            <?= form_close() ?>
    </div>
</aside>
