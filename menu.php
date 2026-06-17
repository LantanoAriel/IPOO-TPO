menú.php } invocamos objetos
Usa require_once cuando el archivo sea esencial para el funcionamiento del script y quieras evitar inclusiones múltiples.
Usa include_once si el archivo no es crítico y quieres evitar duplicados, pero sin detener la ejecución en caso de error.

<?php
require_once "Duelo.php";
require_once "Torneo.php";
$torneo = new Torneo();
$opcion = -1; 
while ($opcion != 0){
    echo "\n==== MENU TORNEO ====\n";
    echo "1. Listar todos los personajes\n";
    echo "2. Listar personajes disponibles para duelar\n";
    echo "3. Listar personajes lesionados\n";
    echo "4. Listar personajes retirados\n";
    echo "5. Listar armas disponibles\n";
    echo "6. Mostrar el arma equipada por cada personaje\n";
    echo "7. Mostrar todos los duelos realizados\n";
    echo "8. Mostrar todos los duelos pendientes\n";
    echo "9. Mostrar el historial de duelos de un personaje\n";  
    echo "10. Mostrar el ranking de personajes ordenado por cantidad de victorias\n"; 
    echo "11. Mostrar el personaje con mayor cantidad de victorias\n"; 
    echo "12. Mostrar el porcentaje de victorias de cada personaje\n"; 
    echo "13. Mostrar la arena donde más duelos se realizaron\n"; 
    echo "0. Salir\n";
 
    echo "Ingrese una opción: ";
    $opcion = intval(trim(fgets(STDIN))); // nos aseguramos que el usuario ingrese un número entero.

    switch ($opcion) {
        case 1:
            $personajes = $torneo->listarPersonajes();
            foreach ($personajes as $personaje) {
                echo $personaje . "\n";
                echo "---------------------\n";
            }
            break;
        case 2:
            $personajesDisponibles = $torneo->listarPersonajesDisponibles();
            foreach ($personajesDisponibles as $personaje) {
                echo $personaje . "\n";
                echo "---------------------\n";
            }
            break;
        case 3:
            $personajesLesionados = $torneo->listarPersonajesLesionados();
            foreach ($personajesLesionados as $personaje){
                echo $personaje . "\n";
                echo "---------------------\n";
            }
            break;
        case 4:
            $personajesRetirados = $torneo->listarPersonajesRetirados();
            foreach ($personajesRetirados as $personaje){
                echo $personaje . "\n";
                echo "---------------------\n";
            }
            break;
        case 5:
            $armasDisponibles = $torneo->listarArmasDisponibles();
            foreach ($armasDisponibles as $armas){
                echo $armas . "\n";
                echo "---------------------\n";
            }
            break;
        case 6:
            $personajes = $torneo->getPersonajes();
            foreach($personajes as $personaje){
                echo "Personaje: " . $personaje->getNombrePersonaje() . "\n";
                $arma = $personaje->getArmaPersonaje();
                if ($arma != null){
                    echo "Arma equipada: " . $arma->getNombre() . "\n";
                } else {
                    echo "Sin arma equipada\n";
                }
                echo "-------------------\n";
            }
            break;
        case 7:
            $duelos = $torneo->getDuelos();
            $encontrado = false;
            foreach ($duelos as $duelo){
                if ($duelo->getEstado() == "realizado"){
                    echo "Duelo ID: " . $duelo->getId() . "\n";
                    echo "Personaje 1: " . $duelo->getPersonaje1()->getNombrePersonaje() . "\n";
                    echo "Personaje 2: " . $duelo->getPersonaje2()->getNombrePersonaje() . "\n";
                    echo "--------------------\n";
                    $encontrado = true;
                }
            }
            if (!$encontrado){
                echo "No hay duelos realizados.\n";
            }
            break;
        case 8:
            $duelosPendientes = $torneo->getDuelos();
            $encontrado = false;
            foreach ($duelosPendientes as $duelo){
                if ($duelo->getEstado() == "pendiente"){
                    echo "Duelo ID: " . $duelo->getId() . "\n";
                    echo "Personaje 1: " . $duelo->getPersonaje1()->getNombrePersonaje() . "\n";
                    echo "Personaje 2: " . $duelo->getPersonaje2()->getNombrePersonaje() . "\n";
                    echo "--------------------\n";
                    $encontrado = true; 
                }
            }
            if (!$encontrado){
                echo "No hay duelos pendientes.\n";
            }
            break;
        case 9:
            echo "Ingrese el ID del personaje: ";
            $idBuscado = intval(trim(fgets(STDIN)));
            $duelos = $torneo->getDuelos();
            $encontrado = false;
            foreach($duelos as $duelo){
                $pj1 = $duelo->getPersonaje1();
                $pj2 = $duelo->getPersonaje2();
                if ($pj1->getIdPersonaje() == $idBuscado || $pj2->getIdPersonaje() == $idBuscado){
                    echo "Duelo ID: " . $duelo->getId() . "\n";
                    echo "Personaje 1: " . $pj1->getNombrePersonaje() . "\n";
                    echo "Personaje 2: " . $pj2->getNombrePersonaje() . "\n";
                    echo "Estado: " . $duelo->getEstado() . "\n";
                    echo "----------------------\n";   
                    $encontrado = true;
                }
            }
            if (!$encontrado){
                echo "No se encontrados duelos para ese personaje.\n";
            }
            break;
        case 10:
            $personajes = $torneo->getPersonajes();
            // ordemanos visctorias de mayor a menor
            usort($personajes, function($a, $b){
                return $b->getDuelosGanadosPersonaje() - $a->getDuelosGanadosPersonaje();
            });
            foreach($personajes as $personaje){
                echo $personaje->getNombrePersonaje() . 
                    "- Victorias: " . $personaje->getDuelosGanadosPersonaje() . "\n";
                echo "---------------------\n";
            }
            break;
        case 11:
            $personajes = $torneo->getPersonajes();
            if (count($personajes) == 0){
                echo "No hay personajes.\n";
                break;
            }
            $mejor = $personajes[0];
            foreach($personajes as $personaje){
                if($personaje->getDuelosGanadosPersonaje() > $mejor->getDuelosGanadosPersonaje()){
                    $mejor = $personaje;
                }
            }
            echo "Personaje con más victorias:\n";
            echo $mejor->getNombrePersonaje() . " - Victorias: " . $mejor->getDuelosGanadosPersonaje() . "\n";
            break;
        case 12:
            $personajes = $torneo->getPersonajes();
            foreach($personajes as $personaje){
                $ganados = $personaje->getDuelosGanadosPersonaje();
                $perdidos = $personaje->getDuelosPerdidosPersonaje();
                $total = $ganados + $perdidos;
                if($total > 0){
                    $porcentaje = ($ganados/$total) * 100;
                } else {
                    $porcentaje = 0;
                }
                echo $personaje->getNombrePersonaje() . " - % Victorias: " . round($porcentaje, 2) . "%\n";
                echo "----------------------\n";
            }
            break;
        case 13:
            $duelos = $torneo->getDuelos();
            if (count($duelos) == 0){
                echo "No hay duelos registrados.\n";
                break;
            }
            $contadorArenas = []; // inicializamos array asociativo como contador
            // contamos duelos pos arena
            foreach ($duelos as $duelo){
                $arena = $duelo->getArena();
                $nombreArena = $arena->getNombre();
                if (isset($contadorArenas[$nombreArena])){ //verificamos si existe la variable y no es null
                    $contadorArenas[$nombreArena]++;
                }else{
                    $contadorArenas[$nombreArena] = 1;
                }
            }
                // buscar la arena con mayor cantidad
                $max = 0;
                $arenaMax = "";
                foreach ($contadorArenas as $nombre => $cantidad){
                    if ($cantidad > $max){
                        $max = $cantidad;
                        $arenaMax = $nombre;
                    }
                }
                echo "Arena con más duelos: " . $arenaMax . "\n";
                echo "Cantidad de duelos: " . $max . "\n";
            break;
        case 0:
            echo "Saliendo del sistema...\n";
            break;

        default:
            echo "Opción inválida.\n";
            break;
    }
}
?>
