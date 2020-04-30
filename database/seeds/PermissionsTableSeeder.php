<?php

use Illuminate\Database\Seeder;
use Junges\ACL\Http\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Permission::class)->states('add_user')->create();
        factory(Permission::class)->states('edit_user')->create();
    }
}
