<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTransactionsTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('transactions', ['id' => false, 'primary_key' => 'id'])
        ->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false,
        ])
        ->addColumn('value', 'string', ["limit" => 255])
        ->addColumn('payer', 'string', ["limit" => 255])
        ->addColumn('payee', 'string', ["limit" => 255])
        ->addColumn('created_at', 'datetime')
        ->addColumn('updated_at', 'datetime')
        ->create();
    }

    public function down(): void {
        $this->table('transactions')->drop()->save();
    }
}
