<?php
class Migration_Add_menus extends CI_Migration
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
                'master_menu' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'null' => TRUE,
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => FALSE,
                ),
                'translate' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                ),
                'display_type' => array(
                    'type' => 'ENUM("item","collapsable","hidden")',
                    'null' => FALSE,
                ),
                'icon' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                    'null' => TRUE,
                ),
                'url' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '120',
                    'null' => TRUE,
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
        //$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (master_menu) REFERENCES menus(id)');
        $this->dbforge->create_table('menus');

        // Add default menu list
        $this->db->insert_batch('menus', DEFAULT_MENU_LIST);
    }

    public function down()
    {
        $this->dbforge->drop_table('menus');
    }
}
