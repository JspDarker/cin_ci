<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts_model extends CI_Model
{


    public function get_all($ids)
    {





//        if(empty($ids)) {
//            $ids = 0;
//        }
        $query = $this->db->select('
            f.`id` as pro_id, f.name as pro_name, f.price as pro_price,
            fs_product_img.url as pro_img,
            fs_product_img.alt as pro_alt
                ')
            ->from('fs_product f')
            ->join('fs_product_img','on f.id = fs_product_img.product_id')
            ->where_in('f.id', $ids);
        return  $query->get()->result_array(); // ket qua
    }
}