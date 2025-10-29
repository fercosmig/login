<?php
require_once "./includes/functions.php";
require_once "./classes/classUsuarioDAO.php";
require_once "./classes/classGrupoDAO.php";

exibe_erros(false);
somente_logado();
somente_adm();

$id_grupo = trata_str($_POST["grupo"]);

$grupo = new Grupo();
$grupoDAO = new GrupoDAO();
$grupo = $grupoDAO->registro_por_id($id_grupo);

$id = trata_str($_POST["id"]);
$nome = trata_str($_POST["nome"]);
$email = trata_str($_POST["email"]);
$senha = trata_str($_POST["senha"]);

$usuario = new Usuario();
$usuario->set_id($id);
$usuario->set_nome($nome);
$usuario->set_email($email);
$usuario->set_senha($senha);
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