<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RenameAndCreateNewColumnsInUsersTable extends AbstractMigration
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
        $this->execute('UPDATE users SET cpfcnpj=SUBSTRING(cpfcnpj, 1, 11)');
        $table->removeColumn('lojista')->save();
        $table->renameColumn('cpfcnpj', 'cpf');
        $table->changeColumn('cpf', 'string', ['limit' => 11])->save();
    }
}
