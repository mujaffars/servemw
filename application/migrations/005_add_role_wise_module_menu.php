<?php
class Migration_Add_role_wise_module_menu extends CI_Migration
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
                'role_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
                'module_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                ),
                'menu_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                )
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (role_id) REFERENCES role_master(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (module_id) REFERENCES modules(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (menu_id) REFERENCES menus(id)');
        $this->dbforge->create_table('role_wise_module_menu');

        // Add default role wise module menu list
        $this->db->insert_batch('role_wise_module_menu', DEFAULT_ROLE_WISE_MODULE_MENU_LIST);
    }

    public function down()
    {
        $this->dbforge->drop_table('role_wise_module_menu');
    }
}
