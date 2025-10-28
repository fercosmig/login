<?php
include "includes/top.php";

somente_logado();
somente_adm();
?>
<h2>Formulário de cadastro de novos grupos</h2>

<form id="form_novo" method="post" onsubmit="return trata_campos_form(this.id);" action="grupo_novo_script.php">
    <table>
        <tr>
            <td>
                <span>Nome:</span>
            </td>
            <td>
                <input type="text" id="nome" name="nome" required autofocus>
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