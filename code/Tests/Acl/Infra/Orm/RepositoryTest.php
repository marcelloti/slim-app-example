<?php

namespace Tests\Acl\Infra\Orm;

use PHPUnit\Framework\TestCase;
use SlimExample\Acl\Infra\Orm\Repository;

use SlimExample\Modules\Core\Repositories\TestsRepository;

class RepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $testRepo = new TestsRepository();
        $results = $testRepo->findAll();

        $this->assertEquals(2, count($results));
        $this->assertEquals(1, $results[0]['id']);
        $this->assertEquals('123', $results[0]['test']);
        $this->assertEquals(2, $results[1]['id']);
        $this->assertEquals('456', $results[1]['test']);
    }

    public function testFindBy(): void
    {
        $testRepo = new TestsRepository();
        $findData = [
            ['test', '=', '123'],
        ];
        $results = $testRepo->findBy($findData);

        $this->assertEquals(1, count($results));
        $this->assertEquals(1, $results[0]['id']);
        $this->assertEquals('123', $results[0]['test']);
    }

    public function testInsert(): void
    {
        $testRepo = new TestsRepository();
        $dateNow = new \DateTime();
        
        $newData = [
            [
                'test'=> '789',
                'created_at' => $dateNow->format('Y-m-d H:i:s'),
                'updated_at' => $dateNow->format('Y-m-d H:i:s')
            ],
        ];
        $testRepo->insert($newData);

        $testRepo = new TestsRepository();
        $findData = [
            ['test', '=', '789'],
        ];
        $results = $testRepo->findBy($findData);

        $this->assertEquals(1, count($results));
        $this->assertEquals('789', $results[0]['test']);
    }

    public function testUpdate(): void {
        $testRepo = new TestsRepository();

        $filter = [
            ['test', '=', '789'],
        ];

        $newData = [
            'test' => '7890'
        ];

        $testRepo->update($filter, $newData);

        $findData = [
            ['test', '=', '7890'],
        ];
        $results = $testRepo->findBy($findData);

        $this->assertEquals(1, count($results));
        $this->assertEquals('7890', $results[0]['test']);
    }

    public function testDelete(): void
    {
        $testRepo = new TestsRepository();

        $dataToBeDeleted = [
            ['test', '=', '7890'],
        ];
        $testRepo->delete($dataToBeDeleted);

        $testRepo = new TestsRepository();
        $findData = [
            ['test', '=', '7890'],
        ];
        $results = $testRepo->findBy($findData);

        $this->assertEquals(0, count($results));
    }
}