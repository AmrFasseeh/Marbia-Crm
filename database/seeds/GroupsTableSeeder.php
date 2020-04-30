<?php

use Illuminate\Database\Seeder;
use Junges\ACL\Http\Models\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Junges\ACL\Http\Models\Group::class)->states('admin')->create();
        factory(\Junges\ACL\Http\Models\Group::class)->states('user')->create();
    }
}
 