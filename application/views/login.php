<!DOCTYPE html>

<html>
    <head>
        <meta charset='utf-8' />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        <!-- Tema opcional -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">

        <script src='<?= base_url(); ?>utilerias/js/librerias/jquery-1.9.1.js'></script>

        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

        <!--<script src='<?= base_url(); ?>utilerias/js/login.js'></script>-->
        <link href='<?= base_url(); ?>utilerias/css/login.css' rel='stylesheet' />
        <title>FIESTAS DE OAXACA</title>
    </head>
    <body>
        
        <div class="login-page">
            <div class="form">
                <h1>FIESTAS DE OAXACA</h1>
                <form class="login-form" action="<?= base_url(); ?>index.php/FiestaOaxaca/login" method="POST">
                    <input type="text" name="usuario" placeholder="Introduce Nombre de Usuario"/>
                    <input type="password" name="password" placeholder="Introduce Password"/>
                    <button type="submit">Ingresar</button>
                    <p class="message">¿No estas registrado? <a href="#">Crea una cuenta</a></p>
                </form>
            </div>
        </div>

    </body>
</html>
