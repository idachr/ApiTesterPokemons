<?php

class CatchPokemonController extends PokemonModel {
    private $pokemonId;
    private $trainerId;

    public function __construct($trainerId, $pokemonId)
    {
        $this->pokemonId = $pokemonId;
        $this->trainerId = $trainerId;
    }

    public function catchPokemon() {
        if ($this->checkIfPokemonAlreadyCatched() == false){
            header("Location: ../index.php?error=checkiftaken");
            exit();
        }

        $this->addPokemon($this->trainerId, $this->pokemonId);
    }

    //Error handling
    private function checkIfPokemonAlreadyCatched() {
        $result = false;
        if (!$this->checkPokemon($this->trainerId, $this->pokemonId)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}