<?php

namespace App\Http\Controllers;

use App\Models\Imperium;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ImperiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alistamento = Imperium::ALL();
        $contador = $alistamento->count();
    
        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Soldado encontrado com sucesso! Bem vindos irmãos',
                'data' => $alistamento,
                'total' => $contador
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Irmão não localizado, SUMA HEREGE!'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Astra_Militarum' => 'required',
            'Adeptus_Mechanicus' => 'required',
            'Adeptus_Astartes' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registro de soldado invalido',
                'errors' => $validator->errors()
            ], 400);
        }

        $alistamento = Imperium::create($request->all());

        if ($alistamento) {
            return response()->json([
                'success' => true,
                'message' => 'Soldado cadastrado com sucesso! Bem vindos irmãos',
                'data' => $alistamento
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Seu cerebro é como o de um orck, tente novamente'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $alistamento = Imperium::find($id);
 
        if ($alistamento) {
            return response()->json([
                'success' => true,
                'message' => 'Irmão encontrado',
                'data' => $alistamento
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
    public function update(Request $request, string $id)
    {
        $alistamento = Imperium::find($id);
       
        if (!$alistamento) {
            return response()->json([
                'success' => false,
                'message' => 'Irmão perdido no warp! procure a luz do imperador'
            ], 404);
        }
 
        $validator = Validator::make($request->all(), [
            'Astra_Militarum' => 'required',
            'Adeptus_Mechanicus' => 'required',
            'Adeptus_Astartes' => 'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'HEREGE TOLO, SE AFASTE',
                'errors' => $validator->errors()
            ], 400);
        }
 
        $alistamento->Astra_Militarum = $request->Astra_Militarum;
        $alistamento->Adeptus_Mechanicus = $request->Adeptus_Mechanicus;
        $alistamento->Adeptus_Astartes = $request->Adeptus_Astartes;
 
        if ($alistamento->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Mais anos de servidão ao Deus-Imperador! Parabens!',
                'data' => $alistamento
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Possivel envio para a Death Watch, tenha fé'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alistamento = Imperium::find($id);
 
        if (!$alistamento) {
            return response()->json([
                'success' => false,
                'message' => 'Irmão não encontrado'
            ], 404);
        }
 
        if ($alistamento->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Irmão morto em combate'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Corpo não localizado'
            ], 500);
        }
    }
}
