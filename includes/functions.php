<?php
require_once "./classes/classUsuario.php";

session_start();

/*
    Verifica se o usuário está logado.
    Retorna TRUE se existir a session de usuário logado ou FALSE se não existir.
*/
function isLogged()
{
    $retorno = false;
    
    if ($_SESSION["logado"])
    {
        $retorno = true;
    }
    return $retorno;
}

/*
    Verifica se o usuário é Administrador do sistema.
    Utiliza os dados da session de usuário logado para verificar se o grupo é Administradores.
    Retorna TRUE se for do grupo Administradores ou FALSE se for de qualquer outro grupo.
*/
function isAdm()
{
    $retorno = false;
    $usuario = usuario_logado();
    if ($usuario->get_grupo()->get_nome() == "Administradores")
    {
        $retorno = true;
    }
    return $retorno;
}

/*
    Obtem dados do usuário logado.
    Retorna um objeto da classe Usuario com os dados obtidos na session de usuário logado.
*/
function usuario_logado()
{
    $usuario = new Usuario();
    $usuario = unserialize($_SESSION["usuario"]);
    return $usuario;
}

/*
    Direciona para a página de logout caso o usuário não esteja logado.
    Caso alguém tente usar o sistema utilizando uma url diretamente sem fazer login.
*/
function somente_logado()
{
    if (!isLogged())
    {
        header("Location:script_logout.php");
        exit();
    }
}

/*
    Direciona para a página home caso o usuário tente utilizar via link uma página sem permissão.
*/
function somente_adm()
{
    if (!isAdm())
    {
        header("Location:home.php");
        exit();
    }
}

/*
    Faz a conexão com o banco de dados.
    Utilizada pelas classes DAO.
*/
function conectaDB()
{
    try
    {    
        $pdo = new PDO("sqlite:./database/sysDB.db","","");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    catch (PDOException $e)
    {
        echo "Error: " . $e->getMessage();
        exit;
    }
    finally
    {
        return $pdo;
    }
}

/*
    Exibe mensagem de alerta e redireciona a página.
    Recebe uma string com a mensagem e uma string com o nome da pagina de destino.
    Se o nome da página estiver em branco, somente exibe a mensagem de alerta.
    Caso o nome da página for "back", redireciona para window.history.back().
*/
function alerta($mensagem, $pagina)
{
    $str = "<script language='javascript' type='text/javascript'>";
    $str .= "alert('" . $mensagem . "');";

    if ($pagina != "")
    {
        if ($pagina == "back")
        {
            $str .= "window.history.back();";
        }
        else
        {
            $str .= "window.location.href='" . $pagina . "';";
        }
    }
    
    $str .= "</script>";
    echo $str;
}

/*
    Recebe uma string.
    Remove espaços em branco no início e no final da string recebida.
    Remove palavras reservadas do SQL.
    Retorna a string tratada.
*/
function trata_str($str)
{
    $proibido = array ( "select", "delete", "insert", "update", "where",
    "order", "desc", "inner", "join", "letf", "limit", "values",
    "from", "asc", "'", "!", "=" );

    $str = trim($str);
    $str = str_ireplace($proibido, "", $str);

    return $str;
}

/*
    Configura a página php para exibir os erros do servidor e de programação.
    Recebe TRUE ou FALSE, para ligar ou não as mensagens de erro.
*/
function exibe_erros($valor)
{
    if ($valor)
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
}
?>