<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('carts_model');
    }

    public function carts()
    {
        //$_SESSION['cart'] =

        if (empty($ids)) {
            $ids = 0;
        }
        $product = $this->carts_model->get_all($ids); //1 row
        $this->render('cart',array(
            'product'        => $product
        ));
    }

    public function add($id)
    {

        $this->render('cart',array('id' =>$id));







//        //$carts[$id] = 1;
//
//        if($this->input->post('qty')) {
//            $carts[$id] += $this->input->post('qty');
//        } else $carts[$id]++;
        //redirect('shopping/carts');
    }

}