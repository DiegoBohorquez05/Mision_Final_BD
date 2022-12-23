<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show(){
        $movies = Catalogue::all();

        return response()->json([
            'catalogue' => $movies
        ], 200);
    }

    public function index(Request $request){
        try{
            $request->validate([
                'movie_id' => 'required|exist:Catalogue,id'
            ]);
        }catch (\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 400);
        }

        $id_peli = $request->movie_id;

        return Catalogue::find($id_peli);
    }

    public function create(Request $request){
        try{
            $request->validate([
                'name' => 'required',
                'producer_name' => 'required',
                'release_date' => 'required',
            ]);
        }catch (\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 400);
        }

        Catalogue::create([
            'name' => $request->name,
            'producer_name' => $request -> producer_name,
            'release date' => $request -> release_date,
        ]);
    }

    public function update(Request $request, $id){
        // return response()->json($id);
        try{
            $request->validate([
                'name'=>'required',
                'producer_name' =>'required',
                'release_date' =>'required'
            ]);
        }catch (\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 400);
        }

        // return response()->json(Catalogue::find($id));
        $movie = Catalogue::find($id);

        $movie->update([
            'name'=> $request->name,
            'producer_name' => $request->producer_name,
            'release_date' => $request->release_date
        ]);
        
        return Catalogue::find($movie);
    }

    public function delete($id){
        $movie=Catalogue::find($id);
        $movie->delete();
        return response()->json($movie);
    }

}
