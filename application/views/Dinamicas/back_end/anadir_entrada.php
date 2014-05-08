<section>
    <form role="form" class="formulario_entradas">
        <div class="col_form_uno">

            <div class="form-group">
                <label for="ejemplo_email_1">Titulo</label>
                <input type="text" class="form-control" id="ejemplo_email_1"
                       placeholder="Introduce el titulo">
            </div>
            <div class="form-group">
                <label>Cabecera</label>
                <textarea class="form-control textArea_noResize" rows="2" placeholder="Introduce un resumen de la noticia..."></textarea>
            </div>
        </div>
        <div class="col_form_dos">

            <div class="form-group">
                <label for="ejemplo_email_1">Autor</label>
                <input type="text" class="form-control" id="ejemplo_email_1"
                       placeholder="Introduce el titulo">
            </div>
            <div class="form-group">
                <label>Categoria</label>
                <select class="form-control" >
                    <option value="">Selecciona Categoria</option>
                    <option value="recetas">Recetas</option>
                    <option value="noticias">Noticias</option>
                    <option value="recetas">Reservas</option>
                    <option value="noticias">Offtopic</option>
                </select>
            </div> 
        </div>
        <div class="col_form_tres">
            <div class="form-group">
                <label>Contenido</label>
                <textarea class="form-control textArea_noResize" rows="5" placeholder="Introduce el contenido..."></textarea>
            </div>
        </div>
        <div class="btn_publicar">
             <button type="button" class="btn btn-primary">Publicar</button>
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

