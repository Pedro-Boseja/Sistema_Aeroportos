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
        
        $online = Usuario::$logado;

        $email = "Usuário não registrado.";
        $login = "Usuário não registrado.";
        $senha= "Usuário não registrado.";

        if($online!=null){
          $email = $online->getEmail();
          $login = $online->getLogin();
          $senha= $online->getSenha();
        }

    ?>

</body>

<body>
  
  <br><br><label>Email:<?php echo " " . $email; ?></label><br>
  <label>Login:<?php echo " " . $login; ?></label><br>
  <label>Senha:<?php echo " " . $senha; ?></label><br><br>
  
  <form action="../Views/sistema.html" method="get">
    <button>Acessar funcionalidades do Sistema</button>
  </form>

  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>

