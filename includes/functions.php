<?php
require_once "./classes/classUsuario.php";

session_start();

function isLogged()
{
    $retorno = false;
    
    if ($_SESSION["logado"])
    {
        $retorno = true;
    }
    return $retorno;
}

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

function usuario_logado()
{
    $usuario = new Usuario();
    $usuario = unserialize($_SESSION["usuario"]);
    return $usuario;
}

function somente_logado()
{
    if (!isLogged())
    {
        header("Location:script_logout.php");
        exit();
    }
}
function somente_adm()
{
    if (!isAdm())
    {
        header("Location:home.php");
        exit();
    }
}

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

function trata_str($str)
{
    $proibido = array ( "select", "delete", "insert", "update", "where",
    "order", "desc", "inner", "join", "letf", "limit", "values",
    "from", "asc", "'", "!", "=" );

    $str = trim($str);
    $str = str_ireplace($proibido, "", $str);

    return $str;
}

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