<?php
include "includes/top.php";

if (isLogged())
{
    header("Location: home.php");
    exit();
}
?>
<br><br>
<h2>Formulário de login do sistema</h2>
<br><br>

<form id="flog" onsubmit="return trata_campos_form(this.id);" action="script_login.php" method="post">
    <div class="tabela">
        <div class="linha">
            <table>
                <tr>
                    <td>Digite seu e-mail:</td>
                    <td><input type="text" id="email" name="email" required autofocus class="t400"></td>
                </tr>
                <tr>
                    <td>Digite sua senha:</td>
                    <td><input type="password" id="senha" name="senha" required class="t400"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Enviar">
                        <input type="reset" value="Limpar">
                    </td>
                </tr>
            </table>
        </div>
    </div>  
</form>

<br><br><br>
<br><br><br>
<br><br><br>

<?php
include "includes/bottom.php";
?>