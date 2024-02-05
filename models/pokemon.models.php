<?php

require_once __DIR__ . '/../classes/dbh.classes.php';

class PokemonModel extends Dbh
{

    protected function addPokemon($trainerId, $pokemonId)
    {

        $stmt = parent::connect()->prepare("INSERT INTO owned_pokemons (trainer_id, pokemon_id) VALUES (?,?);");

        if (!$stmt->execute(array($trainerId, $pokemonId))) {
            $stmt = null;
            header("Location: ../views/private/catchpokemon.views.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkPokemon($trainerId, $pokemonId) {
        $stmt = parent::connect()->prepare("SELECT pokemon_id FROM owned_pokemons WHERE trainer_id = ? AND pokemon_id = ?;");

        if (!$stmt->execute(array($trainerId, $pokemonId))) {
            $stmt = null;
            header("Location: ../views/private/catchpokemon.views.php?error=stmtfailed");
            exit();
        }

        $resultCheck = false;

        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        }
        else {
            $resultCheck = true;
        }
        return $resultCheck;
    }

    public function getUserOwnedPokemons($trainerId)
    {
        $stmt = parent::connect()->prepare("SELECT pokemon_id FROM owned_pokemons WHERE trainer_id = ?;");

        if (!$stmt->execute(array($trainerId))) {
            $stmt = null;
            header("Location: ../views/private/catchpokemon.views.php?error=stmtfailed");
            exit();
        }

        $userOwnedPokemons = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $stmt = null;

        return $userOwnedPokemons;
    }

    protected function releasePokemon($trainerId, $pokemonId)
    {

        $stmt = parent::connect()->prepare("DELETE FROM owned_pokemons WHERE trainer_id = ? AND pokemon_id = ?;");

        if (!$stmt->execute(array($trainerId, $pokemonId))) {
            $stmt = null;
            header("Location: ../views/private/pokeball.views.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}


