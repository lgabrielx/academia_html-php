<?php 
require_once 'aluno.php';
$p = new Aluno("academia", "localhost", "root", "mint"); 
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
if (isset($_POST['nome'])) { 
    // -------------------EDITAR------------------------
    if(isset($_GET['cpf_up']) && !empty($_GET['cpf_up'])){
        $cpf_upd = addslashes($_GET['cpf_up']);
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $sexo = addslashes($_POST['sexo']);
        $endereco = addslashes($_POST['endereco']);
        if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($sexo) && !empty($endereco)) { 
            // Editar
            $p->atualizarDados($cpf_upd, $nome, $telefone, $email, $endereco, $sexo );
            header("location: pag.php");
        } else {
            echo "Preencha todos os campos";
        } 
    // ------------------CADASTRAR----------------------
    } else {
        $cpf = addslashes($_POST['cpf']);
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $sexo = addslashes($_POST['sexo']);
        $endereco = addslashes($_POST['endereco']);
        if (!empty($cpf) && !empty($nome) && !empty($telefone) && !empty($email) && !empty($sexo) && !empty($endereco)) { 
            // Cadastrar
            if (!$p->cadastrar( $cpf ,$nome, $telefone, $email, $endereco, $sexo )){ 
                echo "CPF já está cadastrado!";
            }
        } else {
            echo "Preencha todos os campos";
        }
    }
}

if(isset($_GET['cpf_up'])) { 
    $cpf_update = addslashes($_GET['cpf_up']);
    $res = $p->buscarDadosAluno($cpf_update);
} else {
    $res = null;
}
?>

<section id="esquerda">
    <form method="POST">
        <h2><?php echo isset($res) ? "Atualizar Pessoa" : "Cadastrar Pessoa"; ?></h2>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];}?>">
        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" id="telefone" value="<?php if(isset($res)){echo $res['telefone'];}?>">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];}?>">
        <label for="sexo">sexo</label>
        <select name="sexo" id="sexo" value="<?php if(isset($res)){echo $res['sexo'];}?>">
        <option value="F">Feminino</option>
        <option value="M">Masculino</option>
        <option value="O">Outro</option>
        </select>
        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" value="<?php if(isset($res)){echo $res['cpf'];}?>">
        <label for="endereco">Endereço</label>
        <input type="text" name="endereco" id="endereco" value="<?php if(isset($res)){echo $res['endereco'];}?>">
        <input type="submit" value="<?php echo isset($res) ? "Atualizar" : "Cadastrar"; ?>">
    </form>
</section>

<section id="direita">
    <table>
        <tr id="titulo"> 
            <td>Nome</td>
            <td>Endereço</td>
            <td>Telefone</td>
            <td>E-mail</td>
            <td>Sexo</td>
            <td></td>
        </tr>

        <?php 
        $dados = $p->buscarDados();
        if (count($dados) > 0) {
            for ($i = 0; $i < count($dados); $i++) { 
                echo "<tr>";
                foreach ($dados[$i] as $k => $v) {
                    if ($k != "cpf") {
                        echo "<td>".$v."</td>";
                    }
                }
                ?>
                <td>
                   <a href="pag.php?cpf_up=<?php echo $dados[$i]['cpf'] ?>">Editar</a>
                    <a href="pag.php?cpf=<?php echo $dados[$i]['cpf'] ?>">Excluir</a>
                </td>
                <?php
                echo "</tr>";
            }
        } else {
            echo "Ainda não há pessoas cadastradas!";
        }
        ?>
    </table>
</section>
</body>
</html>

<?php 
if(isset($_GET['cpf'])) { 
    $cpf = addslashes($_GET['cpf']);
    $p->excluir($cpf); 
    header("location: pag.php"); 
}
?>
