<?php

declare(strict_types=1);

namespace App\Belich\Cards;

use Daguilarm\Belich\Components\Cards\Card;
use Illuminate\Http\Request;

class CalendarCard extends Card {

    public function __construct(Request $request)
    {
        parent::__construct();
    }

    /**
     * Return the view
     */
    public function view() : string
    {
        return 'cards.calendar';
    }

    /**
     * Return the view data
     */
    public function withMeta() : array
    {
        return [
            //
        ];
    }

    /**
     * Get the URI key for the card
     */
    public function uriKey() : string
    {
        return 'user-card1';
    }
}
