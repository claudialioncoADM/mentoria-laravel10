<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create(
            [
                'nome' => 'Andrea',
                'email' => 'andrea@gmail.com',
                'endereco' => 'xxxxxxxxx',
                'logradouro' => 'xxxx',
                'cep' => '99999999',
                'bairro' => 'xxxxxx',
            ]
        );
        Cliente::create(
            [
                'nome' => 'Sharon',
                'email' => 'sharon@gmail.com',
                'endereco' => 'xxxxxxxxx',
                'logradouro' => 'xxxx',
                'cep' => '99999999',
                'bairro' => 'xxxxxx',
            ]
        );
    }
}
