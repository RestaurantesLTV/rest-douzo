<section>
    <?php
    echo form_open('entradas_be','anadirEntrada');
    echo form_label('Titulo', 'titulo');
    echo form_input('titulo');
    echo '<br>';
    echo form_label('Cabecera', 'cabecera');
    echo form_input('cabecera');
    echo '<br>';
    echo form_label('Contenido', 'contenido');
    echo form_input('contenido');
    echo '<br>';
    echo form_label('Autor', 'autor');
    echo form_input('autor');
    echo '<br>';
    echo form_submit('btn_publicar', 'Publicar');
    echo form_close();
    ?>
</section>

