<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Sales extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Sales_Model');
        $this->load->model('Admin_Customer_Model');

        $this->load->model('Helper_Model');
    }

    public function index()
   	{
        $data['pages'] = 'sales/walkin';
        $this->load->view('admin/layout/templates',$data);
    }
    // ------------------------
    public function fetchAllSales(){
        $result = array('data' => array());

        $sales = $this->Admin_Sales_Model->getSalesWalkin();
        $i = 1;
        
        foreach($sales as $key=>$value){

      
            $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);
            if($customer){
            $customer = $customer['customer_firstname'].' '. $customer['customer_lastname'];
            }

            $buttons = '';
                $buttons .= '<a href="#" class="btn btn-outline-dark"><i class="fa fa-pencil"></i></a>';
                if($value['sales_from'] == 1){
                    $buttons .= ' <a href="'.base_url('Admin_Receipt/print/').$value['id'].'" class="btn btn-outline-dark" target="_blank"><i class="fa fa-print"></i></a>';
                }

                $buttons .= ' <a href="#" class="btn btn-outline-dark"><i class="fa fa-trash"></i></a>';
            
            $result['data'][$key] = array(
                $value['id'],
                $value['ref_no'],
                $customer,
                $value['sales_date'],
                $value['total_amount'],
                $buttons,
                );
        }

        echo json_encode($result);
    }
    
    public function online()
    {
     $data['pages'] = 'sales/online';
     $this->load->view('admin/layout/templates',$data);
    }
    // ------------------------
    public function fetchAllSalesOnline(){
        $result = array('data' => array());

        $sales = $this->Admin_Sales_Model->getSalesOnline();
        $i = 1;
        
        foreach($sales as $key=>$value){

    
            $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);
            if($customer){
            $customer = $customer['customer_firstname'].' '. $customer['customer_lastname'];
            }

            $buttons = '';
                $buttons .= '<a href="#" class="btn btn-outline-dark"><i class="fa fa-pencil"></i></a>';
                $buttons .= ' <a href="'.base_url('Admin_Receipt/print_online/').$value['id'].'" class="btn btn-outline-dark" target="_blank"><i class="fa fa-print"></i></a>';
                $buttons .= ' <a href="#" class="btn btn-outline-dark"><i class="fa fa-trash"></i></a>';
            
            $result['data'][$key] = array(
                $value['id'],
                $value['ref_no'],
                $customer,
                $value['sales_date'],
                $value['total_amount'],
                $buttons,
                );
        }

        echo json_encode($result);
    }
    public function loan()
    {
       $data['pages'] = 'sales/index1';
       $this->load->view('admin/layout/templates',$data);
    }

    public function fetchAllSalesLoan(){

      $result = array('data' => array());

      $sales = $this->Admin_Sales_Model->getSalesLoanData();
      $i = 1;
      
      foreach($sales as $key=>$value){

      $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);
      if($customer){
        $customer = $customer['customer_firstname'].' '. $customer['customer_lastname'];
      }

       $buttons = '';
          $buttons .= '<a href="#" class="btn btn-outline-dark"><i class="fa fa-pencil"></i></a>';	
          $buttons .= ' <a href="'.base_url('Admin_Receipt/print1/').$value['id'].'" class="btn btn-outline-dark" target="_blank"><i class="fa fa-print"></i></a>';
          $buttons .= ' <a href="#" class="btn btn-outline-dark"><i class="fa fa-trash"></i></a>';
      
      $result['data'][$key] = array(
          $value['id'],
          $customer,
          $value['sales_date'],
          $value['total_amount'],
          $buttons,
          );
      }

      echo json_encode($result);
    }

  public function service()
  {
     $data['pages'] = 'sales/index2';
     $this->load->view('admin/layout/templates',$data);
  }

  public function fetchAllSalesService(){

    $result = array('data' => array());

    $sales = $this->Admin_Sales_Model->getSalesLoanData();
    $i = 1;
    
    foreach($sales as $key=>$value){

    $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);
    if($customer){
      $customer = $customer['customer_firstname'].' '. $customer['customer_lastname'];
    }

     $buttons = '';
        $buttons .= '<a href="#" class="btn btn-outline-dark"><i class="fa fa-pencil"></i></a>';	
        $buttons .= ' <a href="'.base_url('Admin_Receipt/print1/').$value['id'].'" class="btn btn-outline-dark" target="_blank"><i class="fa fa-print"></i></a>';
        $buttons .= ' <a href="#" class="btn btn-outline-dark"><i class="fa fa-trash"></i></a>';
    
    $result['data'][$key] = array(
        $i,
        $customer,
        $value['sales_date'],
        $value['amount_tentered'],
        $buttons,
        );

        $i++;
    }

    echo json_encode($result);
}


}