<?php
require_once "./includes/functions.php";
require_once "./classes/classUsuarioDAO.php";

exibe_erros(false);
somente_logado();
somente_adm();

$grupo = new Grupo();
$grupo->set_id(trata_str($_POST["grupo"]));

$usuario = new Usuario();
$usuario->set_nome(trata_str($_POST["nome"]));
$usuario->set_email(trata_str($_POST["email"]));
$usuario->set_senha(trata_str($_POST["senha1"]));
$usuario->set_grupo($grupo);

$usuarioDAO = new UsuarioDAO();

if ($usuarioDAO->email_ja_existe($usuario->get_email()))
{
    alerta("Usuário duplicado!", "back");
}
else
{
    $usuarioDAO->insere($usuario);
    alerta("Usuário inserido com sucesso!", "usuario_lista.php");
}


