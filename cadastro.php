<?php 
require_once 'aluno.php';
$p = new Aluno("academia", "localhost", "root", "mint"); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <link rel="stylesheet" href="academia.css">
</head>


    <header>
        <div class="logo">
            <img src="./imagens/logo_trial-ToQG8L85C-transformed-removebg-preview.png">
            <h1>Academia Saúde <br>Fitness</h1>
        </div>
        <nav>
            <ul class="menu">
                <li><a href="academia.html">Pagina Inicial</a></li>
                <li><a href="sobrenos.html">Sobre</a></li>
                      <li><a href="#">O que oferecemos</a>
                         <ul>
                              <li><a href="academia.html">Boxe</a></li>
                              <li><a href="">Capoeira</a></li>
                              <li><a href=".ccard card3">Jiu-Jitsu</a></li>
                           </ul>
                    </li>
                <li><a class="cadastro" href="cadastro.html">Cadastro</a></li>
        </ul>
        </nav>
    </header>
    <body>
<?php 
if (isset($_POST['nome'])) { 
    if (isset($_GET['cpf']) && empty($_GET['cpf'])) {
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


?>

    <div class="container1">
    <form method="POST">
        <h2>CADASTRAR PESSOA</h2>
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
        <input type="submit" value="cadastrar">
    </form>
        </div>
        
            <div class="contato">

                <hr>
                <h2>Entre em Contato</h2>
                <p>Telefone: (55)85 9 8773-3229</p>
                <p>Email: gabrielidade7@gmail.com</p>
                <p>Endereço: Rua Peri, 1080</p>
            </div>
            <footer>
                <p>© 2024</p>
            </footer>
</body>

</html>
