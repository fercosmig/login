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
    <table>
        <tr>
            <td>
                <span>E-mail:</span>
            </td>
            <td>
                <input type="text" id="email" name="email" required autofocus>
            </td>
        </tr>
        <tr>
            <td>
                <span>Senha:</span>
            </td>
            <td>
                <input type="password" id="senha" name="senha" required>
            </td>
        </tr>
        <tr>
            <td colspan="2">
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