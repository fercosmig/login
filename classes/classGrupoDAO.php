<?php
require_once "./includes/functions.php";
require_once "./classes/classGrupo.php";

class GrupoDAO
{
    public function insere($grupo)
    {
        $retorno = false;
        $sql = "INSERT INTO tb_groups (name) VALUES (:nome);";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $grupo->get_nome(), PDO::PARAM_STR);
            $stmt->execute();
            $retorno = true;
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            $pdo = null;
            $stmt = null;
        }
        return $retorno;
    }

    public function lista_todos()
    {
        $sql = "SELECT id, nome FROM tb_groups;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;
            $stmt = null;
        }         
        return $linhas;            
    }
    
    public function registro_por_id($id_grupo)
    {
        $sql = "SELECT id, nome FROM tb_groups WHERE id = :id;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id_grupo, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);

            $pdo = null;
            $stmt = null;
        }         
        return $linha;
    }
    
    public function altera($grupo)
    {
        $retorno = false;
        $sql = "UPDATE tb_groups SET nome = :nome WHERE id = :id;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $grupo->get_nome(), PDO::PARAM_STR);
            $stmt->bindParam(":id", $grupo->get_id(), PDO::PARAM_INT);
            $stmt->execute();
            $retorno = true;
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            $pdo = null;
            $stmt = null;
        }
        return $retorno;
    }

    public function exclui($id_grupo)
    {
        $retorno = false;
        $sql = "DELETE FROM tb_groups WHERE id = :id;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id_grupo, PDO::PARAM_INT);
            $stmt->execute();
            $retorno = true;
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            $pdo = null;
            $stmt = null;
        }        
        return $retorno;
    }
}
?>