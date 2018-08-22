<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing_model extends CI_Model
{
    public function get_feature()
    {
        $select_where = array('f.active =' => 1, 'f.price >' => 20000000);
        $query = $this->db->select('
            f.`id`, f.name, f.price, f.`view`, img.url, img.alt')
            ->from('fs_product f')
            ->join('fs_product_img img', 'on f.id = img.product_id')
            ->where($select_where)->limit(10); // cau query

        var_dump($query->get_compiled_select('',false));//
        return  $query->get()->result_array(); // ket qua

        //return $results;
        //var_dump($menus);
    }

    public function get_product_by_cate($id, $limit, $sort,$page)
    {
        $pos = ($page -1) * $limit;
        $order = "fs_product.view DESC";
        switch ($sort) {
            case 1:
                $order = "fs_product.name DESC";
                break;
            case 2:
                $order = "fs_product.price DESC";
                break;
            case 3:
                $order = "fs_product.name";
                break;
            case 4:
                $order = "fs_product.price";
                break;
        }
        $query = $this->db->select('
            fs_product.name AS pro_name,fs_product.id AS pro_id,
            fs_product.price AS pro_price,fs_product_img.url AS urlHinh,
            fs_product_img.alt AS img_alt,fs_product.view as `views`,
            count(r.product_id) as `comment`, avg(r.point) as `point`
                ')
            ->from('fs_product')
            ->join('fs_product_img', 'fs_product.id=fs_product_img.product_id')
            ->join('rating r ', 'on fs_product.id = r.product_id','left')
            ->where('fs_product.category_id =', $id)
            ->group_by('fs_product.id')
            ->order_by($order)
            ->limit($limit,$pos); // cau query

        /*echo "<pre>";
        print_r($query->get_compiled_select('',false));
        echo "</pre>";*/

        return $query->get()->result_array(); // ket qua
    }

    public function count_rows($id)
    {
        $select_where = array('fs_product.active =' => 1, 'fs_product.category_id =' => $id);
        $query = $this->db->select('count(1) as `total`')
            ->from('fs_product')
            ->where($select_where); // cau query

        //var_dump($query->get_compiled_select('',false));//
        $res = $query->get()->row_array(); // ket qua
        return $res['total'];
    }
}