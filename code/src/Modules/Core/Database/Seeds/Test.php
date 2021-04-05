<?php

use Phinx\Seed\AbstractSeed;

class Test extends AbstractSeed
{
    public function run(): void 
    {
        if (\SlimExample\Acl\Infra\Cmd\Util::getCurrentEnv() !== 'testing'){
            return;
        }

        $dateNow = new \DateTime();
        $data = [
            [
                'test'   => '123',
                'created_at' => $dateNow->format('Y-m-d H:i:s'),
                'updated_at' => $dateNow->format('Y-m-d H:i:s')
            ],
            [
                'test'   => '456',
                'created_at' => $dateNow->format('Y-m-d H:i:s'),
                'updated_at' => $dateNow->format('Y-m-d H:i:s')
            ]
        ];

        $rows = $this->table('tests');
        $rows->insert($data)
              ->saveData();
    }
}
