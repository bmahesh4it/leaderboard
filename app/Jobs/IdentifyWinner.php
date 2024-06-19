<?php

// app/Jobs/IdentifyWinner.php
namespace App\Jobs;

use App\Models\User;
use App\Models\Winner;
use Illuminate\Support\Facades\DB;

class IdentifyWinner extends Job
{
    public function handle()
    {
        $topUsers = User::orderBy('points', 'desc')->take(2)->get();

        if ($topUsers->count() > 1 && $topUsers[0]->points == $topUsers[1]->points) {
            return; // Tie condition
        }

        $winner = $topUsers->first();

        Winner::create([
            'user_id' => $winner->id,
            'points' => $winner->points,
            'declared_at' => now(),
        ]);
    }
}

