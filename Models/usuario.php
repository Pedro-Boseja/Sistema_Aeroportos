<?php
include_once "classes/class.usuario.php";

$usuarioZero = Usuario::getRecords();
$usuarioZero = $usuarioZero[0];
$usuarioZero->Login("Hugo Boss", "1234");

$user = new Usuario();
$user->Login("enzo", "0101");
