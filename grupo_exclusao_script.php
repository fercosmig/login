<?php
require_once "./includes/functions.php";
require_once "./classes/classGrupoDAO.php";

exibe_erros(true);
somente_logado();
somente_adm();

$id_grupo = trata_str($_GET["id"]);

if ($id_grupo <= 2)
{
    alerta("Este grupo não pode ser excluído!", "grupo_lista.php");
}
else
{
    $grupoDAO = new GrupoDAO();
    $grupoDAO->exclui($id_grupo);
    alerta("Grupo excluído com sucesso!", "grupo_lista.php");
}
?>