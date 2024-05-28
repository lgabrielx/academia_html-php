<?php

class Aluno {

    private $pdo;

    // Conexão com o Banco de dados
    public function __construct($dbname, $host, $user, $password) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $password);
        } catch (PDOException $e) {
            echo "Erro com o banco de dados: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            exit();
        }
    }

    public function buscarDados() {
        $cmd = $this->pdo->prepare("SELECT * FROM Aluno ORDER BY nome");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    // função de cadastrar pessoas no banco de dados
    public function cadastrar($nome, $telefone, $email, $endereco, $sexo, $cpf) {
        // verificar se já foi cadastrado anteriormente com base no CPF
        $cmd = $this->pdo->prepare("SELECT cpf FROM Aluno WHERE cpf = :c");
        $cmd->bindValue(":c", $cpf);
        $cmd->execute();

        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO Aluno (nome, telefone, email, endereco, sexo, cpf) VALUES (:n, :t, :e, :r, :s, :c)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":r", $endereco);
            $cmd->bindValue(":s", $sexo);
            $cmd->bindValue(":c", $cpf);
            $cmd->execute();
            return true;
        }
    }

    public function excluir($cpf) {
        $cmd = $this->pdo->prepare("DELETE FROM Aluno WHERE cpf = :c");
        $cmd->bindValue(":c", $cpf);
        $cmd->execute();
    }

    // Buscar dados de uma pessoa 
    public function buscarDadosAluno($cpf) {
        $res = array(); // prevenindo erro, caso não retorne nada do banco, aparecerá um array vazio.
        $cmd = $this->pdo->prepare("SELECT * FROM Aluno WHERE cpf = :c");
        $cmd->bindValue(":c", $cpf);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    // Atualizar dados no banco de dados 
    public function atualizarDados($cpf, $nome, $telefone, $email, $endereco, $sexo) {
        $cmd = $this->pdo->prepare("UPDATE Aluno SET nome = :n, telefone = :t, email = :e, endereco = :r, sexo = :s WHERE cpf = :c");
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":t", $telefone);
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":c", $cpf);
        $cmd->bindValue(":s", $sexo);
        $cmd->bindValue(":r", $endereco);
        $cmd->execute();
    }
}

?>
