<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = Page::create([
            'name' => 'home',
        ]);
        $page->setMeta([
            'title' => 'Laravel Reference Application',
            'description' => 'Laravel Reference Application Created By Agin'
        ]);
        $page->save();
    }
}
