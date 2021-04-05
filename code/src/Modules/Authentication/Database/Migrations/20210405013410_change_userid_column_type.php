<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ChangeUseridColumnType extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('auth_tokens');
        $table->changeColumn('userid', 'string', ['limit' => 255])->update();
    }

    public function down(): void
    {
        $table = $this->table('auth_tokens');
        $table->changeColumn('userid', 'integer')->update();
    }
}
