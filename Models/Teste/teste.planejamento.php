<?

include_once ('global.php');

$aviao = new Aeronave('Boeing', '737', 'PR-GIU', 150, 10000.5, 10, 10);
$horarios = DateTime::createFromFormat('H\h i\m s\s','14h 00m 00s');
$horarioc = DateTime::createFromFormat('H\h i\m s\s','15h 00m 00s');

$freq = ['Tuesday', 'Thursday'];

$aerop= new Aeroporto('GRU', 'São Paulo', 'SP');
$aeroc = new Aeroporto('CNF', 'Belo Horizonte', 'MG');

$comp = new CompanhiaAerea('TAM', 
                            213 ,
                            'CNPJ',
                            'razao',
                            'sigla',
                            12.5);

$plano = new Planejamento(  $freq,
                            "codplan",
                            $aeroc,
                            $aerop,
                            $horarios,
                            $horarioc,
                            300,
                            $comp);

$plano->ProgramaViagens();                       

echo "\n";
$plano->showViagens();