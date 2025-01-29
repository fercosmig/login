<?php
require_once "./includes/functions.php";
require_once "./classes/classGrupo.php";
require_once "./classes/classUsuario.php";

class UsuarioDAO
{
    public function login($usuario)
    {
        $sql = "SELECT tb_users.id, tb_users.name, tb_users.email, tb_users.password, ";
        $sql .= "tb_groups.id as group_id, tb_groups.name as group_name ";
        $sql .= "FROM tb_users ";
        $sql .= "INNER JOIN tb_groups ";
        $sql .= "ON tb_users.id_group = tb_groups.id ";
        $sql .= "WHERE tb_users.email = :email ";
        $sql .= "AND tb_users.password = :senha;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":email", $usuario->get_email(), PDO::PARAM_STR);
            $stmt->bindParam(":senha", $usuario->get_senha(), PDO::PARAM_STR);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $grupo = new Grupo();
                $grupo->set_id($linha["group_id"]);
                $grupo->set_nome($linha["group_name"]);
    
                $usuario->set_id($linha["id"]);
                $usuario->set_nome($linha["name"]);
                $usuario->set_grupo($grupo);
            }

            $pdo = null;
            $stmt = null;
        }
        return $usuario;
    }

    public function insere($usuario)
    {
        $retorno = false;
        $sql = "INSERT INTO tb_users (name, email, password, id_group) VALUES ";
        $sql .= "(:nome, :email, :senha, :id_grupo);";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $usuario->get_nome(), PDO::PARAM_STR);
            $stmt->bindParam(":email", $usuario->get_email(), PDO::PARAM_STR);
            $stmt->bindParam(":senha", $usuario->get_senha(), PDO::PARAM_STR);
            $stmt->bindParam(":id_grupo", $usuario->get_grupo()->get_id(), PDO::PARAM_INT);
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
        $sql = "SELECT tb_users.id, tb_users.name, tb_users.email, tb_users.password, ";
        $sql .= "tb_groups.id as group_id, tb_groups.name as group_name ";
        $sql .= "FROM tb_users ";
        $sql .= "INNER JOIN tb_groups ";
        $sql .= "ON tb_users.id_group = tb_groups.id ";
        $sql .= "ORDER BY tb_users.name ASC;";

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
    
    public function registro_por_id($id_usuario)
    {
        $sql = "SELECT tb_users.id, tb_users.name, tb_users.email, tb_users.password, ";
        $sql .= "tb_groups.id as group_id, tb_groups.name as group_name ";
        $sql .= "FROM tb_users ";
        $sql .= "INNER JOIN tb_groups ";
        $sql .= "ON tb_users.id_group = tb_groups.id ";
        $sql .= "WHERE tb_users.id = :id;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id_usuario, PDO::PARAM_INT);
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
    
    public function altera($usuario)
    {
        $retorno = false;
        $sql = "UPDATE tb_users SET name = :nome, email = :email, ";
        $sql .= "password = :senha, id_group = :id_grupo WHERE id = :id;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $usuario->get_nome(), PDO::PARAM_STR);
            $stmt->bindParam(":email", $usuario->get_email(), PDO::PARAM_STR);
            $stmt->bindParam(":senha", $usuario->get_senha(), PDO::PARAM_STR);
            $stmt->bindParam(":id_grupo", $usuario->get_grupo()->get_id(), PDO::PARAM_INT);
            $stmt->bindParam(":id", $usuario->get_id(), PDO::PARAM_INT);
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

    public function exclui($id_usuario)
    {
        $retorno = false;
        $sql = "DELETE FROM tb_users WHERE id = :id;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id_usuario, PDO::PARAM_INT);
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