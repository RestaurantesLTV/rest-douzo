<?php /* EDITOR DE TEXTO */ ?>
<script type="text/javascript">
    tinymce.init({
        selector: "#contenido",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
</script>

<section>
    <?php //echo validation_errors(); // --> Metodo que muestra los errores del formulario ?> 
    <form role="form" class="formulario_entradas" method="post" action="http://localhost/douzo/index.php/back_end/update/<?php echo $detalle->url_art; ?>">
        
       
        <div class="col_form_uno">
            
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" value="<?php echo $detalle->titulo_art; ?>" id="titulo" name="titulo" placeholder="Introduce el titulo">
                <?php echo form_error('titulo'); ?>
            </div>
            <div class="form-group">
                <label>Cabecera</label>
                <textarea name="cabecera" id="cabecera"  class="form-control textArea_noResize" rows="3" placeholder=""><?php echo $detalle->cabecera_art; ?></textarea>
                <!--<input type="text" name="cabecera" value="<?php echo $detalle->cabecera_art; ?>" id="cabecera" class="form-control textArea_noResize" rows="2" placeholder="Introduce un resumen de la noticia...">-->
                <?php echo form_error('cabecera'); ?>
            </div>
        </div>
        <div class="col_form_dos">

            <div class="form-group">
                <label for="autor">Autor</label>
                <input name="autor" type="text" value="<?php echo $detalle->autor_art; ?>"class="form-control" id="autor" placeholder="Introduce el titulo">
                <?php echo form_error('autor'); ?>
            </div>
            <div class="form-group">
                <label>Categoria</label>
                <select name="opciones" id="categoria" class="form-control" >
                    <option value="" selected="selected">Selecciona Categoria</option>
                    <option value="1" <?php echo set_select('opciones', '1'); ?>>Recetas</option>
                    <option value="3"<?php echo set_select('opciones', '3'); ?>>Noticias</option>
                    <option value="2"<?php echo set_select('opciones', '2'); ?>>Reservas</option>
                    <option value="4"<?php echo set_select('opciones', '4'); ?>>Offtopic</option>
                </select>
                <?php echo form_error('opciones'); ?>
            </div> 
        </div>
        <div class="col_form_tres">
            <div class="form-group">
                <label>Contenido</label>
                <textarea name="contenido" id="contenido"  class="form-control textArea_noResize" rows="5" placeholder="Introduce el contenido..."><?php echo $detalle->contenido_art; ?></textarea>
                <?php echo form_error('contenido'); ?>
            </div>
        </div>
        <div class="btn_publicar">
            <button type="submit" id="publicar" class="btn btn-primary" name="enviar">Guardar</button>
            <button type="button" class="btn btn-info">Limpiar</button>
        </div>
        <div id="rest"></div>
    </form>
</section>



