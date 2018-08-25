<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends My_Controller
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
        if($this->session->has_userdata('user_id')) {
            redirect('users/update');
        }
        $this->form_validation->set_rules('pass','pass','required|regex_match[/(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&]).{8,}/]');
        $this->form_validation->set_rules('name','name','required|regex_match[/^([a-z ])+$/i]|trim|min_length[5]');
        $this->form_validation->set_rules('pass_confirm','Pass confirm','required|matches[pass]');
        $this->form_validation->set_rules('email','email','required|valid_email|is_unique[fs_user.email]');

        $res_insert = false;
        if ($this->form_validation->run() !== false) {
            $email  = $this->input->post('email'); // loc xss $this->input->post('email', true)
            $pass   = $this->input->post('pass');
            $name   = $this->input->post('name');
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
        if($this->session->userdata('user_id')) {
            redirect('home');
        }
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
        if( ! $this->session->has_userdata('user_id')) {
            redirect('users/login');
        }
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        $this->load->library('cart');
        $this->cart->destroy();
        redirect('home');
    }

    public function update()
    {
        if( ! $this->session->has_userdata('user_id')) {
            redirect('users/login');
        }
        $id_user = (int)$this->session->userdata('user_id');
        if($this->input->post('name')!==NULL) {
            $this->form_validation->set_rules('name','name','required|regex_match[/^([a-z ])+$/i]|trim|min_length[2]');
            $this->form_validation->set_rules('address', 'address', 'required|min_length[2]|trim');
            $this->form_validation->set_rules('phone', 'phone', 'required|integer|min_length[1]|max_length[11]');
            $this->form_validation->set_rules('avatar', 'Avatar', 'callback_avatar_check');
            if ($this->form_validation->run() !== false) {
                $name=$this->input->post('name'); // loc xss $this->input->post('email', true)
                $address =$this->input->post('address');
                $phone =$this->input->post('phone');
                $gender =$this->input->post('gender');
                $dob =$this->input->post('dob');
                //$this->load->library('upload');
                $avatars = $this->upload->data(); // array

                $array = array(
                    'name'          => $name,
                    'mobile'        => $phone,
                    'address'       => $address,
                    'dob'           => $dob,
                    'path_avatar'   => $avatars['file_name'],
                    'gender'        => $gender
                );
                $this->user_model->update_avatar($id_user, $array);
                //unlink('public/images/avatar/' . $this->session->avt);
                unset($_SESSION['avt']);
            } else { // validate fail
                // xoa file da upload
                echo "error upload file"; //
                $avatars = $this->upload->data();
                if ($avatars['file_name']) unlink('public/images/avatar/' . $avatars['file_name']);
                $this->render('u_update',array(
                    //'user' => $render_info_user
                ));
            }
        }
        else {
            $render_info_user = $this->user_model->get_user_by_id($id_user);
            $this->session->set_userdata('avt', $render_info_user['path_avatar']);
            $this->render('u_update', array(
                'user' => $render_info_user
            ));
        }

    }

    public function avatar_check(){
        //File upload
        $config['upload_path']          = './public/images/avatar';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('avatar'))
        {
            $this->form_validation->set_message('avatar_check',$this->upload->display_errors(''));
            return false;
        } else return true;
    }



}