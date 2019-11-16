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

<script type="text/javascript" >
$(document).on("click", "#btnEnviar", function(){
  $(":input").val() = "";
});
</script>

<style>
  .hud{
          font-size: 18px;
          color: white;
          font-family: 'Roboto';
          font-weight: 200;
        }
</style>

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
              <li class="dropbtn active"><a href="#" class="dropbtn">Cadastro</a></li>   
                <div class="dropdown-content">
                  <a href="cadCliente.php">Clientes</a>
                  <a href="cadFuncionario.php">Funcionário</a>
                  <a href="cadFornecedor.php">Fornecedor</a>
                  <a href="cadProduto.php">Produto</a>
                  <a href="cadUsuario.php">Usuário</a>
                </div>
              </div>
              <div class="dropdown">
              <li class="dropbtn"><a href="#" class="dropbtn">Consulta</a></li>   
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
              <h1 class="titulo">Cadastro de Clientes</h1>
              <form action="#" method="POST" enctype="multipart/form-data">
              <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Nome" id="user" name="nome" required> 
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="text" placeholder="CPF" id="user" name="cpf" required maxlength="16" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="alert(TestaCPF(this.value));">
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="text" placeholder="RG" id="user" name="rg" required>
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="text" placeholder="CEP" id="user" name="cep" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required> 
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Endereço" id="user" name="endereco" required> 
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Celular" id="user" name="celular" required>
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="email" placeholder="E-Mail" id="user" name="mail" required>
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="file" name="imgCliente">
                    <span class="focus-border"></span>
                </div>
                <button class="btns" type="submit" id="btnEnviar"> Cadastrar</button>
                <button class="btns" type="reset"> Resetar Campos</button>
              </form>             
          </div>
        </section>
      </main>
      <?php
                if (!empty($_POST)) 
                {
                  date_default_timezone_set('America/Sao_Paulo');
                  include_once('conexao.php');
                  
                  $nome  = $_POST['nome'];
                  $cpf   = $_POST['cpf']; 
                  $rg    = $_POST['rg'];
                  $cep   = $_POST['cep'];
                  $end   = $_POST['endereco'];
                  $cel   = $_POST['celular'];
                  $mail  = $_POST['mail'];
                  $dir = "img/clientes/"; // diretorio para as imagens
                  $foto = $_FILES['imgCliente'];

                  //upload da foto
                  $ext = strtolower(substr($foto['name'],-4)); //Pegando extensão do arquivo 
                  
                  $novo_nome = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo 
            
                  move_uploaded_file($foto['tmp_name'], $dir.$novo_nome); //Fazer upload do arquivo 
                  
                  $caminhoIMG = $dir.$novo_nome;
                  
                  $stmt = $con->prepare("INSERT INTO tb_cliente(nm_cliente, 
                                            cpf_cliente, 
                                            rg_cliente, 
                                            cep_cliente,
                                            ds_endereco,
                                            cel_cliente,
                                            email_cliente,
                                            img_cliente) 
                              VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                              
                  $stmt->bindParam(1,$nome);
                  $stmt->bindParam(2,$cpf);
                  $stmt->bindParam(3,$rg);
                  $stmt->bindParam(4,$cep);
                  $stmt->bindParam(5,$end);
                  $stmt->bindParam(6,$cel);
                  $stmt->bindParam(7,$mail);
                  $stmt->bindParam(8,$caminhoIMG);
                  
                  $stmt->execute();
                  
                }
              ?>
</body>
</html>