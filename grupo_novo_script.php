<?php
require_once "./includes/functions.php";
require_once "./classes/classGrupoDAO.php";

exibe_erros(false);
somente_logado();
somente_adm();

$nome_grupo = trata_str($_POST["nome"]);

$grupo = new Grupo();
$grupoDAO = new GrupoDAO();

$grupo->set_nome($nome_grupo);

// Verifica se já existe grupo com o mesmo nome.
if ($grupoDAO->nome_ja_existe($grupo->get_nome()))
{
    alerta("Nome de grupo duplicado!", "back");
}
else
{
    $grupoDAO->insere($grupo);
    alerta("Grupo inserido com sucesso!", "grupo_lista.php");
}
?>