<head>
    <title>Cadastro de Companhia</title>
</head>

<body>
  
    <h1>Sistema de Aeroportos</h1>
    
    <?php
        include_once "../Models/global.php";

        ob_start();
        Usuario::Login("Hugo Boss", "1234");
        ob_end_clean();

        $nome = $_GET['nome'];
        $codigo = $_GET['codigo'];
        $cnpj = $_GET['cnpj'];
        $razao = $_GET['razao'];
        $sigla = $_GET['sigla'];
        $franquia = $_GET['franquia'];

        $companhia=null;
        
        try{
          $companhia = new CompanhiaAerea($nome, $codigo, $cnpj, $razao, $sigla, $franquia);
          $companhia->save();
          echo "Companhia cadastrada com sucesso.";
        }catch(Exception $e){
          echo $e->getMessage();
        }catch(Error $e){
          echo "Dados inválidos.";
        }

        $nome = "Companhia não registrada.";
        $codigo = "Companhia não registrada.";
        $cnpj = "Companhia não registrada.";
        $razao = "Companhia não registrada.";
        $sigla = "Companhia não registrada.";
        $franquia = "Companhia não registrada.";

        if($companhia!=null){
            $nome = $companhia->getNome();
            $codigo = $companhia->getCodigo();
            $cnpj = $companhia->getCNPJ();
            $razao = $companhia->getRazao();
            $sigla = $companhia->getSigla();
            $franquia = $companhia->getFranquia();
        }
    ?>

</body>

<body>
  
  <br><br><label>Nome: <?php echo " " . $nome; ?></label><br>
  <label>Código: <?php echo " " . $codigo; ?></label><br>
  <label>CNPJ: <?php echo " " . $cnpj; ?></label><br>
  <label>Razao: <?php echo " " . $razao; ?></label><br>
  <label>Sigla: <?php echo " " . $sigla; ?></label><br>
  <label>Franquia: <?php echo " " . $franquia; ?></label><br><br>

  <form action="../Views/companhia.html" method="get">
        <button>Cadastrar outra Companhia</button>
    </form>
  
  <form action="../Views/sistema.html" method="get">
        <button>Voltar ao sistema</button>
  </form>
  
  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>

