<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateAuthTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('auth_tokens', ['id' => false])
        ->addColumn('userid', 'integer')
        ->addColumn('token', 'string', ["limit" => 255])
        ->addColumn('secret', 'string', ["limit" => 255])
        ->addColumn('created_at', 'datetime')
        ->addColumn('updated_at', 'datetime')
        ->addIndex(['userid'], ['unique' => true])
        ->create();
    }

    public function down(): void
    {
        $this->table('auth_tokens')->drop()->save();
    }
}
