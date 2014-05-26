<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to codeigniter-user Library!</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

    #login_form {
        background: #eee;
        padding: 10px;
        width: 300px;
		border: 1px solid #aaa;
		text-shadow: 0 1px 0 #fff;
		border-radius: 4px;
    }

    #login_form label {
        float: left;
        display: block;
        min-width: 100px;
    }
    #login_form input {
        width: 170px;
    }
    .info {
        margin: 10px 0;
    }
    .info p {
        margin: 0;
    }
	.success_message {
		background: rgba(10,10,255, 0.4);
		color: #fff !important;
		text-shadow: none;
		padding: 0 5px;
	}
	.error_message {
		background: rgba(255,10,10, 0.4);
		color: #fff !important;
		text-shadow: none;
		padding: 0 5px;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Autentificaci&oacute;n de usuario</h1>
	<div id="body">
        <p>Para poder administrar su restaurante debe primero ingresar sus credenciales.</p>
        <div class="info">
            <p>Login: <strong>admin</strong></p>
            <p>Password: <strong>admin</strong></p>
        </div>
        <h2 style="color:red;"><?php echo $this->session->flashdata('bad_login'); ?></h2>
        
        <form action="<?php echo site_url('login/validate') ?>" method="post" id="login_form">
			<h2>Credenciales</h2>
			
            <div class="error_message"><?php echo $this->session->flashdata('error_message');?></div>
            <div class="success_message"><?php echo $this->session->flashdata('success_message');?></div>
			
            <p>
            <label for="login">Usuario: </label>
            <input type="text" name="login" id="login" placeholder="Login" />
            </p>

            <p>
            <label for="password">Contrase&ntilde;a:</label>
            <input type="password" name="password" id="password" placeholder="Password" />
            </p>

            <p><button value="send" class="btn">Acceder</button></p>
        </form>
	</div>
	<p class="footer">Librer&iacute;a por <a href="http://creatalia.besaba.com">Creatalia</a>. P&aacute;gina renderizada en <strong>{elapsed_time}</strong> segundos :)</p>
</div>
</body>
</html>



