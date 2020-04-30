<?php

use Illuminate\Database\Seeder;

class DealStagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DealStages::class)->states('untouched')->create();
        factory(App\DealStages::class)->states('first_visit')->create();
        factory(App\DealStages::class)->states('proposal')->create();
        factory(App\DealStages::class)->states('quote')->create();
        factory(App\DealStages::class)->states('confirm')->create();
    }
}
