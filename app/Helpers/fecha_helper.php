<?php
function minutosdesplegado($minutos) {
    $segundos = $minutos*60;
    $dias = floor($segundos/86400);
    $horas = floor(($segundos - $dias*86400) / 3600);
    $minutos = floor(($segundos / 60) % 60);
    return $dias . "d " . $horas . "h " . $minutos . "m";
}
?>