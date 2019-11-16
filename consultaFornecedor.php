<?php 
  session_start();
  include_once('conexao.php');

  if(isset($_SESSION['usuario']))
  {
    $select = $con->prepare("SELECT nm_usuario FROM tb_usuario where lg_usuario ='" . $_SESSION["usuario"] . "'");
    $select->execute();
    $row = $select->fetch();  
  }
  else{
    echo "<script> window.alert('Não permitido')
          window.location.href='index.php'
          </script>";
  }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/styledois.css">
    <title>Acesso</title>
</head>

<style>
  .buto{
  margin-left: 3%;
  margin-top: 2%;
  padding: 20px;
  width: 42.6%;
  border: none;
  background: #312450;
  color: white;
  font-size: 16px;
  border-radius: 5px;
}

.btnOpcoes{
  display: flex;
  justify-content: space-between;
  width: 90%;
}

.containerDois{
  margin-bottom: 5%;
  margin-top: -1%;
}
.dados{
  font-family: 'Roboto';
  margin-left: 3%;
}
.hud{
          font-size: 18px;
          color: white;
          font-family: 'Roboto';
          font-weight: 200;
        }
</style>

<script type="text/javascript" >
$(document).on("click", "#btnEnviar", function(){
  $(":input").val() = "";
});
</script>

<body>
    <!-- This is a reverse engineering of the "Hyperspace"
     design from HTML5 Up! https://html5up.net/hyperspace -->
<main class="main">

        <aside class="sidebar">
          <nav class="nav">
          <div class="hud">
              <h4>Olá <?php echo $_SESSION['usuario']; ?>!</h4>
            </div>
            <img src="ota.svg" alt="" width="60vh">
            <ul>
            <li><a href="acesso.php">Início</a></li>
              <div class="dropdown">
              <li class="dropbtn"><a href="#" class="dropbtn">Cadastro</a></li>
                <div class="dropdown-content">
                  <a href="cadCliente.php">Clientes</a>
                  <a href="cadFuncionario.php">Funcionário</a>
                  <a href="cadFornecedor.php">Fornecedor</a>
                  <a href="cadProduto.php">Produto</a>
                  <a href="cadUsuario.php">Usuário</a>
                </div>
              </div>
              <div class="dropdown">
              <li class="dropbtn active"><a href="#" class="dropbtn">Consulta</a></li>
                <div class="dropdown-content">
                  <a href="consultaCliente.php">Clientes</a>
                  <a href="consultaFuncionario.php">Funcionário</a>
                  <a href="consultaFornecedor.php">Fornecedor</a>
                  <a href="consultaProduto.php">Produto</a>
                  <a href="consultaUsuario.php">Usuário</a>
                </div>
              </div>
              <li><a href="sobre.php">Sobre</a></li>
              <li><a href="acesso.php">Contato</a></li>
              <li><a href="index.php">Sair</a></li>

            </ul>
          </nav>
        </aside>

        <section class="twitter">
          <div class="containerDois">
              <h1 class="titulo">Consulta de Fornecedor</h1>
              <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Pesquisar nome do fornecedor" id="user" name="nome" required>
                    <span class="focus-border"></span>
                </div>
              <?php
              include_once('conexao.php');
            try
            {
                $select = $con->prepare('SELECT * FROM tb_fornecedor');
                $select -> execute();

                while($linha = $select -> fetch())
                {
                    echo "<p class='dados'>";
                    echo "<br><b> Código: </b>".$linha['cd_fornecedor'];
                    echo "<br><b> Nome: </b>".$linha['nm_fornecedor'];
                    echo "<br><b> Cargo: </b>".$linha['ds_cargo'];
                    echo "<br><b> CNPJ: </b>".$linha['cnpj_fornecedor'];
                    echo "<br><b>IE: </b>".$linha['ie_fornecedor'];
                    echo "<br><b>CEP: </b>".$linha['cep_fornecedor'];
                    echo "<br><b> Endereço: </b>".$linha['ds_endereco'];
                    echo "<br><b>Celular: </b>".$linha['cel_fornecedor'];
                    echo "<br><b>Email: </b>".$linha['em_fornecedor'];
                    echo "</p>";
        ?>
          <div class="btnOpcoes">
                <button class="buto" type="submit" id="btnEnviar" onclick="location.href='alterarFornecedor.php?codigo=<?php echo $linha['cd_fornecedor'];?>'"> Alterar</button>
                <button class="buto" type="reset" onclick="location.href='excluirFornecedor.php?codigo=<?php echo $linha['cd_fornecedor'];?>'"> Excluir</button>
                <button class="buto" type="reset" onclick="location.href='acesso.php'"> Voltar</button>
          </div>

        <?php
                }
            }
            catch(PDOException $e)
            {
                echo 'ERROR: '. $e->getMessage();
            }

        ?>
          </div>
        </section>
      </main>
</body>
</html>