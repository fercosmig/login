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
    <table>
        <tr>
            <td>
                <span>Id:</span>
            </td>
            <td>
                <input type="text" id="id" name="id" readonly value="<?= $usuario->get_id(); ?>">
            </td>
        </tr>
        <tr>
            <td>
                <span>Nome:</span>
            </td>
            <td>
                <input type="text" id="nome" name="nome" required autofocus value="<?= $usuario->get_nome(); ?>" size="50">
            </td>
        </tr>
        <tr>
            <td>
                <span>E-mail:</span>
            </td>
            <td>
                <input type="text" id="email" name="email" readonly value="<?= $usuario->get_email(); ?>" size="50">
            </td>
        </tr>
        <tr>
            <td>
                <span>Senha:</span>
            </td>
            <td>
                <input type="password" id="senha" name="senha" readonly value="<?= $usuario->get_senha(); ?>">
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

<a href="usuario_lista.php">Voltar / Cancelar</a>

<br>
<br>
<br>
<br>
<br>

<?php
include "includes/bottom.php";
?>