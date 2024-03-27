<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $players = Player::paginate($request->get('per_page', 10));
        $players->each(function($player, $key) {
            if (!is_null($player->image)){
                $player->image = asset('uploads/players/' . $player->image);
            }
        });
        return response()->json($players);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'nationality' => 'required',
            'position' => 'required',
        ]);

        $image = null;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'player' . bin2hex(random_bytes(20)) . '.' . $file->extension();
            Storage::disk('public')->put('players/' . $image, file_get_contents($file));
        }

        $request->merge(['image' => $image]);

        $player = Player::create($request->all());
        return response()->json($player);
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        $player = Player::find($id);
        if ($player) {
            return response()->json($player);
        }else{
            return response()->json(['message' => 'player not found.'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'nationality' => 'required',
            'position' => 'required',
        ]);

        $image = null;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'player' . bin2hex(random_bytes(20)) . '.' . $file->extension();
            Storage::disk('public')->put('players/' . $image, file_get_contents($file));
        }
        
        $player = Player::find($id);
        if ($player) {
            $player->name        = is_null($request->name) ? $player->name : $request->name;
            $player->last_name   = is_null($request->last_name) ? $player->last_name : $request->last_name;
            $player->age         = is_null($request->age) ? $player->age : $request->age;
            $player->nationality = is_null($request->nationality) ? $player->nationality : $request->nationality;
            $player->position    = is_null($request->position) ? $player->position : $request->position;
            $player->image       = is_null($image) ? $player->image : $image;

            $player->save();

            return response()->json(Player::find($player->id));
        }else{
            return response()->json(['message' => 'player not found.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        $player = Player::find($id);
        if ($player) {
            $player->delete();

            return response()->json(['message' => 'player deleted.'], 202);
        }else{
            return response()->json(['message' => 'player not found.'], 404);
        }
    }
}
