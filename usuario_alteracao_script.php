<?php
require_once "./includes/functions.php";
require_once "./classes/classUsuarioDAO.php";
require_once "./classes/classGrupoDAO.php";

exibe_erros(false);
somente_logado();
somente_adm();

$grupo = new Grupo();
$grupoDAO = new GrupoDAO();

$grupo = $grupoDAO->registro_por_id(trata_str($_POST["grupo"]));

$usuario = new Usuario();
$usuario->set_id(trata_str($_POST["id"]));
$usuario->set_nome(trata_str($_POST["nome"]));
$usuario->set_email(trata_str($_POST["email"]));
$usuario->set_senha(trata_str($_POST["senha"]));
$usuario->set_grupo($grupo);

// Os usuarios "adm@adm.com", "usuario@usuario.com" e "fercosmig@gmail.com" não podem ser alterados.
if ($usuario->get_id() <= 3)
{
    alerta("Este usuario não pode ser alterado!", "usuario_lista.php");
}
else
{
    $usuarioDAO = new UsuarioDAO();
    $usuarioDAO->altera($usuario);
    alerta("Usuario alterado com sucesso!", "usuario_lista.php");
}
?>