<?php
include "includes/top.php";
require_once "./classes/classGrupoDAO.php";

exibe_erros(true);
somente_logado();
somente_adm();
?>
<h2>Formulário de alteração de grupos</h2>

<?php

$id_grupo = trata_str($_GET["id"]);

$grupo = new Grupo();
$grupoDAO = new GrupoDAO();

$grupo = $grupoDAO->registro_por_id($id_grupo);

?>

<form id="form_alteracao" method="post" onsubmit="return trata_campos_form(this.id);" action="grupo_alteracao_script.php">
    <table>
        <tr>
            <td>
                <span>Id:</span>
            </td>
            <td>
                <input type="text" id="id" name="id" readonly value="<?= $grupo->get_id(); ?>">
            </td>
            <td>
                <span>Nome:</span>
            </td>
            <td>
                <input type="text" id="nome" name="nome" required autofocus value="<?= $grupo->get_nome(); ?>">
            </td>
            <td>
                <input type="submit" id="salvar" name="salvar" value="Salvar">
            </td>
            <td>
                <input type="reset" id="limpar" name="limpar" value="Limpar">
            </td>
        </tr>
    </table>
</form>

<br>
<br>
<br>

<a href="grupo_lista.php">Voltar / Cancelar</a>

<br>
<br>
<br>
<br>
<br>

<?php
include "includes/bottom.php";
?>