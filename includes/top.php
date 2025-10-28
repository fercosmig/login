<!DOCTYPE html>
<?php
require_once "./includes/functions.php";
require_once "./classes/classUsuarioDAO.php";
require_once "./classes/classGrupoDAO.php";
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
                <h2>.:: FerCosMig ::.</h2>
            </div>
            <div id="dir">
<?php
                if (isLogged())                    
                {
                    $usuario = usuario_logado();
?>
                    <span><?= $usuario->get_nome() ?> | <?= $usuario->get_grupo()->get_nome() ?> | </span>
<?php
                    // Se for Administrador mostra links para manutenção de grupos e usuários.
                    if (isAdm())
                    {
?>
                        <span><a href="grupo_lista.php">Grupos</a>  | </span>
                        <span><a href="usuario_lista.php">Usuarios</a> | </span>
<?php
                    }
?>
                    <span><a href="home.php">Home</a> | </span>
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

