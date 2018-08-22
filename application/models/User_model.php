<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function mail_exists($key)
    {

        $this->db->where('email',$key);
        $query = $this->db->get('fs_user');
        if ($query->num_rows() > 0){
            return true;
        }
        else return false;
    }

    public function pass_true($email, $pass_input)
    {

        $select_where = array('email =' => $email);
        $query = $this->db->select('
            id,email,name,password')
            ->from('fs_user')
            ->where($select_where); // cau query

        //var_dump($query->get_compiled_select('',false));//
        $info = $query->get()->row_array(); // ket qua

        //so sanh pass
        if (password_verify($pass_input,$info['password']) !== true) {
            return false;
        } else {
            return array(
                'id'        => $info['id'],
                'name'      => $info['name']
            );
        }
    }

    public function get_user_by_id($id)
    {
        $query = $this->db->select('
            name,mobile,address,dob,gender')
            ->from('fs_user')
            ->where('id =', $id); // cau query

        var_dump($query->get_compiled_select('',false));//
        $info = $query->get()->row_array(); // ket qua
        return $info;
    }
}