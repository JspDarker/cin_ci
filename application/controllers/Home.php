<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  product_model
 */
class Home extends My_Controller
{


    //private $product_model;

    public function index()
    {
        $this->load->model('product_model');
        $product_ft = $this->product_model->get_feature();
        $product_newest = $this->product_model->get_newest();

        $this->render('home',array(
            'product_ft'        => $product_ft,
            'product_newest'    => $product_newest
        ));
    }

}