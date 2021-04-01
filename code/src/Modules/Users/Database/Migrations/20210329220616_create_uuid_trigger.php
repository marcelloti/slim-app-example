<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUUIDTrigger extends AbstractMigration
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
        $this->execute('
        CREATE TRIGGER insert_uuid
        BEFORE INSERT ON users
        FOR EACH  ROW 
        BEGIN 
            SET NEW.id = UUID(); 
        END;');
    }

    public function down(): void
    {
        $this->execute('DROP TRIGGER insert_uuid');
    }
}
