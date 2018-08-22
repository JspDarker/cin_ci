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
    }

    public function get_newest() // https://stackoverflow.com/questions/23921117/disable-only-full-group-by
    {//TODO: fix error disable-only-full-group-by
        $select_where = array('f.active =' => 1, 'f.price >' => 10000000);
        $query = $this->db->select('
            f.`id`, f.name, f.price, f.`view`, fs_product_img.url,
            fs_product_img.alt, count(r.product_id) as `comment`, avg(r.point) as `point`
                ')
            ->from('fs_product f')
            ->join('fs_product_img', 'on f.id = fs_product_img.product_id')
            ->join('rating r ', 'on f.id = r.product_id','left')
            ->where($select_where)
            ->group_by('f.id')
            ->order_by('r.comment desc')
            ->limit(15); // cau query
        return  $query->get()->result_array(); // ket qua
    }

    public function cart_model($id)
    {   //$arr = array(23,36,78);

        //array_push($arr,$id);

        $carts = $this->session->cart; //$_SESSION['cart'] = $id
        /*$carts[$id] = 1;

        */
        if($carts) { // TODO: this
            $carts[$id] = $id;
            if(array_keys($carts) == $id) {
                $carts[$id]++;
            }
        }


        /*echo "<pre>";
        print_r($carts);
        echo "</pre>";*/
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
        //$ids = array_keys($carts);
        if(empty($ids)) {
            $ids = 0;
        }
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