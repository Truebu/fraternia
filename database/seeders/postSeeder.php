<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class postSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publicacion')->insert([
            [
                'publicacionTitulo'=>'Frontend',
                'pubpublicacionDescripcion'=>'Se busca',
                'fk_tipoPublicacionId' => 1,
                'fk_usuarioId'=> 1,
                'publicacionFechaCreacion' => '2020-10-02'
            ],
        ]);
    }
}
