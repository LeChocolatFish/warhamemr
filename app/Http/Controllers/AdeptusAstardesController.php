<?php

namespace App\Http\Controllers;

use App\Models\AdeptusAstardes;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AdeptusAstardesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regAstades = AdeptusAstardes::AlL();
        $contador = $regAstades->count();
        
        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Irmão encontrado com sucesso! Bem vindos irmãos',
                'data' => $regAstades,
                'total' => $contador
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Irmão não localizado',
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'chapter' => 'required',
            'rank' => 'required',
            'dreadnought' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'registro de Irmão invalido',
                'errors' => $validator->errors()
            ], 400);
        }

        $regAstades = AdeptusAstardes::create($request->all());

        if ($regAstades) {
            return response()->json([
                'success' => true,
                'message' => 'irmão cadastrado com sucesso! Bem vindos irmãos',
            ], 201);
        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'irmão não cadastrado',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AdeptusAstardes $adeptusAstardes)
    {
        $regAstades = AdeptusAstardes::find($id);

        if ($regAstades) {
            return response()->json([
                'success' => true,
                'message' => 'Irmão encontrado',
                'data' => $regAstades
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Irmão perdido no warp! procure a luz do imperador'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdeptusAstardes $adeptusAstardes)
    {
        $regAstades = AdeptusAstardes::find($id);

        if (!$regAstades) {
            return response()->json([
                'success' => false,
                'message' => 'Irmão perdido no warp! procure a luz do imperador'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'chapter' => 'required',
            'rank' => 'required',
            'dreadnought' => 'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'registro de Irmão invalido',
                'errors' => $validator->errors()
            ], 400);
        }

        $regAstades->name = $request->name;
        $regAstades->chapter = $request->chapter;
        $regAstades->rank = $request->rank;
        $regAstades->dreadnought = $request->dreadnought;

        if ($regAstades->save()) {
            return response()->json([
                'success' => true,
                'message' => 'irmão atualizado com sucesso! Bem vindos irmãos',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'irmão não atualizado',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdeptusAstardes $adeptusAstardes)
    {
        $regAstades = AdeptusAstardes::find($id);
 
        if (!$regAstades) {
            return response()->json([
                'success' => false,
                'message' => 'Irmão não encontrado'
            ], 404);
        }
 
        if ($regAstades->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Irmão perdido em combate'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Irmão não localizado'
            ], 500);
        } 
    }
}
