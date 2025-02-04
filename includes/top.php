<!DOCTYPE html>
<?php
require_once "./includes/functions.php";
require_once "./classes/classUsuario.php";
require_once "./classes/classGrupo.php";
?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="./includes/acesso.css" media="screen" />
        <script src="./includes/acesso.js"></script>
    </head>
    <body id="body_top">
        <div id="top_all">
            <div id="esq">
                <h2>Sistema de Login .:: FerCosMig ::.</h2>
            </div>
            <div id="dir">
            <?php
                if (isLogged())                    
                {
                    $usuario = new Usuario();
                    $usuario = unserialize($_SESSION["usuario"]);
                ?>
                <span><?= $usuario->get_nome() ?> | <?= $usuario->get_grupo()->get_nome() ?> | </span>
                <span><a href="script_logout.php">Logout</a></span>
                <?php
                }
                else
                {
                ?>
                <span>Você não está logado!</span>
                <?php
                }
                ?>
            </div>
        </div>
        <hr>

