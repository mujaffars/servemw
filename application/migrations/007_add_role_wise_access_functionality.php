<?php
class Migration_Add_role_wise_access_functionality extends CI_Migration
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
                'role_wise_module_menu_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
                'access_functionality_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                )
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (role_wise_module_menu_id) REFERENCES role_wise_module_menu(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (access_functionality_id) REFERENCES access_functionality(id)');
        $this->dbforge->create_table('role_wise_access_functionality');

        // Add default role wise access functionality list
        $this->db->insert_batch('role_wise_access_functionality', DEFAULT_ROLE_WISE_ACCESS_FUNCTIONALITY_LIST);
    }

    public function down()
    {
        $this->dbforge->drop_table('role_wise_access_functionality');
    }
}
