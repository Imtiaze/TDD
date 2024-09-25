<?php

use Illuminate\Validation\Rules\Enum;

require __DIR__.'/../../vendor/autoload.php';


enum Suit: string {
    case Clubs = 'clubs';
    case Diamonds = 'diamonds';
    case Hearts = 'hearts';
    case Spades = 'spades';
}

function pickCard(Suit $suit)
{
    dump($suit->name);
    dump($suit->value);
}

pickCard(Suit::Clubs);

dump(Suit::Hearts->value);

dump(Suit::from('clubs'));

dump(new Enum(Suit::class));