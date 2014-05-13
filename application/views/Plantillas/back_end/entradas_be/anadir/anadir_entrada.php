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
<script>
    $(document).ready(function() {

        $("#publicar").click(function() {

            titulo = $("#titulo").val();
            cabecera = $("#cabecera").val();
            autor = $("#autor").val();
            categoria = $("#categoria").val();
            contenido = $("#contenido").val();


            if (titulo !== "" && cabecera !== "" && autor !== "" && categoria !== "" && contenido !== "") {

                $.ajax({url: "<?php echo base_url() . 'index.php/back_end/entradas/anadir'; ?>", type: 'POST', data: {titulo: title, texto: txt}, success: function(result) {
                        $("#rest").html(result);

                    }});

            } else {

                $("#rest").html("No deje campos vacíos");

            }

        });

    });
</script>

<section>
    <?php //echo validation_errors(); // --> Metodo que muestra los errores del formulario ?> 
    <form role="form" class="formulario_entradas" method="post" action="http://localhost/douzo/index.php/form/validar">
        <div class="col_form_uno">

            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Introduce el titulo">
                <?php echo form_error('titulo'); ?>
            </div>
            <div class="form-group">
                <label>Cabecera</label>
                <input type="text" name="cabecera" id="cabecera" class="form-control textArea_noResize" rows="2" placeholder="Introduce un resumen de la noticia...">
                <?php echo form_error('cabecera'); ?>
            </div>
        </div>
        <div class="col_form_dos">

            <div class="form-group">
                <label for="autor">Autor</label>
                <input name="autor" type="text" class="form-control" id="autor" placeholder="Introduce el titulo">
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
                <textarea name="contenido" id="contenido" class="form-control textArea_noResize" rows="5" placeholder="Introduce el contenido..."></textarea>
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



