<?php
function minutosdesplegado($minutos) {
    $segundos = $minutos*60;
    $dias = floor($segundos/86400);
    $horas = floor(($segundos - $dias*86400) / 3600);
    $minutos = floor(($segundos / 60) % 60);
    if ($dias == 0) {
        if ($horas == 0) {
            return $minutos . " min";
        } else {
            return $horas . "h " . $minutos . "m";
        }
    } else {    
        return $dias . "d " . $horas . "h " . $minutos . "m";
    }
}
?>