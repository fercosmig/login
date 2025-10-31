<?php
include "includes/top.php";

exibe_erros(true);
somente_logado();
somente_adm();

$grupoDAO = new GrupoDAO();
$lista_grupos = $grupoDAO->lista_todos();
?>
<br><br>
<h2>Formulário de cadastro de novos usuários</h2>
<br><br>

<input type="button" onclick="direciona('usuario_lista.php')" value="Voltar">

<form id="form_novo" method="post" onsubmit="return verifica_senha(this.id);" action="usuario_novo_script.php">

    <div class="tabela">
        <div class="linha">
            <table>
                <tr>
                    <td><span class="rot">Nome:</span></td>
                    <td><input type="text" id="nome" name="nome" required autofocus class="t400"></td>
                </tr>
                <tr>
                    <td><span class="rot">E-mail:</span></td>
                    <td><input type="text" id="email" name="email" required class="t400"></td>
                </tr>
                <tr>
                    <td><span class="rot">Senha:</span></td>
                    <td><input type="password" id="senha1" name="senha1" required class="t400"></td>
                </tr>
                <tr>
                    <td><span class="rot">Repetir senha:</span></td>
                    <td><input type="password" id="senha2" name="senha2" required class="t400"></td>
                </tr>
                <tr>
                    <td><span class="rot">Grupo:</span></td>
                    <td>
                        <select id="grupo" name="grupo" required class="t400">
                            <option></option>
<?php
foreach ($lista_grupos as $grupo)
{
?>
                            <option value="<?= $grupo->get_id(); ?>"><?= $grupo->get_nome(); ?></option>
<?php
}
?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Salvar">
                        <input type="reset"value="Limpar">
                        <input type="button" onclick="direciona('usuario_lista.php')" value="Cancelar">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>

<input type="button" onclick="direciona('usuario_lista.php')" value="Voltar">

<br><br><br><br><br>
<?php
include "includes/bottom.php";
?>