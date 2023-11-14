<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UsuarioController extends Controller
{
    public function store(UsuarioRequest $request){
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
    public function pesquisarPorId($id){
        $usuario = Usuario::find($id);
        if($usuario == null){
            return response()->json([
                'status' => false,
                'message' => "Usuário não encontrado"
            ]);
        }
        return response()->Json([
            'status' => true,
            'data' => $usuario
        ]);
    }
    public function pesquisarPorCpf($cpf){
        $usuario = Usuario::where('cpf', '=', $cpf)->first();
        if($usuario == null){
            return response()->json([
                'status' => false,
                'message' => "Cpf não encontrado"
            ]);
        }
        return response()->Json([
            'status' => true,
            'data' => $usuario
        ]);
    }
    public function retornarTodos(){
        $usuarios = Usuario::All();
        return response()->json([
            'status' => true,
            'data' => $usuarios
        ]);
    }
    public function pesquisarPorNome(Request $request){
        $usuarios = Usuario::where('name', 'like', '%' . $request->nome . '%')->get();
        if(count($usuarios) > 0){
            return response()->json([
                'status' => true,
                'data' => $usuarios
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para esta busca.'
        ]);
    }
    public function excluir($id){
        $usuario = Usuario::find($id);
        if(!isset($usuario)){
            return response()->json([
                'status' => false,
                'message' => 'usuário não encontrado'
            ]);
        }
        $usuario->delete();
        return response()->json([
            'status' => true,
            'message' => 'usuário deletado com êxito'
        ]);
        }
        public function update(Request $request){
            $usuario = Usuario::find($request->id);
            if(!isset($usuario)){
                return response()->json([
                    'status' => false,
                    'message' => "Usuário não encontrado"
                ]);
            }
            if(isset($request->name)){
                $usuario->name = $request->name;
            }
            if(isset($request->cellphone)){
                $usuario->cellphone = $request->cellphone;
            }
            if(isset($request->cpf)){
                $usuario->cpf = $request->cpf;
            }
            if(isset($request->email)){
                $usuario->email = $request->email;
            }
            $usuario->update();
            return response()->json([
                'status' => true,
                'message' => 'Usuário atualizado'
            ]);
    }
        public function exportarCsv(){
            $usuarios = Usuario::all();
            $nomeArquivo = 'usuarios.csv';
            $filePath = storage_path('app/public/'.$nomeArquivo);
            $handle = fopen($filePath, "w");
            fputcsv($handle, array('name','cellphone','cpf', 'email'));
            foreach($usuarios as $u){
                fputcsv($handle, array(
                    $u-> name,
                    $u->cellphone,
                    $u->cpf,
                    $u -> email
                ));
            }

            fclose($handle);

            return Response::download(public_path()."/storage/".$nomeArquivo)->deleteFileAfterSend(true);
        }
}   