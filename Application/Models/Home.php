<?php

use MVC\Model;

class ModelsHome extends Model {

    public function getAllUser() {
        // can you connect to database
        $query = $this->db->query("SELECT * FROM users");
		return $query->rows;

        // return [ 
        //     'name'      => 'Mohammad',
        //     'family'    => 'Rahmani',
        //     'age'       => 21,
        //     'country'   => 'Afghanistan',
        //     'city'      => 'Herat'
        // ];
    }
}
