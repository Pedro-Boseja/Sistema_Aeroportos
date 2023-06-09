<head>
    <title>Página geral</title>
</head>

<body>
  
  <h1>Sistema de Aeroportos</h1>
  
  <?php
  include_once "../Models/global.php";

  $login = $_GET['login'];
  $senha = $_GET['senha'];

  try{
    echo Usuario::Login($login, $senha);
  }catch(Exception $e){
    echo $e->getMessage();
  }
  ?>

</body>

<?php
    
?>

<body>

  <br><br>
  
  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>

