<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('user_model','user');
		$this->load->helper('form');
	}
	public function login()
	{
		if($this->session->id)
			redirect ('front/index');
		else
		{
			$data=array();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('captcha','CAPTCHA','callback_check_captcha');
		       if($this->form_validation->run()!=FALSE){
					$rs=$this->user->login($this->input->post());
					if($rs['error']==0)
					{
						$this->session->set_userdata('id',$rs['id']);
						$this->session->set_userdata('name',$rs['name']);
						$this->load->library('user_agent');
						redirect($this->agent->referrer());
					}
					$data=array('result'=>$rs);
				}
				$this->render('login', $data);
			}
	}
	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('name');
		redirect('user/login');
	}
	public function register()
	{
	    if($this->input->post('name')!==NULL) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('repass', 'Password Confirmation', 'required|matches[pass]');
            $this->form_validation->set_rules('avatar', 'Avatar', 'callback_avatar_check');
            if ($this->form_validation->run() == FALSE) {
                $this->render('register');
                //Xoa file da upload
                $avatar = $this->upload->data();
                if ($avatar['file_name']) unlink('public/images/avatar/' . $avatar['file_name']);
            } else {
                $data = $this->input->post();
                $avatar = $this->upload->data();
                $user = array(
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => sha1($data['pass']),
                    'avatar' => $avatar['file_name'],
                    'mobile' => $data['mobile'],
                );
                $this->user->register($user);
                $this->render('message', ['message' => 'Đăng ký tài khoản thành công', 'url' => site_url('front/index'), 'second' => 5]);
            }
        }
        else {
            $this->render('register');
        }
	}
	public function reset_password()
	{
	    
	}

	public function account()
    {
        if($this->session->id)
        {
            $user = $this->user->get_detail($this->session->id);
            $this->load->model('order_model','order');
            $order = $this->order->get_by_user($this->session->id);
            $this->render('account',['user'=>$user,'order'=>$order]);

        } else {
            redirect('user/login');
        }
    }

	public function update()
	{
		$items=array();
		
		
		
		$this->cart->update($items);
		$this->index();
	}
	
	public function check_captcha($value)
	{
	    if($value!=$this->session->flashdata('captcha')){
	        $this->form_validation->set_message('check_captcha', 'Ảnh bảo mật nhập không đúng !');
	        return FALSE;
	    }
	    else {
	        return TRUE;
	    }
	}

	public function create_captcha()
    {
        $this->output->enable_profiler(FALSE);
        $this->load->helper('captcha');
        $vals = array(
            'img_path'      => './public/images/captcha/',
            'img_url'       => base_url().'captcha/',
            'word_length'   => 4,
            'img_width'     => 80,
            'img_height'    => 30,
            'vertical-align'=> 'center',
            'font_size'     => 16,
            'expiration'    => 5,
            'img_id'        => 'img_captcha',
            'pool'			=>'QWERTYUIOPASDFGHJKLZXCVBNM1234567890',
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );

        $cap = create_captcha($vals);
        $this->session->set_flashdata('captcha',$cap['word']);
        echo 'public/images/captcha/'.$cap['filename'];
    }

    public function avatar_check(){
        //File upload
        $config['upload_path']          = './public/images/avatar/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('avatar'))
        {
            $this->form_validation->set_message('avatar_check',$this->upload->display_errors(''));
            return false;
        }
        else
        {
            return true;
        }

    }
}
