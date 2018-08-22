<?php
defined('BASEPATH') OR exit('No direct script access allowed'); // chong truy cap truc tien


class MY_Controller extends CI_Controller // TODO: fix error not found MY_controller
{ //https://stackoverflow.com/questions/21351808/codeigniter-extending-controller-controller-not-found/38035538
    /*public function __construct()
    {
        parent::__construct();
    }*/

    public function render($view, $data = array())
    {
        //$menu = 1;
        $this->load->model('depart_model');
        $menus = $this->depart_model->get_menu();

        $this->load->view('includes/header', array('menus' => $menus));
        $this->load->view($view, $data);
        $this->load->view('includes/footer', array('menus' => $menus));
    }
}