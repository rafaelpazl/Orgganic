<?php
$hostname = "srv951.hstgr.io";
$bancodedados = "u928537771_orgganic";
$usuario = "u928537771_pazweb";
$senha = "3WUcXZ:F;/y";

new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($mysqli->connect_errno) {
    echo "falha ao conectar:(" . $mysqli->connect_errno . ")" . $mysqli->connect_errno;
} else
    echo "Conectado ao Banco de Dados";
?>