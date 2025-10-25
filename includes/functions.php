<?php
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

function verifica_pagina()
{
    if(!isLogged())
    {
        header("Location: script_logout.php");
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
        $str .= "window.location.href='" . $pagina . "';";
    }
    
    $str .= "</script>";
    echo $str;
}

function trata_str($str)
{
    $proibido = array ( "select", "delete", "insert", "update", "where",
    "order", "desc", "inner", "join", "letf", "limit", "values",
    "from", "asc", "'", "!", "=" );

    $str = str_ireplace($proibido, "", $str);

    return $str;
}
?>