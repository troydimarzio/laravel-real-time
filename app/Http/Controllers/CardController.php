<?php

namespace App\Http\Controllers;

use App\Events\ScoreUpdated;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function show(Card $card)
    {
        $user = auth()->user();
        $user->score = $user->score + $card->value;
        $user->save();

        event(new ScoreUpdated($user));

        return redirect()->back()->withValue($card->value);
    }

    public function leaderboard()
    {
        return User::all(['id', 'name', 'score']);
    }
}
