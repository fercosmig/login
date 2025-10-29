<?php
require_once "./includes/functions.php";
require_once "./classes/classGrupoDAO.php";

exibe_erros(true);
somente_logado();
somente_adm();

$id = trata_str($_GET["id"]);

// Os grupos "Usuários" e "Administradores" não podem ser excluídos.
if ($id <= 2)
{
    alerta("Este grupo não pode ser excluído!", "grupo_lista.php");
}
else
{
    $grupoDAO = new GrupoDAO();
    $grupoDAO->exclui($id);
    alerta("Grupo excluído com sucesso!", "grupo_lista.php");
}
?>