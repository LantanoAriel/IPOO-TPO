<?php

class Guerrero extends Personaje{
    private int $fuerza;
    private int $armadura;

    public function __construct(int $fuerza, int $armadura, int $idPersonaje, string $nombrePersonaje, int $nivelPersonaje, int $puntosVidaPersonaje, int $energiaPersonaje, int $duelosGanadosPersonaje, int $duelosPerdidosPersonaje, int $estadoPersonaje, int $armaPersonaje){
        parent::__construct( $idPersonaje, $nombrePersonaje, $nivelPersonaje, $puntosVidaPersonaje, $energiaPersonaje,
        $duelosGanadosPersonaje, $duelosPerdidosPersonaje, $estadoPersonaje, $armaPersonaje);
        $this->fuerza = $fuerza;
        $this->armadura = $armadura;
    }

    public function getFuerza(){
        return $this->fuerza;
    }

    public function setFuerza(int $fuerza){
        $this->fuerza = $fuerza;
    }

    public function getArmadura(){
        return $this->armadura;
    }

    public function setArmadura(int $armadura){
        $this->armadura = $armadura;
    }

    public function calcularPoderBase(){
        $this->getNivelPersonaje() * 15;
    }

    public function calcularPoderEspecial(){
        $this->getFuerza() * 2 + $this->getArmadura();
    }
}