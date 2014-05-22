<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>BackEnd|Inicio</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- ************ Estilos CSS ****************** -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/main.css">

        <!-- ************ /Estilos CSS ***************** -->
    </head>
    <body style="margin: 0;">

        <!-- **************** Scripts ********************** -->

        <script src="<?php echo base_url(); ?>assets/js/bootstrap/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/main.js"></script>

        <!-- **************** /Scripts ********************* -->

        <nav class="navbar navbar-inverse">
            <div class="container menu">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Cambiar navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <p class="navbar-brand"><a  href="<?php echo base_url(); ?>">Douzo - Japón</a></p>
                </div>
                <div class="navbar-collapse collapse">
                    <!-- Elementos del menu aquí -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="menuitem"><a href="<?php echo base_url(); ?>back_end/">INICIO</a></li>
                        <li class="menuitem"><a href="<?php echo base_url(); ?>back_end/entradas">ENTRADAS</a></li>
                        <li class="menuitem"><a href="<?php echo base_url(); ?>back_end/categorias">CATEGORIAS</a></li>
                        <li class="menuitem"><a href="<?php echo base_url(); ?>back_end/reservas">RESERVAS</a></li>
                        <li class="menuitem"><a href="<?php echo base_url(); ?>">WEB</a></li>
                    </ul>
                </div><!--/.navbar-collapse -->
            </div>
        </nav>