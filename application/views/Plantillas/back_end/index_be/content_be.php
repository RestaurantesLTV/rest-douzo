<section>
    <a href="<?php echo base_url(); ?>back_end/entradas">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3  servicios ">
            <div class="icon-container" >
                <div class="img-icon">
                    <img src="<?php echo base_url(); ?>assets/images/back_end/entradas.png" href="<?php echo base_url(); ?>back_end/entradas" onmouseover="this.src = '<?php echo base_url(); ?>assets/images/back_end/entradas-h.png'" onmouseout="this.src = '<?php echo base_url(); ?>assets/images/back_end/entradas.png'" class="center-block webdesign">
                </div>
            </div>
            <h2>ENTRADAS</h2>
        </div>
    </a>
    <a href="<?php echo base_url(); ?>/index.php/back_end/categorias">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3  servicios ">
            <div class="icon-container">
                <div class="img-icon">
                    <img src="<?php echo base_url(); ?>assets/images/back_end/categorias.png" href="<?php echo base_url(); ?>back_end/categorias" onmouseover="this.src = '<?php echo base_url(); ?>assets/images/back_end/categorias-h.png'" onmouseout="this.src = '<?php echo base_url(); ?>assets/images/back_end/categorias.png'"alt="web" class="center-block">
                </div>
            </div>
            <h2>CATEGORIAS</h2>      
        </div>
    </a>
    <a href="<?php echo base_url(); ?>/index.php/back_end/reservas">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3  servicios">
            <div class="icon-container">
                <div class="img-icon">
                    <img src="<?php echo base_url(); ?>assets/images/back_end/reservas.png" href="<?php echo base_url(); ?>back_end/reservas" onmouseover="this.src = '<?php echo base_url(); ?>assets/images/back_end/reservas-h.png'" onmouseout="this.src = '<?php echo base_url(); ?>assets/images/back_end/reservas.png'"alt="web" class="center-block">
                </div>
            </div>
            <h2>RESERVAS</h2>
        </div>
    </a>
    <div class="centrado">
        <a href="<?php echo base_url(); ?>">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3  servicios ">
                <div class="icon-container">
                    <div class="img-icon">
                        <img src="<?php echo base_url(); ?>assets/images/back_end/web.png" href="<?php echo base_url(); ?>back_end/web" onmouseover="this.src = '<?php echo base_url(); ?>assets/images/back_end/web-h.png'" onmouseout="this.src = '<?php echo base_url(); ?>assets/images/back_end/web.png'"alt="web" class="center-block">
                    </div>
                </div>
                <h2>WEB</h2>
            </div>
        </a>
    </div>
    <div class="centrado2">
        <a href="<?php echo base_url(); ?>back_end/salir">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3  servicios ">
                <div class="icon-container">
                    <div class="img-icon">
                        <img src="<?php echo base_url(); ?>assets/images/back_end/salir.png" href="<?php echo base_url(); ?>back_end/salir" onmouseover="this.src = '<?php echo base_url(); ?>assets/images/back_end/salir-h.png'" onmouseout="this.src = '<?php echo base_url(); ?>assets/images/back_end/salir.png'"alt="web" class="center-block">
                    </div>
                </div>
                <h2>SALIR</h2>
            </div>
        </a>
    </div>
    <script>
        $(document).ready(function() {
            $(".servicios").draggeable();
        })
    </script>
</section>