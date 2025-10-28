<?php
include "includes/top.php";

exibe_erros(true);
somente_logado();
somente_adm();
?>

<h2>Formulário de cadastro de novos usuários</h2>

<form id="form_novo" method="post" onsubmit="return verifica_senha(this.id);" action="usuario_novo_script.php">
    <table class="tabela">
        <tr>
            <td class="celula_conteudo espaco">
                <span>Nome:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="text" id="nome" name="nome" required autofocus size="50">
            </td>
        </tr>
        <tr>
            <td class="celula_conteudo espaco">
                <span>E-mail:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="text" id="email" name="email" required size="50">
            </td>
        </tr>
        <tr>
            <td class="celula_conteudo espaco">
                <span>Senha:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="password" id="senha1" name="senha1" required size="50">
            </td>
        </tr>
        <tr>
            <td class="celula_conteudo espaco">
                <span>Repetir senha:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="password" id="senha2" name="senha2" required size="50">
            </td>
        </tr>
        <tr>
            <td class="celula_conteudo espaco">
                <span>Grupo:</span>
            </td>
            <td class="celula_conteudo espaco">
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
            <td class="celula_conteudo espaco">
                <a href="usuario_lista.php">
                    <img src="./images/voltar.png" width="30px" height="30px" alt="Voltar / Cancelar">
                </a>
            </td>
            <td class="celula_conteudo espaco">
                <input type="submit" id="salvar" name="salvar" value="Salvar">
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