<?php
class Migration_Add_modules extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                    'auto_increment' => true
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => FALSE,
                ),
                'status' => array(
                    'type' => 'ENUM("active","inactive")',
                    'null' => FALSE,
                ),
                'access_type' => array(
                    'type' => 'ENUM("free","partial paid","paid")',
                    'null' => FALSE,
                )
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('modules');

        // Add default module list
        $this->db->insert_batch('modules', DEFAULT_MODULE_LIST);
    }

    public function down()
    {
        $this->dbforge->drop_table('modules');
    }
}
