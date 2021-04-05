<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTransactionIdTrigger extends AbstractMigration
{
    public function up(): void
    {
        if (\SlimExample\Acl\Infra\Cmd\Util::getCurrentEnv() === 'testing'){
            return;
        }

        $this->execute('
        CREATE TRIGGER insert_uuid_transactions
        BEFORE INSERT ON transactions
        FOR EACH  ROW 
        BEGIN 
            SET NEW.id = UUID(); 
        END;');
    }

    public function down(): void
    {
        if (\SlimExample\Acl\Infra\Cmd\Util::getCurrentEnv() === 'testing'){
            return;
        }

        $this->execute('DROP TRIGGER insert_uuid_transactions');
    }
}
