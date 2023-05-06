<?

include_once ('../Classes/class.planejamento.php');

$aviao = new Aeronave('Boeing', '737', 'PR-GIU', 150, 10000.5);
$horarios = DateTime::createFromFormat('H\h i\m s\s','14h 00m 00s');
$horarioc = DateTime::createFromFormat('H\h i\m s\s','15h 00m 00s');

$freq = ['Tuesday', 'Thursday'];

$aerop= new Aeroporto('GRU', 'São Paulo', 'SP');
$aeroc = new Aeroporto('CNF', 'Belo Horizonte', 'MG');

$plano = new Planejamento(  $freq,
                            "codplan",
                            $aviao,
                            $aeroc,
                            $aerop,
                            $horarios,
                            $horarioc);

$plano->ProgramaViagens();                       

echo "\n";
$plano->showViagens();