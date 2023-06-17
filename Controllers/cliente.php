<head>
    <title>Cadastro de Cliente</title>
</head>

<body>

  <h1>Sistema de Aeroportos</h1>  
  
  <?php
      include_once "../Models/global.php";

      ob_start();
      Usuario::Login("Hugo Boss", "1234");
      ob_end_clean();

      $nome = $_GET['nome'];
      $documento = $_GET['documento'];

      $cliente=null;
        
        try{
          $cliente = new Cliente($nome, $documento);
          $cliente->save();
          echo "Cliente cadastrado com sucesso.";
        }catch(Exception $e){
          echo $e->getMessage();
        }catch(Error $e){
          echo "Dados inválidos.";
        }

        $nome = "Aeroporto não registrado.";
        $documento = "Aeroporto não registrado.";

        if($cliente!=null){
            $nome = $cliente->getCadastro()->getNome();
            $documento = $cliente->getCadastro()->getDocumento("RG");
        }
  ?>

  <br><br><label>Nome: <?php echo " " . $nome; ?></label><br>
  <label>Documento: <?php echo " " . $documento; ?></label><br><br>

  <form action="../Views/cliente.html" method="get">
        <button>Cadastrar outro Cliente</button>
    </form>
  
  <form action="../Views/sistema.html" method="get">
        <button>Voltar ao sistema</button>
  </form>
  
  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>

