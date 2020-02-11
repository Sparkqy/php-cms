<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
            [
                'email' => 'admin@admin.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'role' => 'admin',
            ],
            [
                'email' => 'user@user.com',
                'password' => password_hash('user', PASSWORD_DEFAULT),
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->saveData();
    }
}
