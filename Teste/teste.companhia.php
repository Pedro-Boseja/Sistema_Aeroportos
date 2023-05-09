<?php
include_once('global');

$companhia1 = new CompanhiaAerea("Azul Linhas Aéreas", 123, "12.345.678/0001-01", "Azul S.A.", "AZL");

$aviao1 = new Aeronave('Boeing', '737', 'PR-GIU', 150, 10000.5, 10, 10);
$aviao2 = new Aeronave('jun', '811', 'PR-GIU', 255, 10000.5, 10, 10);
$aviao3 = new Aeronave('safira', '899', 'PR-GIU', 264, 10000.5, 10, 10);
$aviao4 = new Aeronave('enzo', '577', 'PR-GIU', 788, 10000.5, 10, 10);



$horarios1 = DateTime::createFromFormat('H\h i\m s\s','14h 00m 00s');
$horarioc1 = DateTime::createFromFormat('H\h i\m s\s','15h 00m 00s');
$horarios2 = DateTime::createFromFormat('H\h i\m s\s','12h 00m 00s');
$horarioc2 = DateTime::createFromFormat('H\h i\m s\s','04h 00m 00s');
$horarios3 = DateTime::createFromFormat('H\h i\m s\s','12h 00m 00s');
$horarioc3 = DateTime::createFromFormat('H\h i\m s\s','24h 00m 00s');
$horarios4 = DateTime::createFromFormat('H\h i\m s\s','20h 00m 00s');
$horarioc4 = DateTime::createFromFormat('H\h i\m s\s','04h 00m 00s');

$freq1 = ['Tuesday', 'Thursday'];
$freq2 = ['Monday', 'Tuesday', 'Wednesday','Thursday', 'Friday', 'Saturday', 'Sunday'];
$freq3 = ['Tuesday', 'Thursday', 'Friday'];
$freq4 = ['Monday', 'Tuesday', 'Thursday', 'Sunday'];

$aerop1 = new Aeroporto('GRU', 'São Paulo', 'SP');
$aeroc1 = new Aeroporto('CNF', 'Belo Horizonte', 'MG');
$aerop2 = new Aeroporto('OPO', 'Portugal', 'PT');
$aeroc2 = new Aeroporto('JUN', 'Belo Horizonte', 'MG');
$aerop3 = new Aeroporto('GRU', 'São Paulo', 'SP');
$aeroc3 = new Aeroporto('CNF', 'Belo Horizonte', 'MG');
$aerop4 = new Aeroporto('GRU', 'São Paulo', 'SP');
$aeroc4 = new Aeroporto('CNF', 'Belo Horizonte', 'MG');

$plano1 = new Planejamento(  $freq,
                            "codplan",
                            $aviao,
                            $aeroc,
                            $aerop,
                            $horarios,
                            $horarioc);

