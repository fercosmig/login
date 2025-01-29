<?php
require_once "./classes/classUsuario.php";
require_once "./classes/classUsuarioDAO.php";
require_once "./includes/functions.php";

$usuario = new Usuario();
$usuario->set_email($_POST["email"]);
$usuario->set_senha($_POST["senha"]);

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->login($usuario);

if ($usuario->get_nome() != "")
{
    session_start();
    $_SESSION["usuario"] = serialize($usuario);
    $_SESSION["id_usuario"] = $usuario->get_id();
    $_SESSION["logado"] = true;
    alerta("Usuario logado!", "index.php");
}
else
{
    alerta("Não consegue né Moisés!", "index.php");
}
?>