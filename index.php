<?php
include "includes/top.php";

?>

<h2>Formulário de login do sistema</h2>

<?php
if (isLogged())
{
    header("Location: home.php");
    exit();
}
?>

<form id="form_login" method="post" onsubmit="return trata_campos_form(this.id);" action="script_login.php">
    <table class="tabela">
        <tr>
            <td class="celula_conteudo espaco">
                <span>E-mail:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="text" id="email" name="email" required autofocus size="50">
            </td>
        </tr>
        <tr>
            <td class="celula_conteudo espaco">
                <span>Senha:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="password" id="senha" name="senha" required size="50">
            </td>
        </tr>
        <tr>
            <td class="celula_conteudo espaco" colspan="2">
                <input type="submit" id="enviar" name="enviar" value="Enviar">
                <input type="reset" id="limpar" name="limpar" value="Limpar">
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