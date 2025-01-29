<?php

function isLogged()
{
    $retorno = false;
    session_start();
    if ($_SESSION["logado"])
    {
        $retorno = true;
    }
    return $retorno;
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
        $str .= "window.location.href='" . $pagina . "';";
    }
    
    $str .= "</script>";
    echo $str;
}
?>