<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdultRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*DB::table('user_roles')->insert([
            'name' => 'admin',
        ]);

        DB::table('accounts')->insert([
            'balance' => 1500,
        ]);*/
        /*DB::table('children_users')->insert([
            'child_id' => 1,
            'user_id' => 1,
        ]);*/
        DB::table('children_adults')->insert([
           [ 'child_id' => 2,'adult_id' => 3],
           [ 'child_id' => 3,'adult_id' => 3],
           [ 'child_id' => 14,'adult_id' => 3],
        ]);
        /*DB::table('children_adults')->insert([
            'child_id' => 3,
            'adult_id' => 2,
        ]);*/

    }
}
