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
    <table class="tabela">
        <tr>
            <td class="celula_conteudo espaco">
                <span>Id:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="text" id="id" name="id" readonly value="<?= $grupo->get_id(); ?>" size="10">
            </td>
            <td class="celula_conteudo espaco">
                <span>Nome:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="text" id="nome" name="nome" required autofocus value="<?= $grupo->get_nome(); ?>" size="50">
            </td>
            <td class="celula_conteudo espaco">
                <input type="submit" id="salvar" name="salvar" value="Salvar">
            </td>
            <td class="celula_conteudo espaco">
                <a href="grupo_lista.php">
                    <img src="./images/voltar.png" width="30px" height="30px" alt="Voltar / Cancelar">
                </a>
            </td>
        </tr>
    </table>
</form>

<br>
<br>
<br>
<br>
<br>

<?php
include "includes/bottom.php";
?>