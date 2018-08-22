<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends MY_Controller
{


    public function h()
    {
        
    }
    
    public function lists($id,$sort=0, $page = 1)
    {
        $this->load->model('listing_model');

        $limit = 20;
        $id = (int)$id;

        $listings = $this->listing_model->get_product_by_cate($id, $limit, $sort,$page);
        $rows = $this->listing_model->count_rows($id);

        $total_page = ceil($rows/$limit);

        $this->render('listing',array(
            'listings'        => $listings,
            //'rows'    => $rows,
            'total_page'  => $total_page,
            'ca' => $id,
            'sort' =>$sort,
            'page' =>$page
        ));
    }

}