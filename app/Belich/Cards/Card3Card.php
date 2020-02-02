<?php

declare(strict_types=1);

namespace App\Belich\Cards;

use Daguilarm\Belich\Components\Cards\Card;
use Illuminate\Http\Request;

class Card3Card extends Card {

    public function __construct(Request $request)
    {
        parent::__construct();
    }

    /**
     * Return the view
     */
    public function view() : string
    {
        return 'cards.card3';
    }

    /**
     * Return the view data
     */
    public function withMeta() : array
    {
        return [
            'users' => \App\User::pluck('name', 'id')->toArray(),
        ];
    }

    /**
     * Get the URI key for the card
     */
    public function uriKey() : string
    {
        return 'user-card3';
    }
}
