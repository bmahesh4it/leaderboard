<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required|integer',
            'address' => 'required',
            'photo' => 'required|image',
        ]);

        $photoPath = $request->file('photo')->store('photos', 's3');
        $photoUrl = \Storage::disk('s3')->url($photoPath);

        $user = User::create([
            'name' => $request->name,
            'age' => $request->age,
            'address' => $request->address,
            'photo_url' => $photoUrl,
        ]);

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function updatePoints(Request $request, User $user)
    {
        $user->points += $request->points;
        $user->save();

        return response()->json($user, 200);
    }

    public function leaderboard()
    {
        $users = User::orderBy('points', 'desc')->get();
        $leaderboard = $users->groupBy('points')->map(function ($group) {
            return [
                'names' => $group->pluck('name')->all(),
                'average_age' => $group->avg('age'),
            ];
        });

        return response()->json($leaderboard);
    }
}

