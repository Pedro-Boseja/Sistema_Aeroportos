<?php
  include_once "../Models/global.php";

  

  //$i = $_GET['validar'] === '1';
?>

<head>
    <title>Dados Cliente</title>
</head>

<body>

  <label>Confira se os dados abaixo estão corretos:</label><br><br>
  <input name="nome" type="text" placeholder="<?php echo $nome?>"></input><br>
  <input name="documento" type="text" placeholder="<?php echo $documento?>"></input><br><br>
  
  <form action="regcliente.php" method="get">
    <!--<input type="submit" name="validar" value='1'>Estão corretos</input>-->
  </form>
  
  <form action="../Views/cliente.html" method="post">
    <button>Editar Dados</button>
  </form>

  <?php

    //if($i==true){
      $cadastro = new Cadastro($nome,$documento);
      $cliente = new Cliente($cadastro);

      $nomecliente = $cliente->getCadastro()->getNome();

      echo $nomecliente;
    //}

  ?>
  
</body>

