<?php

$coloresPosibles = ['rojo', 'verde', 'azul', 'lila', 'gris', 'negro'];

$size = (int)readline('Con cuántos colores quieres jugar? ');

jugar($coloresPosibles, $size);

function jugar($coloresPosibles, $size){
    $txt = "";
    $arrayPosible = array();
    for($i = 0; $i < $size; $i++){
        $arrayPosible[] = $coloresPosibles[rand(0, 5)];
    }
    $numOk = 0;
    $numDesplazados = 0;
    $contadorIntentos = 0;

    $partidaEncurso = true;

    while($partidaEncurso){
        $coloresError = true;

        while($coloresError){
            $coloresUsuario = (string)readline('Introduce los colores en formato "color, color, color..." : ');
            $partida = explode(', ', $coloresUsuario);
            if(count($partida) == $size){
                $coloresError = false;
            }else{
                echo "Has puesto " . count($partida) . " colores, debes poner " . $size . " colores \n";
            }
        }

        $contadorIntentos++;
        $txt .= "Intento numero: " . $contadorIntentos . "\n";
        echo $txt;
        for ($i = 0; $i < count($arrayPosible); $i++){
            for ($j = 0; $j < count($arrayPosible); $j++) {
                if ($arrayPosible[$i] == $partida[$j] && $i == $j) {
                    $numOk++;
                } elseif ($arrayPosible[$i] == $partida[$j]) {
                    $numDesplazados++;
                }
            }
        }
        $resultado = "test: => " . $numOk . ", " . $numDesplazados . "\n";
        echo $resultado;
        $txt .= $resultado;
        if($numOk == count($arrayPosible)){
            $victoria = "¡Acierto!\n¡Has ganado!\n";
            echo $victoria;
            $txt .= $victoria;
            $partidaEncurso = false;
        }elseif($contadorIntentos == 12){
            $derrota = "Intentos superados, ¡has perdido!";
            echo $derrota;
            $txt .= $derrota;
            $partidaEncurso = false;
        }
        $numOk = 0;
        $numDesplazados = 0;
    }
    $fichero=fopen("log.txt","a+") or exit("Fichero no encontrado");
    fwrite($fichero,$txt);
    fclose($fichero);

}

?>