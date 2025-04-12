<?php

namespace App\Http\Controllers;

use App\Models\AstraMilitarum;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AstraMilitarumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regMilitarum = AstraMilitarum::All();
        $contador = $regMilitarum->count();

        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Soldado encontrado com sucesso! Bem vindos soldados',
                'data' => $regMilitarum,
                'total' => $contador
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'soldado não localizado'
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
            'regiment' => 'required',
            'rank' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'registro de soldado invalido',
                'errors' => $validator->errors()
            ], 400);
        }

        $regMilitarum = AstraMilitarum::create($request->all());
        
        if ($regMilitarum) {
            return response()->json([
                'success' => true,
                'message' => 'soldado cadastrado com sucesso! Bem vindos soldado ',
            ], 201);
        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'soldado não cadastrado',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AstraMilitarum $astra_Militarum)
    {
        $regMilitarum = AstraMilitarum::find($id);

        if ($regMilitarum) {
            return response()->json([
                'success' => true,
                'message' => 'soldado encontrado',
                'data' => $regMilitarum
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'soldado perdido no warp! procure a luz do imperador'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AstraMilitarum $astra_Militarum)
    {
        $regMilitarum = AstraMilitarum::find($id);

        if (!$regMilitarum) {
            return response()->json([
                'success' => false,
                'message' => 'soldado perdido no warp! procure a luz do imperador'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'regiment' => 'required',
            'rank' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'registro de soldado invalido',
                'errors' => $validator->errors()
            ], 400);
        }
        $regMilitarum->name = $request->name;
        $regMilitarum->regiment = $request->regiment;
        $regMilitarum->rank = $request->rank;

        if ($regMilitarum->save()) {
            return response()->json([
                'success' => true,
                'message' => 'soldado atualizado com sucesso! Bem vindos soldados',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'soldado não atualizado',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AstraMilitarum $astra_Militarum)
    {
        $regMilitarum = AstraMilitarum::find($id);
 
        if (!$regMilitarum) {
            return response()->json([
                'success' => false,
                'message' => 'soldado não encontrado'
            ], 404);
        }
 
        if ($regMilitarum->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'soldado perdido em combate'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'soldado não localizado'
            ], 500);
        }
    }
}
