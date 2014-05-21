<div id="bambu_grande">
    <img class="bambuG" src="http://localhost/douzo/assets/images/bambu.png" alt="Moonlight cooking" />
</div>
<div id="bambu_pequeño">
    <img class="bambuP"src="http://localhost/douzo/assets/images/bambu1.png" alt="Moonlight cooking" />

</div>
<?php
foreach ($articulo as $item) {
    ?>
    <div style="position: relative;">
        <section class="section" id="post-list" >
            <article class="article" id="news-32">
                <div class="rope"></div>
                <div class="img">
                    <img src ="<?php echo base_url(); ?>/assets/images/231x313/blog.jpg" alt="Moonlight cooking" />
                </div>
                <div class="rest">
                    <h2>
                        <a href="#" title="<?php echo $item->titulo_art ?>"><?php echo $item->titulo_art ?></a>

                    </h2>
                    <div class="text">
                        <?php echo $item->contenido_art; ?>
                    </div>
                    <div class="date"><?php echo $item->fecha_art; ?> <a class="read-more" href="#" title="<?php echo $item->titulo_art ?>"> <a href=" blog/<?php echo $item->url_art; ?>" class="light">Leer mas</a><br><br><br /></a>
                    </div>

                </div>
            </article>
        </section>
    </div>
    <?php
}
?>

<!--  ENTRADAS ESTATICAS -------
<article class="article" id="news-31">
    <div class="rope"></div>
    <div class="img">
        <img src="http://localhost/douzo/assets/images/231x313/japan.jpg" alt="Visitors from Japan" />
    </div>
    <div class="rest">
        <h2>
            <a href="news/2012/07/16/visitors-from-japan.html" title="Visitors from Japan">Visitors from Japan</a>

        </h2>
        <div class="text">
            Pellentesque velit velit, malesuada malesuada hendrerit in, sodales in urna. Donec ut metus nibh, sed euismod ante. Duis vulputate, augue et tristique suscipit, urna massa condimentum felis, ac tincidunt magna ligula bibendum justo.
            Nulla facilisi. Fusce libero massa, euismod a venenatis a, rutrum sit amet dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque non turpis nisl, nec interdum nunc.


            Phasellus molestie dolor dui. Integer velit odio, suscipit eget porta in, pretium et nunc. Maecenas ac diam tortor. Integer laoreet posuere ante, ac aliquam metus euismod ac. Mauris lorem mi, iaculis semper pretium vel, lacinia et lacus. Aenean in arcu mi, at auctor metus. Suspendisse orci lorem, dignissim sed mattis in, vestibulum sit amet dui. 
            ...
        </div>
        <div class="date">Fecha: 02.07.2012 &#124; <a class="read-more" href="news/2012/07/16/visitors-from-japan.html" title="Visitors from Japan"><span>Leer más...</span><br /></a>
        </div>

    </div>
</article>
<article class="article" id="news-30">
    <div class="rope"></div>
    <div class="img">
        <img src="http://localhost/douzo/assets/images/231x313/bean.jpg" alt="Single bean" />
    </div>
    <div class="rest">
        <h2>
            <a href="news/2012/07/02/single-bean.html" title="Single bean">Single bean</a>

        </h2>
        <div class="text">
            Pellentesque velit velit, malesuada malesuada hendrerit in, sodales in urna. Donec ut metus nibh, sed euismod ante. Duis vulputate, augue et tristique suscipit, urna massa condimentum felis, ac tincidunt magna ligula bibendum justo.
            Nulla facilisi. Fusce libero massa, euismod a venenatis a, rutrum sit amet dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque non turpis nisl, nec interdum nunc.


            Phasellus molestie dolor dui. Integer velit odio, suscipit eget porta in, pretium et nunc. Maecenas ac diam tortor. Integer laoreet posuere ante, ac aliquam metus euismod ac. Mauris lorem mi, iaculis semper pretium vel, lacinia et lacus. Aenean in arcu mi, at auctor metus. Suspendisse orci lorem, dignissim sed mattis in, vestibulum sit amet dui. 
            ...
        </div>
        <div class="date">Fecha: 02.07.2012 &#124; <a class="read-more" href="news/2012/07/02/single-bean.html" title="Single bean"><span>Leer mas...</span><br /></a>
        </div>

    </div>
</article>
<article class="article" id="news-29">
    <div class="rope"></div>
    <div class="img">
        <img src="http://localhost/douzo/assets/images/231x313/cooking.jpg" alt="Cooking for soul" />
    </div>
    <div class="rest">
        <h2>
            <a href="news/2012/07/02/cooking-for-soul.html" title="Cooking for soul">Cooking for soul</a>

        </h2>
        <div class="text">
            Pellentesque velit velit, malesuada malesuada hendrerit in, sodales in urna. Donec ut metus nibh, sed euismod ante. Duis vulputate, augue et tristique suscipit, urna massa condimentum felis, ac tincidunt magna ligula bibendum justo.
            Nulla facilisi. Fusce libero massa, euismod a venenatis a, rutrum sit amet dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque non turpis nisl, nec interdum nunc.


            Phasellus molestie dolor dui. Integer velit odio, suscipit eget porta in, pretium et nunc. Maecenas ac diam tortor. Integer laoreet posuere ante, ac aliquam metus euismod ac. Mauris lorem mi, iaculis semper pretium vel, lacinia et lacus. Aenean in arcu mi, at auctor metus. Suspendisse orci lorem, dignissim sed mattis in, vestibulum sit amet dui.
            Fusce quis magna in purus pharetra sollicitudin. Fusce suscipit cursus sem, eget consequat arcu molestie at. Integer vel urna nec elit fringilla semper et nec mi. Vivamus laoreet accumsan vestibulum. Aenean malesuada cursus est sed ultricies. Nam sem nunc, laoreet a interdum ac, semper quis erat. 
            ...
        </div>
        <div class="date">Fecha: 02.07.2012 &#124; <a class="read-more" href="news/2012/07/02/cooking-for-soul.html" title="Cooking for soul"><span>Leer más...</span><br /></a>
        </div>

    </div>
</article>
<article class="article" id="news-9">
    <div class="rope"></div>
    <div class="img">
        <img src="http://localhost/douzo/assets/images/peper-1342043974.jpg" alt="History of cooking" />
    </div>
    <div class="rest">
        <h2>
            <a href="news/2012/07/11/history-of-cooking.html" title="History of cooking">History of cooking</a>

        </h2>
        <div class="text">
            Pellentesque velit velit, malesuada malesuada hendrerit in, sodales in urna. Donec ut metus nibh, sed euismod ante. Duis vulputate, augue et tristique suscipit, urna massa condimentum felis, ac tincidunt magna ligula bibendum justo. 


            Nulla facilisi. Fusce libero massa, euismod a venenatis a, rutrum sit amet dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque non turpis nisl, nec interdum nunc.

            Phasellus molestie dolor dui. Integer velit odio, suscipit eget porta

            Phasellus molestie dolor dui. Integer velit odio, suscipit eget porta in, pretium et nunc. Maecenas ac diam tortor. Integer laoreet posuere ante, ac aliquam metus euismod ac.
            ...
        </div>
        <div class="date">Fecha: 27.06.2012 &#124; <a class="read-more" href="news/2012/07/11/history-of-cooking.html" title="History of cooking"><span>Leer más...</span><br /></a>
        </div>

    </div>
</article>
-->

