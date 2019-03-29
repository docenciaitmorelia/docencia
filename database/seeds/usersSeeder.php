<?php

use Illuminate\Database\Seeder;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'Administrador',
        'rol' => 'Administrador',
        'clave_area' => '110600',
        'email' => 'admin@itmorelia.edu.mx',
        'password' => bcrypt('admin'),
      ]);
      DB::table('users')->insert([
        'name' => 'Jefe de Docencia',
        'rol' => 'Jefe de Docencia',
        'clave_area' => '110600',
        'email' => 'docencia@itmorelia.edu.mx',
        'password' => bcrypt('docencia'),
      ]);

      DB::table('users')->insert([
        'name' => 'Jefe de División de Est. Prof.',
        'rol' => 'DivEstProf',
        'clave_area' => '111000',
        'email' => 'dep@itmorelia.edu.mx',
        'password' => bcrypt('dep'),
      ]);
    }
}
