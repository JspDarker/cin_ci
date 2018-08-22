<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }

    public function index()
    {
        //$this->load->model('product_model');
        $product_ft = $this->product_model->get_feature();
        $product_newest = $this->product_model->get_newest();

        $this->render('home',array(
            'product_ft'        => $product_ft,
            'product_newest'    => $product_newest
        ));
    }

    public function carts($id)
    {
        $product = $this->product_model->cart_model($id);

        $this->render('cart',array('product' => $product));
    }

}