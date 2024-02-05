<?php

session_start();

require_once "../parts/header.php";

require_once "../../api/pokemons.api.php";
require_once "../utilities.views.php";

$pokemonId = $_GET['pokemon_id'];
$pokemonImage = generateImageUrl($pokemonId);

$pokemon = API_Pokemon::get_pokemon_by_id($pokemonId);
$types = API_Pokemon::get_pokemon_type($pokemonId);
$abilities = API_Pokemon::get_pokemon_ability($pokemonId);

if ($pokemon !== null) : ?>
    <div id="pokemon-display-profile">
        <h3><?= ucfirst($pokemon['name']) ?></h3>
        <img src="<?= $pokemonImage ?>" alt="<?= $pokemon['name'] ?>">

        <?php if ($types !== null) : ?>
            <h4> Type: </h4>
            <h4>
                <?= ucfirst($types[0]['type']['name']) ?>
                <?php if (!empty($types[1]['type']['name'])) : ?>
                    , <?= ucfirst($types[1]['type']['name']) ?>
                <?php endif; ?>
            </h4>
        <?php else : ?>
            <h4> Type: Unknown</h4>
        <?php endif; ?>

        <?php if ($abilities !== null) : ?>
            <h4> Abilities: </h4>
            <h4>
                <?= ucfirst($abilities[0]['ability']['name']) ?>
                <?php if (!empty($abilities[1]['ability']['name'])) : ?>
                    , <?= ucfirst($abilities[1]['ability']['name']) ?>
                <?php endif; ?>
                <?php if (!empty($abilities[2]['ability']['name'])) : ?>
                    , <?= ucfirst($abilities[2]['ability']['name']) ?>
                <?php endif; ?>
            </h4>
        <?php else : ?>
            <h4> Abilities: Unknown</h4>
        <?php endif; ?>

    <?php else : ?>
        <p>Error: Pokémon not found.</p>
    <?php endif; ?>
    </div>


    <div id="btn-box">
        <p>hey</p>
        <a class="primary-btn" href="./catchpokemon.views.php">Back to the forest</a>
    </div>