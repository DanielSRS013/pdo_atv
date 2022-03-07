<?php
    require_once('./conexao.php');
    function addAluno($aluno){
        try{
            $connection = getConnection();
            $stmt = $connection->prepare("INSERT INTO aluno(nome, email) VALUES (:nome, :email)");

            $stmt->bindParam(":nome", $aluno->nome);
            $stmt->bindParam(":email", $aluno->email);

            if($stmt->execute())
                echo "Aluno(a) cadastrado(a) com sucesso";
        }catch(PDOException $error){
            echo "Erro ao cadastar o(a) aluno(a). Erro: {$error->getMessage()}";
        }finally{
            unset($connection);
            unset($stmt);
        }
    }
    function listAluno()
    {
        try {
            $connection = getConnection();

            $rs = $connection->query("SELECT nome, email FROM aluno");

            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                echo $row->nome . "<br>";
                echo $row->email . "<br>";
            }
        } catch (PDOException $error) {
            echo "Erro ao listar os alunos. Erro: {$error->getMessage()}";
        } finally {
            unset($connection);
            unset($rs);
        }
    }
    function findAluno($nome)
    {
        try {
            $connection = getConnection();
            $stmt = $connection->prepare("SELECT nome, email FROM aluno WHERE nome LIKE :nome");
            $stmt->bindValue(":nome", "%{$nome}%");
            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo $row->nome . "<br>";
                        echo $row->email . "<br>";
                    }
                }
            }
        } catch (PDOException $error) {
            echo "Erro na busca pelo aluno '{$nome}'. Erro: {$error->getMessage()}";
        } finally {
            unset($connection);
            unset($stmt);
        }
    }
    function updateAluno($aluno)
    {
        try {
            $connection = getConnection();

            $stmt = $connection->prepare("UPDATE aluno SET nome = :nome, email = :email WHERE id = :codigo");

            $stmt->bindParam(":codigo", $aluno->codigo);
            $stmt->bindParam(":nome", $aluno->nome);
            $stmt->bindParam(":email", $aluno->email);

            if ($stmt->execute())
                echo "Aluno atualizado com sucesso!";
        } catch (PDOException $error) {
            echo "Erro ao atualizar o aluno. Erro: {$error->getMessage()}";
        } finally {
            unset($connection);
            unset($stmt);
        }
    }
    function deleteAluno($codigo)
    {
        try {
            $connection = getConnection();

            $stmt = $connection->prepare("DELETE FROM aluno WHERE id = ?");
            $stmt->bindParam(1, $codigo);

            if ($stmt->execute())
                echo "Aluno deletado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao deletar o aluno. Erro: {$error->getMessage()}";
        } finally {
            unset($connection);
            unset($stmt);
        }
    }