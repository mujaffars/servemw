<?php
class Migration_Add_access_functionality extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE,
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => FALSE,
                )
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('access_functionality');

        // Add default access functionality list
        $this->db->insert_batch('access_functionality', DEFAULT_ACCESS_FUNCTIONALITY_LIST);
    }

    public function down()
    {
        $this->dbforge->drop_table('access_functionality');
    }
}
