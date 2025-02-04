<?php
require_once "./includes/functions.php";
require_once "./classes/classUsuario.php";
require_once "./classes/classUsuarioDAO.php";

$email = trata_str($_POST["email"]);
$senha = trata_str($_POST["senha"]);

$usuario = new Usuario();
$usuario->set_email($email);
$usuario->set_senha($senha);

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->login($usuario);

if ($usuario->get_nome() != "")
{
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