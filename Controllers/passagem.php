<head>
    <title>Busca de passagens</title>
</head>

<body>
  
    <h1>Sistema de Aeroportos</h1>
    
    <?php
        include_once "../Models/global.php";

        ob_start();
        Usuario::Login("Hugo Boss", "1234");
        ob_end_clean();
        
        $cliente = $_GET['cliente'];
        $data = $_GET['data'];
        $aeros = $_GET['aeros'];
        $aeroc = $_GET['aeroc'];
        $quant = $_GET['quant'];

        $clients = null;
        $dat = new DateTime($data);

        try{
         $clients = Cliente::getRecords();
          if($clients == null){
            throw new Exception("Cliente inválido.");
          }
          $ac = Aeroporto::getRecordsByField("_sigla", $aeroc);
            if($ac == null){
            throw new Exception("Aeroporto de chegada inválido.");
            }
            $as = Aeroporto::getRecordsByField("_sigla", $aeros);
            if($aeros == null){
            throw new Exception("Aeroporto de saída inválido.");
            }
          $clients[0]->SolicitarViagem($as[0], $ac[0], $dat, $quant);
        }catch(Exception $e){
          echo $e->getMessage();
        }
        // catch(Error $e){
        //   echo "Dados inválidos.";
        // }

    ?>

</body>

<body>
  
  <br><br>

  <form action="../Views/passagem.html" method="get">
        <button>Buscar outra passagem</button>
    </form>
  
  <form action="../Views/sistema.html" method="get">
        <button>Voltar ao sistema</button>
  </form>
  
  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>

