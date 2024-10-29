<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Bank extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Bank_Model');
        $this->load->model('Admin_Order_Model');
        $this->load->model('Admin_Spareparts_Model');
    }

    public function index()
	{
        $data['pages'] = 'bank/index';
        $this->load->view('admin/layout/templates',$data);
    }
 
    public function fetchAllBankData(){

        $result = array('data' => array());

        $banks = $this->Admin_Bank_Model->getBankData();
        foreach($banks as $key=>$value){

         $buttons = '';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="editBank('.$value['id'].')" data-toggle="modal" data-target="#editBankModal"><i class="fa fa-pencil"></i></button>';	
            $buttons .= ' <button type="button" class="btn btn-outline-dark" onclick="deletebank('.$value['id'].')" data-toggle="modal" data-target="#deleteBankModal"><i class="fa fa-trash"></i></button>';
          
            $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
   
        $result['data'][$key] = array(
            $value['id'],
            $value['bank_name'],
            $value['account_name'],
            $value['account_number'],
            '<img src="'.base_url($value['qrcode']).'" width="50" height="50">',
            $status,
            $buttons,
            );
        }
        echo json_encode($result);
    }

    public function create(){
        
        $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
        $this->form_validation->set_rules('account_name', 'Account Name', 'trim|required');
        $this->form_validation->set_rules('account_number', 'Account Number', 'trim|required');

        $bank_name = $this->input->post('bank_name');
        $account_name = $this->input->post('account_name');
        $account_number = $this->input->post('account_number');
        
        if($this->form_validation->run() == true){
            $random = round(microtime(true) * 1000);
            $target_directory = "uploads/qrcode/"."qr".$random.'.png';
            move_uploaded_file($_FILES['qrcode']['tmp_name'],"uploads/qrcode/"."qr".$random.'.png');
            
            $data = array(
                'bank_name' => $bank_name,
                'account_name' => $account_name,
                'account_number' => $account_number,
                'active' =>  $this->input->post('active'),
                'qrcode' => $target_directory
            );
            $insert = $this->Admin_Bank_Model->insertBankData($data);
            if($insert){
                $this->session->set_flashdata('messages_success','Bank Successfully Added');
                redirect(base_url('Admin_Bank'));
            }
            else
            {
                $this->session->set_flashdata('messages_success','Error Uploading');
                redirect(base_url('Admin_Bank'));
            }
        }
        else 
        {
            $this->session->set_flashdata('messages_success','Error');
            redirect(base_url('Admin_Bank'));
        }
        
    }
 
    public function edit(){
            
            $id = $this->input->post('bank_id');
            $this->form_validation->set_rules('edit_bank_name', 'Bank Name', 'trim|required');
            $this->form_validation->set_rules('edit_account_name', 'Account Name', 'trim|required');
            $this->form_validation->set_rules('edit_account_number', 'Account Number', 'trim|required');
    
            $bank_name = $this->input->post('edit_bank_name');
            $account_name = $this->input->post('edit_account_name');
            $account_number = $this->input->post('edit_account_number');
            
            if($this->form_validation->run() == true){
                $target_directory = '';
                $random = round(microtime(true) * 1000);
                if(move_uploaded_file($_FILES['edit_qrcode']['tmp_name'],"uploads/qrcode/"."qr".$random.'.png')){  
                    $target_directory = "uploads/qrcode/"."qr".$random.'.png';
                }
                else
                {
                    $target_directory = $this->input->post('edit_qr_hidden');;
                }
                $data = array(
                    'bank_name' => $bank_name,
                    'account_name' => $account_name,
                    'account_number' => $account_number,
                    'active' =>  $this->input->post('active'),
                    'qrcode' => $target_directory
                );
                $update= $this->Admin_Bank_Model->editBankData($data, $id);
                if($update){
                     $this->session->set_flashdata('messages_success','Bank Updated Successfully');
                     redirect(base_url('Admin_Bank'));
                }
                else
                {
                    $this->session->set_flashdata('messages_danger','Something Went Wrong!');
                    redirect(base_url('Admin_Bank'));
                }
            }
            else 
            {
                $this->session->set_flashdata('messages_danger','Error!');
                redirect(base_url('Admin_Bank'));
            }

    }
     
    public function delete(){
            
        $id = $this->input->post('del_bank_id');

        if($id)
        {
            $delete = $this->Admin_Bank_Model->deleteBankData($id);
            if($delete){
                 $this->session->set_flashdata('messages_success','Bank Deleted Successfully');
                 redirect(base_url('Admin_Bank'));
            }
            else
            {
                $this->session->set_flashdata('messages_danger','Something Went Wrong!');
                redirect(base_url('Admin_Bank'));
            }
        }
        else 
        {
            $this->session->set_flashdata('messages_danger','Error!');
            redirect(base_url('Admin_Bank'));
        }

    }

    // extra
    public function getBankById(){
        $id = $this->input->post('id');
        $response = array();

        if($id){

            $bank = $this->Admin_Bank_Model->getBankData($id);
            if($bank){
                $response['data'] = $bank;
                $response['success'] = true;
            }
            else 
            { 
                $response['success'] = false;
            }
        }
        else
        {    
            $response['success'] = false;
        }

        echo json_encode($response);
    }


}