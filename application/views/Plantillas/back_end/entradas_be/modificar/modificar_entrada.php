<?php /* EDITOR DE TEXTO */ ?>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
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
    <form role="form" class="formulario_entradas" method="post" action="http://localhost/douzo/index.php/form/validar_update">
        <div class="col_form_uno">

            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" value="<?php echo $detalle->titulo_art; ?>" id="titulo" name="titulo" placeholder="Introduce el titulo">
                <?php echo form_error('titulo'); ?>
            </div>
            <div class="form-group">
                <label>Cabecera</label>
                <input type="text" name="cabecera" value="<?php echo $detalle->cabecera_art; ?>" id="cabecera" class="form-control textArea_noResize" rows="2" placeholder="Introduce un resumen de la noticia...">
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
                    <option value="recetas" <?php echo set_select('opciones', 'recetas'); ?>>Recetas</option>
                    <option value="noticias"<?php echo set_select('opciones', 'noticias'); ?>>Noticias</option>
                    <option value="reservas"<?php echo set_select('opciones', 'reservas'); ?>>Reservas</option>
                    <option value="offtopic"<?php echo set_select('opciones', 'offtopic'); ?>>Offtopic</option>
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
            <button type="submit" id="publicar" class="btn btn-primary" name="enviar">Publicar</button>
            <button type="button" class="btn btn-info">Limpiar</button>
        </div>
        <div id="rest"></div>
    </form>
</section>



