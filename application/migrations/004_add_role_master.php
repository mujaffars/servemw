<?php
class Migration_Add_role_master extends CI_Migration
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
                'role' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => FALSE,
                ),
                // 'created_by' => array(
                //     'type' => 'INT',
                //     'constraint' => 5,
                //     'unsigned' => TRUE,
                // ),
                // 'added_date' => array(
                //     'type' => 'datetime',
                // ),
                // 'updated_date' => array(
                //     'type' => 'datetime',
                //     'on update' => 'NOW()',
                // ),
                'module_wise' => array(
                    'type' => 'boolean',
                )
            )
        );

        $this->dbforge->add_key('id', TRUE);
        //$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (created_by) REFERENCES user_master(user_id)');
        $this->dbforge->create_table('role_master');

        // Add default role master list
        $this->db->insert_batch('role_master', DEFAULT_ROLE_MASTER_LIST);
    }

    public function down()
    {
        $this->dbforge->drop_table('role_master');
    }
}
