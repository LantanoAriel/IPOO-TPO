<?php
require_once "Torneo.php";

$torneo = new Torneo();
$opcion = -1;

while ($opcion != 0){

    echo "\n===== MENU PRINCIPAL =====\n";
    echo "1. Registrar personaje\n";
    echo "2. Registrar arma\n";
    echo "3. Registrar arena\n";
    echo "4. Equipar arma\n";
    echo "5. Registrar duelo\n";
    echo "6. Ejecutar duelos pendientes\n";
    echo "7. Recuperar personajes lesionados\n";
    echo "8. Consultar rankings\n";
    echo "9. Consultar historial de personajes\n";
    echo "0. Salir\n";

    echo "Ingrese una opción: ";
    $opcion = intval(trim(fgets(STDIN)));

    switch ($opcion){

        case 1:
            echo "Registrar personaje...\n";
            // pedir datos y crear objeto
            break;

        case 2:
            echo "Registrar arma...\n";
            break;

        case 3:
            echo "Registrar arena...\n";
            break;

        case 4:
            echo "Equipar arma...\n";
            break;

        case 5:
            echo "Registrar duelo...\n";
            break;

        case 6:
            echo "Ejecutar duelos pendientes...\n";

            $duelos = $torneo->getDuelos();

            foreach($duelos as $duelo){
                if($duelo->getEstado() == "pendiente"){
                    $torneo->realizarDuelo($duelo);
                }
            }

            echo "Duelos ejecutados.\n";
            break;

        case 7:
            echo "Recuperar personajes lesionados...\n";

            foreach($torneo->getPersonajes() as $personaje){
                if($personaje->getEstadoPersonaje() == "lesionado"){
                    $personaje->recuperarVida(50);
                    $personaje->setEstadoPersonaje("disponible");
                }
            }

            echo "Personajes recuperados.\n";
            break;

        case 8:  // CONSULTAS OBLIGATORIAS
            echo "Ranking de personajes:\n";

            $personajes = $torneo->getPersonajes();

            usort($personajes, function($a, $b){
                return $b->getDuelosGanadosPersonaje() - $a->getDuelosGanadosPersonaje();
            });

            foreach($personajes as $p){
                echo $p->getNombrePersonaje() . " - Victorias: " . $p->getDuelosGanadosPersonaje() . "\n";
            }

            break;

        case 9:
            echo "Ingrese ID del personaje: ";
            $id = intval(trim(fgets(STDIN)));

            foreach($torneo->getDuelos() as $duelo){

                if($duelo->getPersonaje1()->getIdPersonaje() == $id ||
                   $duelo->getPersonaje2()->getIdPersonaje() == $id){

                    echo "Duelo ID: " . $duelo->getId() . "\n";
                }
            }

            break;

        case 0:
            echo "Saliendo...\n";
            break;

        default:
            echo "Opción inválida.\n";
            break;
    }
}
?>
