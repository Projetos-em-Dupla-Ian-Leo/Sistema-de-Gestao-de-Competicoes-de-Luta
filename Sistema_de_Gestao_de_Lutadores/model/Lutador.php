<?php

class Lutador{
    private $id;
    private $nome_ringue;
    private $nome_real;
    private $estilo;
    private $afiliacao;
    private $vitorias;
    private $derrotas;
    private $empates;
    private $health;
    private $attack;
    private $defense;
    private $agility;

    public function getId(){

        return $this -> id;
    }

    public function getNomeRingue(){

        return $this -> nome_ringue;
    }

    public function getNomeReal(){

        return $this -> nome_real;
    }

    public function getEstilo(){

        return $this -> estilo;
    }

    public function getAfiliacao(){

        return $this -> afiliacao;
    }

    public function getVitorias(){

        return $this -> vitorias;
    }

    public function getDerrotas(){

        return $this -> derrotas;
    }

    public function getEmpates(){

        return $this -> empates;
    }

    public function getHealth(){

        return $this -> health;
    }

    public function getAttack(){

        return $this -> attack;
    }

    public function getDefense(){

        return $this -> defense;
    }

    public function getAgility(){

        return $this -> agility;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNomeRingue($nome_ringue)
    {
        $this->nome_ringue = $nome_ringue;
    }

    public function setNomeReal($nome_real)
    {
        $this->nome_real = $nome_real;
    }

    public function setEstilo($estilo)
    {
        $this->estilo = $estilo;
    }

    public function setAfiliacao($afiliacao)
    {
        $this->afiliacao = $afiliacao;
    }

    public function setVitorias($vitorias)
    {
        $this->vitorias = $vitorias;
    }

    public function setDerrotas($derrotas)
    {
        $this->derrotas = $derrotas;
    }

    public function setEmpates ($empates)
    {
        $this->empates = $empates;
    }

    public function setHealth($health)
    {
        $this->health = $health;
    }

    public function setAttack($attack)
    {
        $this->attack = $attack;
    }

    public function setDefense($defense)
    {
        $this->defense = $defense;
    }

    public function setAgility($agility)
    {
        $this->agility = $agility;
    }

    public function getTaxaVitoria(){
        $total = $this->vitorias + $this->derrotas + $this->empates;
        if ($total == 0) return 0;
        return round(($this->vitorias/$total) * 100, 1);
    }

    public function getRank($stat){
        $value = $this->$stat; 
        if ($value >= 900) return ['rank'=> 'S', 'class' => 'rank-s'];
        if ($value >= 800) return ['rank'=> 'A', 'class' => 'rank-a'];
        if ($value >= 700) return ['rank'=> 'B', 'class' => 'rank-b'];
        if ($value >= 600) return ['rank'=> 'C', 'class' => 'rank-c'];
        return ['rank'=> 'D', 'class' => 'rank-d'];
    }
}