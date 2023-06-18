<head>
    <title>Cadastro de Categoria</title>
</head>

<body>
  
    <h1>Sistema de Aeroportos</h1>
    
    <?php
        include_once "../Models/global.php";

        ob_start();
        Usuario::Login("Hugo Boss", "1234");
        ob_end_clean();

        
        $nome = $_GET['nome'];
        $pontos = $_GET['pontos'];
        $companhia = $_GET['Companhia'];
       
        
        try{
          $comps = CompanhiaAerea::getRecordsByField("_nome", $companhia);
          $milhagem = $comps[0]->getMilhagem();
          $milhagem->setCategoria($nome, $pontos);
          $comps[0]->save();
          echo "Categoria cadastrado com sucesso.";
        }catch(Exception $e){
          echo $e->getMessage();
        }catch(Error $e){
          echo "Dados inválidos. \n";
        }

       
    ?>

</body>

<body>
  
  <br><br><label>Categoria: <?php echo " " . $nome; ?></label><br>
  <label>Pontos: <?php echo " " . $pontos; ?></label><br>
  <label>Programa Aéreo: <?php echo " " . $companhia; ?></label><br><br>

  <form action="../Views/categoria.html" method="get">
        <button>Cadastrar outra Categoria</button>
    </form>
  
  <form action="../Views/sistema.html" method="get">
        <button>Voltar ao sistema</button>
  </form>
  
  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>
