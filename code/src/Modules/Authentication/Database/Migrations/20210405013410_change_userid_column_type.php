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
        echo PHP_EOL."\e[0;30;41mERRO: Voce nao pode desfazer a migration ChangeUseridColumnType!\e[0m".PHP_EOL.''.PHP_EOL;
        die();
    }
}
