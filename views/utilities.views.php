<?php

function generateImageUrl($pokemonId) {
    return 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' . $pokemonId . '.png';
}

function generateType($pokemonId) {
    return 'https://pokeapi.co/api/v2/type/' . $pokemonId . '/';
}