<?php

session_start();
  date_default_timezone_set('America/Sao_Paulo');
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

$cod = $_GET['codigo']; 
$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$pc = $_POST['preçoCompra'];
$pv = $_POST['preçoVenda'];
$dir = "img/produtos/"; // diretorio para as imagens
$foto = $_FILES['imgProduto'];

//upload da foto
$ext = strtolower(substr($foto['name'],-4)); //Pegando extensão do arquivo 
                  
$novo_nome = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo 

move_uploaded_file($foto['tmp_name'], $dir.$novo_nome); //Fazer upload do arquivo 

$caminhoIMG = $dir.$novo_nome;

include_once('conexao.php');
	try 
	{
		   
		$stmt = $con->prepare('UPDATE tb_produto SET nm_produto = :nome,
													 pc_produto = :pc,
													 pv_produto = :pv,
                           qnt_produto = :qnt,
                           img_produto = :caminhoIMG
								WHERE cd_produto = :id');
		
    $stmt->execute(array(':id' => $cod, 
               ':nome' => $nome,
							 ':pc' => $pc,
               ':pv' => $pv,
               ':caminhoIMG' => $caminhoIMG,
							 ':qnt' => $quantidade));
     
	} 
	catch(PDOException $e) 
	{
		echo 'Error: ' . $e->getMessage();
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
              <h1 class="titulo">Produto de código <?php echo $cod; ?> alterado com sucesso!</h1>              
                <button class="btns" type="reset" onclick="javascript: location.href='consultaProduto.php'" style="width: 80%; margin-left: 10%;"> Voltar</button> 
          </div>
        </section>
      </main>
</body>
</html>
