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
    <form role="form" class="formulario_entradas" method="post" action="http://localhost/douzo/index.php/form/validar">
        <div class="col_form_uno">

            <div class="form-group">
                <label for="ejemplo_email_1">Titulo</label>
                <input type="text" class="form-control" id="ejemplo_email_1" name="titulo" placeholder="Introduce el titulo">
                <?php echo form_error('titulo');?>
            </div>
            <div class="form-group">
                <label>Cabecera</label>
                <input type="text" name="cabecera"class="form-control textArea_noResize" rows="2" placeholder="Introduce un resumen de la noticia...">
                <?php echo form_error('cabecera');?>
            </div>
        </div>
        <div class="col_form_dos">

            <div class="form-group">
                <label for="ejemplo_email_1">Autor</label>
                <input name="autor" type="text" class="form-control" id="ejemplo_email_1" placeholder="Introduce el titulo">
                <?php echo form_error('autor');?>
            </div>
            <div class="form-group">
                <label>Categoria</label>
                <select name="opciones" class="form-control" >
                    <option value="" selected="selected">Selecciona Categoria</option>
                    <option value="recetas" <?php echo set_select('opciones','recetas'); ?>>Recetas</option>
                    <option value="noticias"<?php echo set_select('opciones','noticias'); ?>>Noticias</option>
                    <option value="reservas"<?php echo set_select('opciones','reservas'); ?>>Reservas</option>
                    <option value="offtopic"<?php echo set_select('opciones','offtopic'); ?>>Offtopic</option>
                </select>
                <?php echo form_error('opciones');?>
            </div> 
        </div>
        <div class="col_form_tres">
            <div class="form-group">
                <label>Contenido</label>
                <textarea name="contenido" class="form-control textArea_noResize" rows="5" placeholder="Introduce el contenido..."></textarea>
            <?php echo form_error('contenido');?>
            </div>
        </div>
        <div class="btn_publicar">
            <button type="submit" class="btn btn-primary" name="enviar">Publicar</button>
             <button type="button" class="btn btn-info">Limpiar</button>
        </div>
        
        <!--<div class="form-group">
            <label for="ejemplo_archivo_1">Adjuntar un archivo</label>
            <input type="file" id="ejemplo_archivo_1">
            <p class="help-block">Ejemplo de texto de ayuda.</p>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox"> Activa esta casilla
            </label>
        </div>-->


    </form>
    <!--
        //<?php // echo validation_errors();          ?>
        <div class="formulario_entradas">
            //php echo form_open('form'); ?>
           
                <h5>Titulo</h5>
                <input type="text" name="titulo" value="" size="50" />
    
                <h5>Autor</h5>
                <input type="text" name="autor" value="" size="50" />
    
                <h5>Categoria</h5>
                <select>
                    <option value="">Selecciona Categoria</option>
                    <option value="recetas">Recetas</option>
                    <option value="noticias">Noticias</option>
                    <option value="recetas">Reservas</option>
                    <option value="noticias">Offtopic</option>
                </select>
                <div id="btn_submit_form"><button type="button" class="btn btn-success">Publicar</button></div>
            </div>
            <div class="col_form_dos">
                <h5>Cabecera</h5>
                <textarea rows="4" cols="60">
        Escriba aquí...
                </textarea>
    
                <h5>Contenido</h5>
                <textarea rows="8" cols="60">
        Escriba aquí...
                </textarea>
    
                
            </div>
            </form>
        </div>-->
</section>

