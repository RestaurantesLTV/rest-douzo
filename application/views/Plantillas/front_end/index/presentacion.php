
<?php
foreach ($articulo as $item) {
    ?>
<section id="front-featured" class="section">
    <article class="article" >
        <div class="img" >
            <img src="<?php echo $item->imagen_art; ?>"/>
        </div>
        <div class="rest">      
            <hgroup class="hgroup">
                <h1 ><?php echo $item->titulo_art; ?></h1>
                <h2 class="subtitle"><?php echo $item->cabecera_art; ?><br /></h2>
            </hgroup>
            <div class="text" >
                <p><?php echo $item->contenido_art; ?></p>
            </div>
        </div>
    </article>

</section>

<?php
}