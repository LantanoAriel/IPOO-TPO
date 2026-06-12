<?php

include_once("personaje.php");
include_once("arena.php");
include_once("arma.php");

class Duelo
{
    private int $id;
    private Personaje $personaje1;
    private Personaje $personaje2;
    private Arena $arena;
    private string $fecha;
    private string $estado;
    private ?Personaje $ganador; /*El ? $ganador puede ser un objeto Personaje o puede ser null*/


    public function __construct(int $id, Personaje $personaje1, Personaje $personaje2, Arena $arena, string $fecha)
    {
        $this->id = $id;
        $this->personaje1 = $personaje1;
        $this->personaje2 = $personaje2;
        $this->arena = $arena;
        $this->fecha = $fecha;
        $this->estado = "pendiente";
        $this->ganador = null;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getPersonaje1()
    {
        return $this->personaje1;
    }

    public function getPersonaje2()
    {
        return $this->personaje2;
    }

    public function getArena()
    {
        return $this->arena;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getEstado()
    {
        return $this->estado;
    }


    public function getGanador()
    {
        return $this->ganador;
    }


    public function setId(int $nuevoValor)
    {
        $this->id = $nuevoValor;
    }

    // public function setPersonaje1(Personaje $nuevoValor)
    // {
    //     $this->personaje1 = $nuevoValor;
    // }

    // public function setPersonaje2(Personaje $nuevoValor)
    // {
    //     $this->personaje2 = $nuevoValor;
    // }

    // public function setArena(Arena $nuevoValor)
    // {
    //     $this->arena = $nuevoValor;
    // }

    // public function setFecha(string $nuevoValor)
    // {
    //     $this->fecha = $nuevoValor;
    // }

    public function setEstado(string $nuevoValor)
    {
        $this->estado = $nuevoValor;
    }


    public function setGanador(Personaje $nuevoValor)
    {
        $this->ganador = $nuevoValor;
    }


    // Reglas
    // No podrá realizarse un duelo si:
    // ● Ambos personajes son el mismo.
    // ● Alguno de los personajes está lesionado.
    // ● Alguno de los personajes está retirado.

    // En esta funcion esperar para evaluar la función puede Duelear, ya que si no contempla si el pj está retirado entonces modificar función puedeRealizarse para que lo considere 


    public function puedeRealizarse()
    {
        $puedeRealizarse = false;
        $pj1 = $this->getPersonaje1();
        $pj2 = $this->getPersonaje2();
        if (!($pj1 === $pj2)) {

            if ($pj1->puedeDuelar()  && $pj2->puedeDuelar()) {

                $puedeRealizarse = true;
            }
        }

        return $puedeRealizarse;
    }




    public function realizarDuelo()
    {

        $pj1 = $this->getPersonaje1();
        $pj2 = $this->getPersonaje2();
        $arena = $this->getArena();

        // Recalculo el poder de cada pj ya que afecta el modificador de arena dependiendo de su clase y el arena en el que se esté participando, solo le paso PJ porque el duelo ya tendrá su arena
        $poderPj1 = $pj1->calcularPoderTotal() + $arena->calcularModificadorArena($pj1);
        $poderPj2 = $pj1->calcularPoderTotal() + $arena->calcularModificadorArena($pj2);


        // No podrá realizarse un duelo si: (ESTO LO RESUELVO CON PUEDE REALIZARSE())
        // ● Ambos personajes son el mismo.
        // ● Alguno de los personajes está lesionado.
        // ● Alguno de los personajes está retirado.




        if ($this->puedeRealizarse()) {
            // Ya debe entrar el poder re-calculado. O sea que venga con los modificadores, lo hago arriba.
            if ($poderPj1 > $poderPj2) {
                echo "Gana pj1";

                // Inicio logica de ganador 1


                // Si uno gana +1 win,+ 5 energia y +1 lvl.
                $pj1->setDuelosGanadosPersonaje($pj1->getDuelosGanadosPersonaje() + 1);
                $pj1->setEnergiaPersonaje($pj1->getEnergiaPersonaje() + 5);
                $pj1->setNivelPersonaje($pj1->getNivelPersonaje() + 1);

                // Fin logica Ganador 1

                // Inicio logica perdedor jugador 2, 
                // Si gana 1 entonces acá mismo contabilizar derrota del otro jugdaor. Considerar que si pierde:
                //  Recibe daño igual a: PoderGanador - PoderPerdedor

                $pj2->setDuelosPerdidosPersonaje($pj2->getDuelosPerdidosPersonaje() + 1);
                $pj2->setEnergiaPersonaje($pj2->getEnergiaPersonaje() - 10);
                $pj2->recibirDanio($poderPj1 - $poderPj2);
                // Fin logica Perdedor jugador2

                // Inicio lógica de estado POST DUELO PERDIDO PARA JUGADOR 2
                if ($pj2->getPuntosVidaPersonaje() <= 0) {
                    $pj2->setEstadoPersonaje("retirado");
                } else if ($pj2->getPuntosVidaPersonaje() < 30) {
                    $pj2->setEstadoPersonaje("lesionado");
                }
            } else if ($poderPj1 < $poderPj2) {

                // Misma lógica pero opuesta.
                echo "Gana pj2";
                // Inicio logica de ganador pj2

                $duelosGanados = $pj2->getDuelosGanadosPersonaje();
                $pj2->setDuelosGanadosPersonaje($pj2->getDuelosGanadosPersonaje() + 1);

                // Si uno gana +1 win,+ 5 energia y +1 lvl.
                $pj2->setEnergiaPersonaje($pj2->getEnergiaPersonaje() + 5);
                $pj2->setNivelPersonaje($pj2->getNivelPersonaje() + 1);

                // Fin logica Ganador pj2

                // Inicio logica perdedor jugador 1, 

                $pj1->setDuelosPerdidosPersonaje($pj1->getDuelosPerdidosPersonaje() + 1);
                $pj1->setEnergiaPersonaje($pj1->getEnergiaPersonaje() - 10);
                $pj1->recibirDanio($poderPj2 - $poderPj1);
                // Fin logica Perdedor jugador1

                // Inicio lógica de estado POST DUELO PERDIDO PARA JUGADOR 1
                if ($pj1->getPuntosVidaPersonaje() <= 0) {
                    $pj1->setEstadoPersonaje("retirado");
                } else if ($pj1->getPuntosVidaPersonaje() < 30) {
                    $pj1->setEstadoPersonaje("lesionado");
                }
            }





            // Internamente tambien previo al duelo y antes de terminar función determinar en que estado quedará el personaje.
            // estadoActual<- es la función creada en Personaje para ver su estado

        }
    }
}
