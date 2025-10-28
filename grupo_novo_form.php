<?php
include "includes/top.php";

somente_logado();
somente_adm();
?>
<h2>Formulário de cadastro de novos grupos</h2>

<form id="form_novo" method="post" onsubmit="return trata_campos_form(this.id);" action="grupo_novo_script.php">
    <table class="tabela">
        <tr>
            <td class="celula_conteudo espaco">
                <span>Nome:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="text" id="nome" name="nome" required autofocus size="50">
            </td>
            <td class="celula_conteudo centro espaco">
                <input type="submit" id="salvar" name="salvar" value="Salvar">
                <input type="reset" id="limpar" name="limpar" value="Limpar">
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