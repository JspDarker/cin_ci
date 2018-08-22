<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
    }

    public function register()
    {
        $this->form_validation->set_rules('pass','pass','required|regex_match[/(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&]).{8,}/]');
        $this->form_validation->set_rules('name','name','required|regex_match[/^([a-z ])+$/i]|trim|min_length[5]');
        $this->form_validation->set_rules('pass_confirm','Pass confirm','required|matches[pass]');
        $this->form_validation->set_rules('email','email','required|valid_email|is_unique[fs_user.email]');

        $res_insert = false;
        if ($this->form_validation->run() !== false) {
            $email  =$this->input->post('email'); // loc xss $this->input->post('email', true)
            $pass   =$this->input->post('pass');
            $name   =$this->input->post('name');
            $data = array(
                'name' => $name,
                'email' => $email,
                'password' => password_hash($pass,PASSWORD_DEFAULT)
            );
            $res = $this->db->insert('fs_user',$data);

            if($res == true) {
                $res_insert = $res;
                $this->render('register',array('res_register' => $res_insert));
            }

        } elseif ($res_insert == false){
            $this->render('register');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('pass','Your Pass','required|callback_check_pass_exists');
        $this->form_validation->set_rules('email','email','required|valid_email|callback_check_mail_exists');
        if ($this->form_validation->run() !== false) {
            $email =$this->input->post('email'); // loc xss $this->input->post('email', true)
            $pass =$this->input->post('pass');
            $user_valid= $this->user_model->pass_true($email,$pass);

            // create session save info user
            $this->session->set_userdata('user_id', $user_valid['id']);
            $this->session->set_userdata('user_name', $user_valid['name']);
            redirect('home');
        }
        // echo validation_error() // flashdata session truyen xong xoa luon
        $this->render('login');
    }

    public function check_mail_exists()
    {
        $email =$this->input->post('email');

        $res_email= $this->user_model->mail_exists($email);
        if ($res_email == false) {
            $this->form_validation->set_message('check_mail_exists', 'The {field} not exist in db');
            return false;
        } else return true;
    }

    public function check_pass_exists()
    {
        $pass =$this->input->post('pass');
        $email =$this->input->post('email');

        $res_pass= $this->user_model->pass_true($email,$pass);
        if ($res_pass == false) {
            $this->form_validation->set_message('check_pass_exists', 'The {field} wrong !');
            return false;
        } else return true;
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        redirect('home');
    }

    public function update()
    {
        $id_user = (int)$this->session->userdata('user_id');
        if($this->input->post('name')!==NULL) {

        } else {

            $render_info_user = $this->user_model->get_user_by_id($id_user);
            echo "<pre>";
            print_r($render_info_user);
            echo "</pre>";
            print_r($id_user);
            $this->render('u_update',array(
                'user' => $render_info_user
            ));
        }

    }



}