<?php

require_once __DIR__ . '/../models/pokemon.models.php';

//Api for pokemon api

class API_Pokemon {
    
    const BASE = 'https://pokeapi.co/api/v2/';
    const POKEMON = 'pokemon/';

    private static function sendRequest($url)
    {
        $ch = curl_init();

        $timeout = 5;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($http_code != 200) {
            return json_encode('An error has occurred.');
        }

        return $data;
    }

    //--------------------------------------------------------------------------Catch pokemons start---------------------

    public static function get_all_pokemons()
    {
        $url = self::BASE . self::POKEMON;
        return self::sendRequest($url);
    }

    public static function get_all_pokemons_not_owned($trainerId)
    {
        $allPokemonsResponse = self::get_all_pokemons();

        if ($allPokemonsResponse === null) {
            return [];
        }

        $allPokemons = json_decode($allPokemonsResponse, true);

        if (!is_array($allPokemons) || empty($allPokemons['results'])) {
            return [];
        }

        $pokemonModel = new PokemonModel();
        $pokemonsTrainerOwns = $pokemonModel->getUserOwnedPokemons($trainerId);

        $pokemonsNotOwned = array_filter($allPokemons['results'], function ($pokemon) use ($pokemonsTrainerOwns) {
            return isset($pokemon['url']) && !in_array(basename($pokemon['url']), $pokemonsTrainerOwns);
        });        

        return array_values($pokemonsNotOwned);
    }





     //--------------------------------------------------------------------------Catch pokemons end---------------------

     //--------------------------------------------------------------------------Pokemon profile start---------------------

    public static function get_pokemon_by_id($pokemon_id)
    {
        $url = self::BASE . self::POKEMON . $pokemon_id;
        $apiResponse = self::sendRequest($url);

        if ($apiResponse === false) {
            return null;
        }

        $data = json_decode($apiResponse, true);

        if (isset($data['id'])) {
            return $data;
        } else {
            return null;
        }
    }

    public static function get_pokemon_type($pokemon_id){
        $url = self::BASE . self::POKEMON . $pokemon_id;
        $apiResponse = self::sendRequest($url);
    
        if ($apiResponse === false) {
            return null;
        }
    
        $data = json_decode($apiResponse, true);
    
        if (isset($data['types'])) {
            return $data['types'];
        } else {
            return null;
        }
    }   

    public static function get_pokemon_ability($pokemon_id){
        $url = self::BASE . self::POKEMON . $pokemon_id;
        $apiResponse = self::sendRequest($url);
    
        if ($apiResponse === false) {
            return null;
        }
    
        $data = json_decode($apiResponse, true);
    
        if (isset($data['abilities'])) {
            return $data['abilities'];
        } else {
            return null;
        }
    }   
    
     //--------------------------------------------------------------------------Pokemon profile end---------------------

     //--------------------------------------------------------------------------Pokeball start---------------------

    public static function get_owned_pokemons($trainerId)
    {
        $pokemonModel = new PokemonModel();

        $pokemonsTrainerOwns = $pokemonModel->getUserOwnedPokemons($trainerId);

        $pokemons = [];
        foreach ($pokemonsTrainerOwns as $pokemonId) {
            $pokemonData = self::get_pokemon_by_id($pokemonId);
            if ($pokemonData !== null) {
                $pokemons[] = $pokemonData;
            }
        }

        return $pokemons;
    }

     //--------------------------------------------------------------------------Pokeball end---------------------
}