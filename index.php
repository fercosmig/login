<?php
include "includes/top.php";

if (isLogged())
{
?>
    <span>Viva! você está logado no sistema! Faça Logout!</span>
<?php
}
else
{
?>
<form id="form_login" method="post" action="script_login.php">
    <table>
        <tr>
            <td>
                <span>E-mail:</span>
            </td>
            <td>
                <input type="text" id="email" name="email" />
            </td>
        </tr>
        <tr>
            <td>
                <span>Senha:</span>
            </td>
            <td>
                <input type="password" id="senha" name="senha" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" id="enviar" name="enviar" value="Enviar" />
                <input type="reset" id="limpar" name="limpar" value="Limpar" />
            </td>
        </tr>
    </table>
</form>
<?php
}

include "includes/bottom.php";
?>