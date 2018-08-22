<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo_view extends CI_Controller {

    public function index($name = "Nhat Thanh Home")
    {

        // bat profiler
        $this->output->enable_profiler(true);

        echo "this is hello world <hr>";
        //$this->load->view('welcome_message');
        //$this->load->helper('url');

        // load model
        $this->load->model('depart_model'); // name of file in model

        // get result
        $res = $this->depart_model->get_menu();

        //$menu = $res->result_array();
        $this->load->view('test_view/test_view', array('name'=> $name,'menu' => $res));

        echo base_url();
    }
}
