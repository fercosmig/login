<?php
require_once "./includes/functions.php";
require_once "./classes/classUsuarioDAO.php";

exibe_erros(true);
somente_logado();
somente_adm();

$id = trata_str($_GET["id"]);

// Os usuários "adm@adm.com", "usuario@usuario.com" e "fercosmig@gmail.com" não podem ser excluídos.
if ($id <= 3)
{
    alerta("Este usuario não pode ser excluído!", "usuario_lista.php");
}
else
{
    $usuarioDAO = new UsuarioDAO();
    $usuarioDAO->exclui($id);
    alerta("Usuario excluído com sucesso!", "usuario_lista.php");
}
?>