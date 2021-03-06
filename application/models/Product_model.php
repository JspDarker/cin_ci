<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function get_feature()
    {
        $select_where = array('f.active =' => 1, 'f.price >' => 20000000);
        $query = $this->db->select('
            f.`id`, f.name, f.price, f.`view`, img.url, img.alt')
            ->from('fs_product f')
            ->join('fs_product_img img', 'on f.id = img.product_id')
            ->where($select_where)->limit(10); // cau query

        //var_dump($query->get_compiled_select('',false));//
        return  $query->get()->result_array(); // ket qua

        //return $results;
        //var_dump($menus);
    }

    public function get_newest()
    {
        $select_where = array('f.active =' => 1, 'f.price >' => 10000000);
        $query = $this->db->select('
            f.`id`, f.name, f.price, f.`view`, img.url,
            img.alt, count(r.product_id) as `comment`, avg(r.point) as `point`
                ')
            ->from('fs_product f')
            ->join('fs_product_img img', 'on f.id = img.product_id')
            ->join('rating r ', 'on f.id = r.product_id','left')
            ->where($select_where)
            ->group_by('f.id')
            ->order_by('r.comment desc')
            ->limit(15); // cau query

        //var_dump($query->get_compiled_select('',false));//
        return  $query->get()->result_array(); // ket qua

        //return $results;
        //var_dump($menus);
    }
}