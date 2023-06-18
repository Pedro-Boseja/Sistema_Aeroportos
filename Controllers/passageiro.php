<head>
    <title>Cadastro de Passageiro</title>
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
        $data = $_GET['data'];
        $nacionalidade = $_GET['nacionalidade'];
        $cpf = $_GET['cpf'];
        $email = $_GET['email'];

        $passageiro = null;
        
        try{
            $nascimento = new DateTime($data);
            $cadastro = new Cadastro($nome, $documento);
            $passageiro = new Passageiro($cadastro, $nascimento, $nacionalidade, $email, $cpf);
            echo "Passageiro cadastrado com sucesso.";
        }catch(Exception $e){
            echo $e->getMessage();
        }catch(Error $e){
            echo "Dados inválidos.";
        }

        $nome = "Passageiro não registrado.";
        $documento = "Passageiro não registrado.";
        $data = "Passageiro não registrado.";
        $nacionalidade = "Passageiro não registrado.";
        $cpf = "Passageiro não registrado.";
        $email = "Passageiro não registrado.";

        if($passageiro!=null){
            $nome = $passageiro->getCadastro()->getNome();
            $documento = $passageiro->getCadastro()->getDocumento("RG");
            $data = $passageiro->getCadastro()->getDataNascimento()->format("d/m/Y");
            $nacionalidade = $passageiro->getCadastro()->getNacionalidade();
            $cpf = $passageiro->getCadastro()->getNumeroCpf();
            $email = $passageiro->getCadastro()->getEmail();
        }
    ?>

</body>

<body>
  
  <br><br><label>Nome: <?php echo " " . $nome; ?></label><br>
  <label>Documento: <?php echo " " . $documento; ?></label><br>
  <label>Data de Nascimento: <?php echo " " . $data; ?></label><br>
  <label>Nacionalidade: <?php echo " " . $nacionalidade; ?></label><br>
  <label>CPF: <?php if($nacionalidade=="BRASILEIRO") {echo " " . $cpf;} else echo "Estrangeiro"; ?></label><br>
  <label>E-mail: <?php echo " " . $email; ?></label><br><br>

  <form action="../Views/planejamento.html" method="get">
        <button>Cadastrar outro Passageiro</button>
    </form>
  
  <form action="../Views/sistema.html" method="get">
        <button>Voltar ao sistema</button>
  </form>
  
  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>

