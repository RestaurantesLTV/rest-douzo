<aside>    
    <div class="foto_prueba">
        <p> Foto aqui </p>
    </div>
    <div class="upload_foto">
        <form action="<?php echo base_url(); ?>index.php/imagenes/procesar_imagen" enctype="multipart/form-data" method="post">
            <input type="file" name="userfile">
            <br>
            <input class="btn btn-default" type="submit" name="subir" value="Subir Imagen">
        </form>
    </div>
</aside>