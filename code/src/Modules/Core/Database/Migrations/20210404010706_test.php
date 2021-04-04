<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use SlimExample\Acl\Infra\DotEnv\DotEnvLib;

final class Test extends AbstractMigration
{
    public function up(): void
    {
        if (\SlimExample\Acl\Infra\Cmd\Util::getCurrentEnv() !== 'testing'){
            return;
        }

        $table = $this->table('tests');
        $table->addColumn('test', 'string')
        ->addColumn('created_at', 'datetime')
        ->addColumn('updated_at', 'datetime')
        ->create();
    }

    public function down(): void
    {
        if (\SlimExample\Acl\Infra\Cmd\Util::getCurrentEnv() !== 'testing'){
            return;
        }

        $this->table('tests')->drop()->save();
    }
}
