<?php 

class User_Model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');   
    }

    public function register(){
        $data = array(
            
            'customer_firstname' => $this->input->post('customer_firstname'),
            'customer_lastname'  => $this->input->post('customer_lastname'),
            'customer_email'      => $this->input->post('customer_email'),
            'customer_street' => $this->input->post('customer_street'),
            'customer_subdivision'  => $this->input->post('customer_subdivision'),
            'customer_barangay'      => $this->input->post('customer_barangay'),
            'customer_city' => $this->input->post('customer_city'),
            'customer_province'  => $this->input->post('customer_province'),

            'customer_password'   => md5($this->input->post('customer_password')),
            'verified_email' => 0,
            'active' => 0,
        );

        $insert = $this->db->insert('customer_tbl', $data);
        return $insert ? $this->db->insert_id(): false;
    }

    public function login($email, $password)
    {
        $this->db->where('customer_email', $email);
        $this->db->where('customer_password', $password);
        // $this->db->where('verified_email', 1);
        
        $result = $this->db->get('customer_tbl');
        if ($result->num_rows() == 1) {
            return $result->row_array(0);
        }
         else 
        {
            return false;
        }
    }
    
    public function update_account($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			 $update = $this->db->update('customer_tbl', $data);
             return $update = $this->db->affected_rows();
		}
    }
    
    public function vemail($data, $id, $Vcode)
	{
      
		if($data && $id) {
            $this->db->where('id', $id);
            $this->db->where('verification_code', $Vcode);
            
            $result = $this->db->get('customer_tbl');
            if ($result->num_rows() == 1) { 
                return $result->row_array(0);
            }
             else 
            {
                return false;
            }
		}
	}




    public function check_branch($user_id)
    {
        $this->db->where('user_id', $user_id);
    
        $result = $this->db->get('user_tbl');
        if ($result->num_rows() == 1) {
            return $result->row(0)->preferred_branch_id;
        }else{
            return false;
        }
    }
    public function update_data($user_branch){
        $branch_id = $user_branch['branch'];
        $this->session->set_userdata(array('pref_branch'=> $branch_id));
        $user = $this->session->userdata('user_id');
        $query = $this->db->query("UPDATE user_tbl SET preferred_branch_id = $branch_id WHERE user_id =  $user ");
        return $query;
    }
    public function getuserBranch(){
        $user = $this->session->userdata('user_id');
        $userbranch = $this->session->userdata('pref_branch');
        $query = $this->db->query("SELECT * FROM user_tbl WHERE user_id = $user AND preferred_branch_id = $userbranch ");
        return $query->result_array();
    }
    public function accountSetting($customer_id = ''){
          if($customer_id){
              $user = $customer_id;
          }
          else
          {
              $user = $this->session->userdata('customer_id');
          }
          $query = $this->db->query("SELECT * FROM customer_tbl WHERE id = $user");
          return $query->row_array();
    }
}
