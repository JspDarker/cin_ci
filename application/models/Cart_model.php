<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    public function get_product($id)
    {
        $query = $this->db->select('
            f.`id`, f.name, f.price, img.url, img.alt')
            ->from('fs_product f')
            ->join('fs_product_img img', 'on f.id = img.product_id')
            ->where('f.id =',$id); // cau query
        //var_dump($query->get_compiled_select('',false));//
        return  $query->get()->row_array(); // ket qua
    }

    public function get_order_full_of_user($id)
    {
        $query = $this->db->select('
            d.id as depart_id,
            d.name as depart_name,
            fc.id as fc_id,
            fc.name as fc_name')
            ->from('fs_user u')
            ->join('fs_category fc', 'd.id=fc.department_id','left'); // cau query
        //var_dump($query->get_compiled_select('',false));//
        $menus = array();
        $results  = $query->get()->result_array(); // ket qua
        foreach ($results as $result) {
            $menus[$result['depart_name']][] = $result;
        }
        return $menus;
    }

}