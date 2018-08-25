<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('cart_model');
        $this->load->helper('form');

    }

    public function show()
    {
        $this->render('cart');
//        $this->load->view('test_cart');
    }
    public function add($id)
    {
        $product = $this->cart_model->get_product($id);
        $data = array(
            'id'    => $product['id'],
            'qty'   => 1,
            'name'  => preg_replace('/\(?\)?/','',$product['name']),
            'price' => $product['price'],
            'url'   => $product['url'],
            'alt'   => $product['alt']
        );
        $this->cart->insert($data);
        redirect('cart/show');
    }

    public function update()
    {
        $data = $this->input->post();
        $this->cart->update($data);
        redirect('cart/show');
    }

    public function checkout()
    {
        $carts = $this->cart->contents();
        if(empty($carts)) {
            redirect('home');
        }
        if($this->input->post('name')!==NULL) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','name','required|regex_match[/^([a-z ])+$/i]|trim|min_length[5]');
            $this->form_validation->set_rules('email','email','required|required|valid_email');
            $this->form_validation->set_rules('address', 'address', 'required|min_length[6]|trim');
            $this->form_validation->set_rules('phone', 'phone', 'required|integer|min_length[10]|max_length[11]');
            if($this->form_validation->run() === false) {
                $this->render('checkout');
            } else {
                // insert to table orders
                $datas = $this->input->post();

                $d = new date('d-m-Y  H:i:s');
                $orders = array(
                    'user_id' => (int)$this->session->userdata('user_id'),
                    'name' => $datas['name'],
                    'address' => $datas['address'],
                    'ship_at' => date('d-m-Y  H:i:s ', strtotime($d. ' + 2 days')),
                    'email' => $datas['email'],
                    'mobile' => $datas['phone'],
                    'remark' => $datas['remark']
                );
                $this->db->trans_start();
                    $this->db->insert('fs_order', $orders);
                    $id_order_last = $this->db->insert_id();
                    foreach ($carts as $cart) {
                        $detail = array(
                            'order_id' => $id_order_last,
                            'product_id' => $cart['id'],
                            'qty' => $cart['qty'],
                            'price' => $cart['price']
                        );
                        $this->db->insert('fs_order_detail', $detail);
                    }
                $this->db->trans_complete();
                $this->cart->destroy();
                redirect('show_order');
            }
        } else {
            $id_user = (int)$this->session->userdata('user_id');
            $this->load->model('user_model');
            $render_info_user = $this->user_model->get_user_by_id($id_user);
            $this->render('checkout', array('user' => $render_info_user));
        }
    }

    public function show_order( $user_id =1) // show tat ca don hang
    {
        $this->render('user_order');
    }

    public function test()
    {
        $data = $this->cart->contents();

        $i = 1;
        foreach ($data as $items)
        {
            if ($this->input->post($i.'[qty]') < 0) {
                $items['qty'] = 1;
            }
            else {
                $items['qty'] = $this->input->post($i.'[qty]');
            }
            $update = array(
                "rowid" => $items['rowid'],
                "qty" => $items['qty'],
                'id' => $items['id'],
                'price' => $items['price'],
                'name' => $items['name'],
                'url' => $items['url']
            );
            $this->cart->update($update);
            $i++;
        }
        redirect('product/cart');
    }

}