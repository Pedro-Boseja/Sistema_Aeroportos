<?php
    include_once "../global.php";
    $master = new Usuario;
    $master->Registrar("GLC010", "gug12", "gustavolc@gmail.com");
    $master->Login("GLC010", "gug12");
    $master->Sair();

    $master->Registrar("GLC010", "gug12", "gustavolc@gmail.com");
    $master->Registrar("GLC010", "gug123", "gustavo@gmail.com");

    $master->Login("GLC010", "gug12");
    $master->Sair();