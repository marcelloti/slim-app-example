<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RenameUsersColumnsTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('users');
        $table->renameColumn('cpf', 'cpfcnpj')->update();
        $table->changeColumn('cpfcnpj', 'string', ['limit' => 14])->update();
        $table->addColumn('lojista', 'boolean')->update();
    }

    public function down(): void
    {
        $table = $this->table('users');
        $table->removeColumn('lojista')->save();
        $table->renameColumn('cpfcnpj', 'cpf')->update();
        $table->changeColumn('cpf', 'string', ['limit' => 11])->update();
    }
}
