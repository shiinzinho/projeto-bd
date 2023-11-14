<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i < 100; $i++){
        Usuario::create([
            'name' => 'shin'.$i,
            'cellphone' => rand(00000000001, 99999999999),
            'cpf' => rand(00000000001, 99999999999),
            'email' => 'shin' .$i. '@zinho.com',
            'password' => Hash::make('123321')
        ]);
    }
  }
}