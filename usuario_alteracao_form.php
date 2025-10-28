<?php
include "includes/top.php";

exibe_erros(true);
somente_logado();
somente_adm();
?>

<?php
$id_usuario = trata_str($_GET["id"]);

$usuario = new Usuario();
$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->registro_por_id($id_usuario);

?>

<h2>Formulário de alteração de usuários</h2>

<form id="form_novo" method="post" onsubmit="return verifica_senha(this.id);" action="usuario_alteracao_script.php">
    <table class="tabela">
        <tr>
            <td class="celula_conteudo espaco">
                <span>Id:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="text" id="id" name="id" readonly value="<?= $usuario->get_id(); ?>" size="10">
            </td>
        </tr>
        <tr>
            <td class="celula_conteudo espaco">
                <span>Nome:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="text" id="nome" name="nome" required autofocus value="<?= $usuario->get_nome(); ?>" size="50">
            </td>
        </tr>
        <tr>
            <td class="celula_conteudo espaco">
                <span>E-mail:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="text" id="email" name="email" readonly value="<?= $usuario->get_email(); ?>" size="50">
            </td>
        </tr>
        <tr>
            <td class="celula_conteudo espaco">
                <span>Senha:</span>
            </td>
            <td class="celula_conteudo espaco">
                <input type="password" id="senha" name="senha" readonly value="<?= $usuario->get_senha(); ?>" size="50">
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
                        if ($grupo->get_id() == $usuario->get_grupo()->get_id())
                        {
?>
                            <option value="<?= $grupo->get_id(); ?>" selected><?= $grupo->get_nome(); ?></option>
<?php   
                        }
                        else
                        {
?>
                            <option value="<?= $grupo->get_id(); ?>"><?= $grupo->get_nome(); ?></option>
<?php
                        }
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