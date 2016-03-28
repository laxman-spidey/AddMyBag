<?php
class UserModel extends CI_Model {
    
    public $user_id;
    public $email;
    public $password;
    public $fb_id;
    public $gender;
    
    
    
    public function __construct()
    {
        $this->load->database();
        
    }
    
    public function insert()
    {
        echo 'in insert function';
        $data = array(
            
            'email'     => $this->email,
            'password'  => $this->password,
            'fb_id'     => $this->fb_id,
            'gender'    => $this->gender
        );
        
        $this->db->insert('user',$data);
        echo 'inserted';
    }
    public function insertUser($data)
    {
        $this->db->insert('user',$data);
        return $this->db->insert_id();
    }
    public function getUserIdIfExists($email)
    {
        $this->db->select('user_id')->from('user')->where('email',$email);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $userid = $query->result();
        }
        else 
        {
            $userid = -1;
        }
        return $userid;
    }
    public function authenticateAppUser($email,$password)
    {
        
    }
    
}

?>