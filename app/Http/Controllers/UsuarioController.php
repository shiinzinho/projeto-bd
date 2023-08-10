<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function store(Request $request){
        $usuario = Usuario::create([
            'name' => $request->name,
            'cellphone' => $request->cellphone,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            "sucess" => true,
            "message" => "Registered User",
            "data"=>$usuario
        ], 200);
    }
}
