<?php
require_once "./includes/functions.php";
require_once "./classes/classGrupoDAO.php";

exibe_erros(false);
somente_logado();
somente_adm();

$id = trata_str($_POST["id"]);
$nome = trata_str($_POST["nome"]);

$grupo = new Grupo();
$grupo->set_id($id);
$grupo->set_nome($nome);

// Os grupos "Usuários" e "Administradores" não podem ser alterados.
if ($grupo->get_id() <= 2)
{
    alerta("Este grupo não pode ser alterado!", "grupo_lista.php");
}
else
{
    $grupoDAO = new GrupoDAO();
    $grupoDAO->altera($grupo);
    alerta("Grupo alterado com sucesso!", "grupo_lista.php");
}
?>