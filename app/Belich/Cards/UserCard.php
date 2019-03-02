<?php

namespace App\Belich\Cards;

use Daguilarm\Belich\Components\Cards\Card;
use Illuminate\Http\Request;

class UserCard extends Card {

    /**
     * Initialize the card
     *
     * @return string
     */
    public function __construct(Request $request)
    {
        parent::__construct();
    }

    /**
     * Return the view
     *
     * @return string
     */
    public function view() : string
    {
        return 'cards.users';
    }

    /**
     * Return the view data
     *
     * @return string
     */
    public function withMeta() : array
    {
        return [
            'users' => \App\User::take(20)->get(),
        ];
    }

    /**
     * Get the URI key for the card
     *
     * @return string
     */
    public function uriKey() : string
    {
        return 'user-card';
    }
}
