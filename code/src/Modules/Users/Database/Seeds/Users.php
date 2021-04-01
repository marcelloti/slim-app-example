<?php


use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $dateNow = new \DateTime();
        $data = [
            [
                'nome'   => 'Lojista 1',
                'cpfcnpj'    => '62438462000142',
                'email'  => "lojista1@exampleapp.com",
                'senha'  => "123",
                'lojista' => true,
                'created_at' => $dateNow->format('Y-m-d H:i:s'),
                'updated_at' => $dateNow->format('Y-m-d H:i:s')
            ],
            [
                'nome'   => 'Lojista 2',
                'cpfcnpj'    => '76511906000132',
                'email'  => "lojista2@exampleapp.com",
                'senha'  => "123",
                'lojista' => true,
                'created_at' => $dateNow->format('Y-m-d H:i:s'),
                'updated_at' => $dateNow->format('Y-m-d H:i:s')
            ],
            [
                'nome'   => 'Usuário 1',
                'cpfcnpj'    => '41278829059',
                'email'  => "usuario1@exampleapp.com",
                'senha'  => "123",
                'lojista' => true,
                'created_at' => $dateNow->format('Y-m-d H:i:s'),
                'updated_at' => $dateNow->format('Y-m-d H:i:s')
            ],

            [
                'nome'   => 'Usuário 2',
                'cpfcnpj'    => '17730444003',
                'email'  => "usuario2@exampleapp.com",
                'senha'  => "123",
                'lojista' => true,
                'created_at' => $dateNow->format('Y-m-d H:i:s'),
                'updated_at' => $dateNow->format('Y-m-d H:i:s')
            ]
        ];

        $posts = $this->table('users');
        $posts->insert($data)
              ->saveData();
    }
}
