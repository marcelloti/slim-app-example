<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $table = $this->table('users', ['id' => false, 'primary_key' => 'id'])
        ->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('nome', 'string', ["limit" => 255])
        ->addColumn('cpf', 'string', ["limit" => 11])
        ->addColumn('email', 'string', ["limit" => 255])
        ->addColumn('senha', 'string', ["limit" => 255])
        ->addColumn('created_at', 'datetime')
        ->addColumn('updated_at', 'datetime')
        ->addIndex(['id'], ['unique' => true])
        ->addIndex(['cpf'], ['unique' => true])
        ->addIndex(['email'], ['unique' => true])
        ->create();
    }

    public function down(): void
    {
        $this->table('users')->drop()->save();
    }
}
