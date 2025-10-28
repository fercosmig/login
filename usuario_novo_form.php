<?php
include "includes/top.php";

exibe_erros(true);
somente_logado();
somente_adm();
?>

<h2>Formulário de cadastro de novos usuários</h2>

<form id="form_novo" method="post" onsubmit="return verifica_senha(this.id);" action="usuario_novo_script.php">
    <table>
        <tr>
            <td>
                <span>Nome:</span>
            </td>
            <td>
                <input type="text" id="nome" name="nome" required autofocus>
            </td>
        </tr>
        <tr>
            <td>
                <span>E-mail:</span>
            </td>
            <td>
                <input type="text" id="email" name="email" required>
            </td>
        </tr>
        <tr>
            <td>
                <span>Senha:</span>
            </td>
            <td>
                <input type="password" id="senha1" name="senha1" required>
            </td>
        </tr>
        <tr>
            <td>
                <span>Repetir senha:</span>
            </td>
            <td>
                <input type="password" id="senha2" name="senha2" required>
            </td>
        </tr>
        <tr>
            <td>
                <span>Grupo:</span>
            </td>
            <td>
                <select id="grupo" name="grupo" required>
                    <option></option>
<?php
                    $grupoDAO = new GrupoDAO();
                    $lista_grupos = $grupoDAO->lista_todos();
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