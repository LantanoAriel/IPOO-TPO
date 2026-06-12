<?php 
require_once 'Duelo.php';

class Torneo {
    private $personajes = [];
    private $armas = [];
    private $arenas = [];
    private $duelos = [];

    // public function __construct($personajes, $armas, $arenas, $duelos) {
    //     $this->personajes = $personajes;
    //     $this->armas = $armas;
    //     $this->arenas = $arenas;
    //     $this->duelos = $duelos;
    // }

    // Getters
    public function getPersonajes(){
        return $this->personajes;
    }

    public function getArmas(){
        return $this->armas;
    }

    public function getArenas(){
        return $this->arenas;
    }

    public function getDuelos(){
        return $this->duelos;
    }

    // Setters
    public function setPersonajes(array $personajes): void {
        $this->personajes = $personajes;
    }

    public function setArmas(array $armas): void {
        $this->armas = $armas;
    }

    public function setArenas(array $arenas): void {
        $this->arenas = $arenas;
    }

    public function setDuelos(array $duelos): void {
        $this->duelos = $duelos;
    }

    // Metodos

    public function agregarPersonajes(Personaje $personaje){
        $this->personajes[] = $personaje;
    }

    public function agregarArma(Arma $arma){
        $this->armas[] = $arma;
    }
    
    public function agregarArena(Arena $arena){
        $this->arenas[] = $arena;
    }
    
    public function equiparArma(Personaje $personaje, Arma $arma){
        if($arma->puedeSerEquipadaPor($personaje) == true){
            $personaje->setArmaPersonaje($arma);
            $arma->setEstado("equipada");
            $salida = "Arma equipada";
        }else {
            $salida = "No es posible equipar el arma";
        }

        return $salida;
    }

    public function registrarDuelo(Duelo $duelo){
        $this->duelos[] = $duelo;
    }

    public function realizarDuelo(Duelo $duelo){
        if($duelo->puedeRealizarse() == true){
            $duelo->realizarDuelo();
        }else{
            return "No se pudo realizar el duelo";
        }
    }
    
    public function listarPersonajes(){
        $salida = [];
        foreach($this->getPersonajes() as $personaje){
            $salida[] = $personaje;
        }
        return $salida;
    }
    
    public function listarArmas(){
        $salida = [];
        foreach($this->getArmas() as $arma){
            $salida[] = $arma;
        }
        return $salida;
    }
    
    public function listarArenas(){
        $salida = [];
        foreach($this->getArenas() as $arena){
            $salida[] = $arena;
        }
        return $salida;
    }
    
    public function listarDuelos(){
        $salida = [];
        foreach($this->getDuelos() as $duelo){
            $salida[] = $duelo;
        }
        return $salida;
    }

    public function rankingPersonajes(){
        uasort($this->getPersonajes(),  )
    }
}