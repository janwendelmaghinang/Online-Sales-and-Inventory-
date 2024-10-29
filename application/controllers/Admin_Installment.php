<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Installment extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->Model('Admin_Spareparts_Model');
        $this->load->Model('Admin_Customer_Model');
        $this->load->Model('Admin_Color_Model');
        $this->load->Model('Admin_Model_Model');
        $this->load->Model('Admin_Company_Model');
        $this->load->Model('Admin_Pos_Model');
        $this->load->Model('Admin_Installment_Model');
        date_default_timezone_set("Asia/Bangkok");
    }
    public function index()
	{
        $data['pending'] = count($this->Admin_Installment_Model->getInstallmentData(1));
        $data['approved'] = count($this->Admin_Installment_Model->getInstallmentData(2));
        $data['released'] = count($this->Admin_Installment_Model->getInstallmentData(3));
        $data['disapproved'] = count($this->Admin_Installment_Model->getInstallmentData(4));
        $data['cancelled'] = count($this->Admin_Installment_Model->getInstallmentCancelled());
        $data['colors'] = $this->Admin_Color_Model->getColorData();
        $data['models'] = $this->Admin_Model_Model->getModelData();
		$data['customers'] = $this->Admin_Customer_Model->getCustomerData();
		$data['pages'] = 'installment/index';
		$this->load->view('admin/layout/templates',$data); 
    }
    
    public function application(){
        $ebike_id = $this->input->post('ebike_id');
        $color_id = $this->input->post('color_id'); 

        $color = $this->Admin_Color_Model->getColorData($color_id);
        $ebike_name = $this->Admin_Model_Model->getModelData($ebike_id);

        if($this->input->post('truecase') == 1 ){
            $this->form_validation->set_rules('customer_select_id', 'customer', 'trim|required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
            
                if($this->form_validation->run() == true){
                    $random = round(microtime(true) * 1000);
                    $target_directory = "uploads/applicationForm/"."form".$random.'.png';
                    move_uploaded_file($_FILES['application_form']['tmp_name'],"uploads/applicationForm/"."form".$random.'.png');

                    $target_directory1 = "uploads/pob/"."pob".$random.'.png';
                    move_uploaded_file($_FILES['pob']['tmp_name'],"uploads/pob/"."pob".$random.'.png');
                    $info = array(
                        // 'ref_no' => mt_rand(1,999999),
                        'color_id' => $color_id,
                        'ebike_id' => $ebike_id,
                        'ebike_name' => $ebike_name['name'],
                        'price' => $ebike_name['price'],
                        'ebike_color' => $color['color_name'],
                        'customer_id' => $this->input->post('customer_select_id'),
                        'application_form' => $target_directory,
                        'pob' => $target_directory1,
                        'status' => 1,
                        'date_apply' => date('M d, Y')
                    );

                    $insert = $this->Admin_Installment_Model->insertApplication($info);
                    
                    if($insert){
                       redirect(base_url('Admin_Installment'));
                       $this->session->set_flashdata('messages','Submitted');
                    }
                    else 
                    {
                       
                    }
                }
                else 
                {

                }

        }

        if($this->input->post('truecase') == 2 ){

            $this->form_validation->set_rules('customer_firstname', 'firstname', 'trim|required');
            $this->form_validation->set_rules('customer_lastname', 'lastname', 'trim|required');
            $this->form_validation->set_rules('customer_middle', 'middle', 'trim|required');
            $this->form_validation->set_rules('customer_contact', 'contact', 'trim|required');
            $this->form_validation->set_rules('customer_street', 'street', 'trim|required');
            $this->form_validation->set_rules('customer_barangay', 'barangay', 'trim|required');
            $this->form_validation->set_rules('customer_city', 'city', 'trim|required');
            $this->form_validation->set_rules('customer_province', 'province', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
  
            if($this->form_validation->run() == true){
                $random = round(microtime(true) * 1000);

                $target_directory = "uploads/validID/"."id".$random.'.png';
                move_uploaded_file($_FILES['customer_valid_id']['tmp_name'],$target_directory);

                $data = array(
                    'customer_firstname' => $this->input->post('customer_firstname'),
                    'customer_lastname' => $this->input->post('customer_lastname'),
                    'customer_middle' => $this->input->post('customer_middle'),
                    'customer_contact' => $this->input->post('customer_contact'),
                    'customer_email' => $this->input->post('customer_email'),
                    'customer_street' => $this->input->post('customer_street'),
                    'customer_subdivision' => $this->input->post('customer_subdivision'),
                    'customer_barangay' => $this->input->post('customer_barangay'),
                    'customer_city' => $this->input->post('customer_city'),
                    'customer_province' => $this->input->post('customer_province'),
                    'idType' => $this->input->post('idList'),
                    'customer_valid_id' => $target_directory,
                    'active' => 1
                );

                $customer_id = $this->Admin_Customer_Model->insertCustomerData($data);
                if($customer_id){
                  
                    $random = round(microtime(true) * 1000);
                    $target_directory = "uploads/applicationForm/"."form".$random.'.png';
                    move_uploaded_file($_FILES['application_form']['tmp_name'],"uploads/applicationForm/"."form".$random.'.png');

                    $target_directory1 = "uploads/pob/"."pob".$random.'.png';
                    move_uploaded_file($_FILES['pob']['tmp_name'],"uploads/pob/"."pob".$random.'.png');
                    $info = array(
                        // 'ref_no' => mt_rand(1,999999),
                        'color_id' => $color_id,
                        'ebike_id' => $ebike_id,
                        'ebike_name' => $ebike_name['name'],
                        'ebike_color' => $color['color_name'],
                        'customer_id' => $customer_id,
                        'application_form' => $target_directory,
                        'pob' => $target_directory1,
                        'status' => 1,
                        'date_apply' => date('M d, Y')
                    );

                    $insert = $this->Admin_Installment_Model->insertApplication($info);
                    
                    if($insert){
                        redirect(base_url('Admin_Installment'));
                        $this->session->set_flashdata('messages','Submitted');
                    }
                    else 
                    {
                       
                    }
                }

            }
        }
    }

    public function fetchInstallment(){
        $result = array('data' => array());

        $loan = $this->Admin_Installment_Model->getInstallmentData(1);
      
        foreach($loan as $key=>$value){
            
         $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);

         $buttons = '';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="approved('.$value['id'].')" data-toggle="modal" data-target="#approvedModal">Approved</button>';	
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="disapproved('.$value['id'].')" data-toggle="modal" data-target="#disapprovedModal">Disapproved</button>';
            // $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
   
        $result['data'][$key] = array(
            $value['id'],
            $value['ebike_name'],
            $value['ebike_color'],
            $customer['customer_firstname'].' '.$customer['customer_lastname'] ,
            '<span class="badge badge-success">pending</span>',
            $buttons,
            );
        }
        echo json_encode($result);
    }

    public function submit_approved(){
        $response = array();
        
        $id = $this->input->post('id');
        $data = array(
            'status' => 2,
            'date_approved' => date('M d, Y')
        );
        $update = $this->Admin_Installment_Model->update($data,$id);
        if($update == true){
            $this->session->set_flashdata('messages','success');
            $response['success'] = true;
        }
        else 
        {
            $this->session->set_flashdata('messages','Something went wrong!');
            $response['success'] = false;
        }
        echo json_encode($response);
    }

    public function disapproved()
	{
        $data['pending'] = count($this->Admin_Installment_Model->getInstallmentData(1));
        $data['approved'] = count($this->Admin_Installment_Model->getInstallmentData(2));
        $data['released'] = count($this->Admin_Installment_Model->getInstallmentData(3));
        $data['disapproved'] = count($this->Admin_Installment_Model->getInstallmentData(4));
        $data['cancelled'] = count($this->Admin_Installment_Model->getInstallmentCancelled());
        $data['colors'] = $this->Admin_Color_Model->getColorData();
        $data['models'] = $this->Admin_Model_Model->getModelData();
		$data['customers'] = $this->Admin_Customer_Model->getCustomerData();
		$data['pages'] = 'installment/disapproved';
		$this->load->view('admin/layout/templates',$data); 
    }

    public function submit_disapproved(){
        $response = array();
        $id = $this->input->post('id');
        $data = array(
            'status' => 4,
            'date_disapproved' => date('M d, Y')
        );
        $update = $this->Admin_Installment_Model->update($data,$id);
        if($update == true){
            $this->session->set_flashdata('messages','success');
            $response['success'] = true;
        }
        else 
        {
            $this->session->set_flashdata('messages','Something went wrong!');
            $response['success'] = false;
        }
        echo json_encode($response);
    }

    public function approved()
	{
        $data['pending'] = count($this->Admin_Installment_Model->getInstallmentData(1));
        $data['approved'] = count($this->Admin_Installment_Model->getInstallmentData(2));
        $data['released'] = count($this->Admin_Installment_Model->getInstallmentData(3));
        $data['disapproved'] = count($this->Admin_Installment_Model->getInstallmentData(4));
        $data['cancelled'] = count($this->Admin_Installment_Model->getInstallmentCancelled());
        $data['interest'] = $this->Admin_Installment_Model->getInterest();
        $data['penalty'] = $this->Admin_Installment_Model->getPenalty(1);
        $data['colors'] = $this->Admin_Color_Model->getColorData();
        $data['models'] = $this->Admin_Model_Model->getModelData();
		$data['customers'] = $this->Admin_Customer_Model->getCustomerData();
		$data['pages'] = 'installment/approved';
		$this->load->view('admin/layout/templates',$data); 
    }

    public function fetchApproved(){
        $result = array('data' => array());

        $loan = $this->Admin_Installment_Model->getApprovedData(2);
      
        foreach($loan as $key=>$value){
            
         $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);
         
         $eStock = '';
         $eItems = '';
         $eStock = $this->Admin_Installment_Model->getEbikeStock($value['ebike_id'], $value['color_id']);
         if(!$eStock == null){
             $eItems = count($this->Admin_Installment_Model->getEbikeStockItems($eStock['id']));
         }

         $result['stock'] = $eItems;
         
         $availability = '';
         $disable = '';
         if($eItems == 0 || $eItems < 0 ){
            $availability = '<span class="badge badge-danger">Out of Stock</span>';
            $disable = 'disabled';
         }
         else
         {
            $availability = '<span class="badge badge-success">In Stock</span>';
            $disable = '';
         }

         $buttons = '';
            $buttons .= '<button '.$disable.' type="button" class="btn btn-outline-dark" onclick="release('.$value['id'].')" data-toggle="modal" data-target="#approvedModal">Release</button>';	
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancelled('.$value['id'].')" data-toggle="modal" data-target="#cancelModal">Cancel</button>';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="contact('.$value['customer_id'].')" data-toggle="modal" data-target="#contactModal">Contact</button>';
          
            // $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
   
        $result['data'][$key] = array(
            $value['id'],
            $value['ebike_name'],
            $value['ebike_color'],
            $customer['customer_firstname'].' '.$customer['customer_lastname'],
            $availability,
            '<span class="badge badge-success">approved</span>',
            $buttons,
            );
        }
        echo json_encode($result);
    }

    public function getApproved(){
         $response = array();
         $id = $this->input->post('id');
         $approved = $this->Admin_Installment_Model->getApprovedById($id);
         if($approved){
            $eStock= $this->Admin_Installment_Model->getEbikeStock($approved['ebike_id'], $approved['color_id']);
            $response['eItems'] = $this->Admin_Installment_Model->getEbikeStockItems($eStock['id']);

            $response['data'] = $approved;
            $response['success'] = true;
         }
         else
         {
            $response['success'] = false;
         }
         echo json_encode($response);
    }

    public function submit_release(){
        $response = array();
        $update = $this->Admin_Installment_Model->release();
        if($update){
            // $this->session->set_flashdata('messages','success');
            // redirect(base_url('Admin_Receipt/print1/'.$update));
            $response['insert_id'] = $update;
            $response['success'] = true;
        }
        else 
        {
            $response['success'] = false;
        }

       echo json_encode($response);
    }
    
    
    public function fetchDisapproved(){
        $result = array('data' => array());

        $loan = $this->Admin_Installment_Model->getInstallmentData(4);
      
        foreach($loan as $key=>$value){
            
         $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);

         $buttons = '';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="release('.$value['id'].')" data-toggle="modal" data-target="#approvedModal">Release</button>';	
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#disapprovedModal">Cancel</button>';
            // $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
   
        $result['data'][$key] = array(
            $value['id'],
            $value['ebike_name'],
            $value['ebike_color'],
            $customer['customer_firstname'].' '.$customer['customer_lastname'] ,
            '<span class="badge badge-warning">disapproved</span>',
          
            );
        }
        echo json_encode($result);
    }

    public function released()
	{
        $data['pending'] = count($this->Admin_Installment_Model->getInstallmentData(1));
        $data['approved'] = count($this->Admin_Installment_Model->getInstallmentData(2));
        $data['released'] = count($this->Admin_Installment_Model->getInstallmentData(3));
        $data['disapproved'] = count($this->Admin_Installment_Model->getInstallmentData(4));
        $data['cancelled'] = count($this->Admin_Installment_Model->getInstallmentCancelled());
        $data['colors'] = $this->Admin_Color_Model->getColorData();
        $data['models'] = $this->Admin_Model_Model->getModelData();
		$data['customers'] = $this->Admin_Customer_Model->getCustomerData();
		$data['pages'] = 'installment/released';
		$this->load->view('admin/layout/templates',$data); 
    }

    public function fetchReleased(){
        $result = array('data' => array());

        $loan = $this->Admin_Installment_Model->getInstallmentReleased();
      
        foreach($loan as $key=>$value){
            
         $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);

         $buttons = '';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="release('.$value['id'].')" data-toggle="modal" data-target="#approvedModal">Release</button>';	
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#disapprovedModal">Cancel</button>';
            $status = '';
            if($value['paid_status'] == 1){
                $status =  '<span class="badge badge-success">Fully Paid</span>';
            }
            if($value['paid_status'] == 2){
                $status =  '<span class="badge badge-success">Still Paying</span>';
            }
            if($value['paid_status'] == 3){
                $status =  '<span class="badge badge-danger">Past Due</span>';
            }
            if($value['paid_status'] == 4){
                $status =  '<span class="badge badge-danger">Pull Out</span>';
            }
        $result['data'][$key] = array(
            $value['id'],
            $value['ebike_name'],
            $value['ebike_color'],
            $customer['customer_firstname'].' '.$customer['customer_lastname'] ,
            $status,
            );
        }
        echo json_encode($result);
    }


    public function submit_cancelled(){
        $response = array();
        $id = $this->input->post('id');
        $data = array(
            'cancelled' => 1,
        );
        $update = $this->Admin_Installment_Model->update($data,$id);
        if($update == true){
            $this->session->set_flashdata('messages','success');
            $response['success'] = true;
        }
        else 
        {
            $this->session->set_flashdata('messages','Something went wrong!');
            $response['success'] = false;
        }
        echo json_encode($response);
    }

    public function cancelled()
	{
        $data['pending'] = count($this->Admin_Installment_Model->getInstallmentData(1));
        $data['approved'] = count($this->Admin_Installment_Model->getInstallmentData(2));
        $data['released'] = count($this->Admin_Installment_Model->getInstallmentData(3));
        $data['disapproved'] = count($this->Admin_Installment_Model->getInstallmentData(4));
        $data['cancelled'] = count($this->Admin_Installment_Model->getInstallmentCancelled());
        $data['interest'] = $this->Admin_Installment_Model->getInterest();
        $data['colors'] = $this->Admin_Color_Model->getColorData();
        $data['models'] = $this->Admin_Model_Model->getModelData();
		$data['customers'] = $this->Admin_Customer_Model->getCustomerData();
		$data['pages'] = 'installment/cancelled';
		$this->load->view('admin/layout/templates',$data); 
    }

    public function fetchCancelled(){
        $result = array('data' => array());

        $loan = $this->Admin_Installment_Model->getInstallmentCancelled();
      
        foreach($loan as $key=>$value){
            
         $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);

         $buttons = '';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="release('.$value['id'].')" data-toggle="modal" data-target="#approvedModal">Release</button>';	
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#disapprovedModal">Cancel</button>';
            // $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
   
        $result['data'][$key] = array(
            $value['id'],
            $value['ebike_name'],
            $value['ebike_color'],
            $customer['customer_firstname'].' '.$customer['customer_lastname'] ,
            '<span class="badge badge-warning">cancelled</span>',
          
            );
        }
        echo json_encode($result);
    }
    // extra
    public function interest_update(){
     
        $update = $this->Admin_Installment_Model->update_interest();
        if($update == true){
            $this->session->set_flashdata('messages','success');
            redirect(base_url('Admin_Installment/approved'));
        }
        else 
        {
            $this->session->set_flashdata('messages','Something went wrong!');
           
        }
    }

    public function penalty_update(){
     
        $update = $this->Admin_Installment_Model->update_penalty();
        if($update == true){
            $this->session->set_flashdata('messages','success');
            redirect(base_url('Admin_Installment/approved'));
        }
        else 
        {
            $this->session->set_flashdata('messages','Something went wrong!');
           
        }
    }

    public function getCustomer(){
   
        $id = $this->input->post('id');
        $loan = $this->Admin_Installment_Model->getInstallmentDataById($id);
       
        $customer = $this->Admin_Customer_Model->getCustomerData($loan['customer_id']);

        echo json_encode($customer);
    }

    public function getCustomerInfo(){
   
        $id = $this->input->post('id');

        $customer = $this->Admin_Customer_Model->getCustomerData($id);

        echo json_encode($customer);
    }

    
    public function sendmail() {
        
        $response = array();

        $email = $this->input->post('email');
        $message = $this->input->post('message');
        $subject = $this->input->post('subject');
        
        $from_email = "maghinangjanwendel.pdm@gmail.com";
        $to_email = $email;

        //Load email library 
        $this->load->library('email');

        $this->email->from($from_email, 'Hpz Eco-bike Trading Company');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);

        //Send mail 
        if ($this->email->send()){
            $response['success'] = true;
        }
        else{
            $response['success'] = false;
        }
         echo json_encode($response);
    }

}