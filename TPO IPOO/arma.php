<?php

class Arma {
    private int $id;
    private string $nombre;
    private string $tipo;
    private float $danioBase;
    private Personaje $nivelMinimo;
    private string $estado;

    public function __construct(int $id, string $nombre, string $tipo, float $danioBase, Personaje $nivelMinimo, string $estado) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->danioBase = $danioBase;
        $this->nivelMinimo = $nivelMinimo;
        $this->estado = $estado;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getTipo(): string {
        return $this->tipo;
    }

    public function getDanioBase(): float {
        return $this->danioBase;
    }

    public function getNivelMinimo(): Personaje {
        return $this->nivelMinimo;
    }

    public function getEstado(): string {
        return $this->estado;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setTipo(string $tipo): void {
        $this->tipo = $tipo;
    }

    public function setDanioBase(float $danioBase): void {
        $this->danioBase = $danioBase;
    }

    public function setNivelMinimo(Personaje $nivelMinimo): void {
        $this->nivelMinimo = $nivelMinimo;
    }

    public function setEstado(string $estado): void {
        $this->estado = $estado;
    }

    public function calcularDanio(){
        return $this->getDanioBase();
    }

    public function puedeSerEquipadaPor(Personaje $personaje){
        $salida = true;

        if($this->getEstado() === "rota"){
            $salida = false;
        }

        if($this->getEstado() === "equipada"){
            $salida = false;
        }

        if($personaje->getNivelPersonaje() < $this->getNivelMinimo()){
            $salida = false;
        }

        return $salida;
    }
}