<?php
class Migration_Add_module_wise_menu extends CI_Migration
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
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (module_id) REFERENCES modules(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (menu_id) REFERENCES menus(id)');
        $this->dbforge->create_table('module_wise_menu');

        // Add default module wise menu list
        $this->db->insert_batch('module_wise_menu', DEFAULT_MODULE_WISE_MENU_LIST);
    }

    public function down()
    {
        $this->dbforge->drop_table('module_wise_menu');
    }
}
