<?php


use Phinx\Seed\AbstractSeed;

class PageSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            ['title' => 'Page #1', 'content' => 'Content of the Page #1'],
            ['title' => 'Page #2', 'content' => 'Content of the Page #2'],
        ];

        $table = $this->table('pages');
        $table->insert($data)->saveData();
    }
}
