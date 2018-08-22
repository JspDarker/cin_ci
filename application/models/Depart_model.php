<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depart_model extends CI_Model
{
    public function get_menu()
    {
        $query = $this->db->select('
            d.id as depart_id,
            d.name as depart_name,
            fc.id as fc_id,
            fc.name as fc_name')
            ->from('fs_department d')
            ->join('fs_category fc', 'd.id=fc.department_id','left'); // cau query

        //var_dump($query->get_compiled_select('',false));//

        $menus = array();
        $results  = $query->get()->result_array(); // ket qua
        foreach ($results as $result) {
            $menus[$result['depart_name']][] = $result;
        }

        return $menus;
        //var_dump($menus);
    }
}