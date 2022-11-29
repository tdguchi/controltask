<?php
function minutosdesplegado($minutos) {
    $segundos = $minutos*60;
    $dias = floor($segundos/86400);
    $horas = floor(($segundos - $dias*86400) / 3600);
    $minutos = floor(($segundos / 60) % 60);
    $cadena = "";
    if ($dias > 0) {
        $cadena .= $dias . "d ";
    }
    if ($horas > 0) {
        $cadena .= $horas . "h ";
    }
    if ($minutos > 0) {
        $cadena .= $minutos . "m ";
    }
    if ($cadena == "") {
        $cadena = "0m";
    }
    return $cadena;
}
?>