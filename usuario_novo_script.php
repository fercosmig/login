<?php
require_once "./includes/functions.php";
require_once "./classes/classUsuarioDAO.php";

exibe_erros(false);
somente_logado();
somente_adm();

$id_grupo = trata_str($_POST["grupo"]);

$grupo = new Grupo();
$grupo->set_id($id_grupo);

$nome = trata_str($_POST["nome"]);
$email = trata_str($_POST["email"]);
$senha = trata_str($_POST["senha1"]);

$usuario = new Usuario();
$usuario->set_nome($nome);
$usuario->set_email($email);
$usuario->set_senha($senha);
$usuario->set_grupo($grupo);

$usuarioDAO = new UsuarioDAO();
// Verifica se o e-mail já existe na tabela.
if ($usuarioDAO->email_ja_existe($usuario->get_email()))
{
    alerta("Usuário duplicado!", "back");
}
else
{
    $usuarioDAO->insere($usuario);
    alerta("Usuário inserido com sucesso!", "usuario_lista.php");
}


