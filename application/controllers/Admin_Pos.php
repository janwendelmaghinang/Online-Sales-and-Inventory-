<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Pos extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Admin_Spareparts_Model');
        $this->load->Model('Admin_Customer_Model');
        $this->load->Model('Admin_Color_Model');
        $this->load->Model('Admin_Model_Model');
        $this->load->Model('Admin_Company_Model');
        $this->load->Model('Admin_Pos_Model');
        // $this->generateKey();
    }

    public function index()
	{
        // echo mt_rand(1,9);
        // $str = 12345678;
        // echo uniqid();
        $data['colors'] = $this->Admin_Color_Model->getColorData();
        $data['models'] = $this->Admin_Model_Model->getModelData();
        $data['customers'] = $this->Admin_Customer_Model->getCustomerData();
        $data['company'] = $this->Admin_Company_Model->getCompanyData();
        $data['products'] = $this->Admin_Spareparts_Model->getSparepartsData();
        $data['pages'] = 'pos/index';
        $this->load->view('admin/layout/templates',$data);

     
    }
    
    public function proceedpayment(){

        $response = array();

        if($this->input->post('discount')){
            $discount = $this->input->post('discount');
        }
        else 
        {
            $discount = 0;
        }
         
        if($this->input->post('truecase') == 1){
            $this->form_validation->set_rules('customer_select_id', 'customer', 'trim|required');
            $this->form_validation->set_rules('payment_amount_tentered', 'amount', 'trim|required');
         
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
            

                if($this->form_validation->run() == true){
                    $info = array(
                        'ref_no' => mt_rand(1,999999),
                        'customer_id' => $this->input->post('customer_select_id'),
                        'discount' => $discount
                    );

                    $insert = $this->Admin_Pos_Model->insertSales($info);
                    
                    if($insert){
                        $response['success'] = true;
                        $response['insert_id'] = $insert;
                    }
                    else 
                    {
                        $response['success'] = false;
                    }
                }
                
                else 
                {
                    $response['success'] = false;
                    foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
        }
        else 
        {
            $this->form_validation->set_rules('payment_amount_tentered', 'amount', 'trim|required');
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
                    'active' => 1
                );
                $customer_id = $this->Admin_Customer_Model->insertCustomerData($data);
                if($customer_id){
                    $info = array(
                        'ref_no' => mt_rand(1,999999),
                        'customer_id' => $customer_id, 
                        'discount' => $discount
                    );
                    $insert = $this->Admin_Pos_Model->insertSales($info);
                    if($insert){
                        $response['success'] = true;
                        $response['insert_id'] = $insert;
                    }
                    else 
                    {
                        $response['success'] = false;
                    }
                }
            }

            else 
            {
                $response['success'] = false;
                foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
                }
            }
            
        }
        echo json_encode($response);
    }

    function generateKey(){
        $ref_no = mt_rand(1,999999);
        $this->check_key($ref_no);
    }
    function check_key($ref_no){
        $get_ref_no = $this->Admin_Pos_Model->getSalesByRefNoData($ref_no);
        if(count($get_ref_no) > 0){
            echo $ref_no;
            $this->generateKey();
        }
        else 
        {
        }
    }

    public function placeOrder(){

        $response = array();

        if($this->input->post('discount')){
            $discount = $this->input->post('discount');
        }
        else 
        {
            $discount = 0;
        }
             
            $this->form_validation->set_rules('c_firstname', 'firstname', 'trim|required');
            $this->form_validation->set_rules('c_lastname', 'lastname', 'trim|required');
            $this->form_validation->set_rules('c_contact', 'contact', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
            
            if($this->form_validation->run() == true){
                $data = array(
                    'customer_firstname' => $this->input->post('c_firstname'),
                    'customer_lastname' => $this->input->post('c_lastname'),
                    'customer_contact' => $this->input->post('c_contact'),
                );
                $customer_id = $this->Admin_Customer_Model->insertCustomerData($data);
                if($customer_id){
                    $info = array(
                        'ref_no' => mt_rand(1,999999),
                        'customer_id' => $customer_id, 
                        'discount' => $discount
                    );
                    $insert = $this->Admin_Pos_Model->insertOrder($info);
                    if($insert){
                        $response['success'] = true;
                        $response['insert_id'] = $insert;
                    }
                    else 
                    {
                        $response['success'] = false;
                    }
                }
            }

            else 
            {
                $response['success'] = false;
                foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
                }
            }
            
        echo json_encode($response);
    }

    public function res(){
        $data['pages'] = 'pos/res';
        $this->load->view('admin/layout/templates',$data);

    }

    public function print($id){
        if($id){
            $items = '';
            $company = $this->Admin_Company_Model->getCompanyData();
            $sales = $this->Admin_Pos_Model->getSalesData($id);
            $customer = $this->Admin_Customer_Model->getCustomerData($sales['customer_id']);
            
            if($sales['sales_type'] == 1){
                $items =  $this->Admin_Pos_Model->getSalesItemData($id);

                $html = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>

                    <link rel="stylesheet" href="'.base_url('assets/bootstrap/css/bootstrap.min.css').'" >
                </head>
                <body onload="window.print() ">
                <div class="container">
                    <div class="row">
                        <div class="col">
                        <h3 class="text-center">'.$company['company_name'].'</h3>
                        <h5 class="text-center">'.$company['warehouse'].', '.$company['street'] .'</h5>
                        <h5 class="text-center">'.$company['barangay'].', '.$company['city'].', '. $company['province'].'</h5>
                        <p class="text-center"><strong>Contact Number: </strong>'.$company['phone'].' <strong>Email: </strong>'.$company['email'].'</p>
                
                        <div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Customer:</label>  <label class="border-bottom"> '.$customer['customer_firstname'].' '.$customer['customer_lastname'] .'</label><br>
                            <label for="">Reference No: </label> <label  class="border-bottom">'.$sales['ref_no'].'</label><br>
                            <label for="">Date:</label> <label  class="border-bottom"> '.date('M d, Y').'</label><br>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Product id</th>
                                    <th>name</th>
                                    <th>qty</th>
                                    <th>price</th>
                                    <th>Total Amount</th>
                                </thead>
                                <tbody>'; 

                                foreach ($items as $item) {    
                                    
                                    $stock = $this->Admin_Spareparts_Model->getStockData($item['product_id']);
                                    $data =$this->Admin_Spareparts_Model->getSparepartsData($stock['parts_id']);
                                    
                                    $html .= '<tr>
                                    <td>'.$stock['id'].'</td>
                                    <td>'.$item['product_name'].'</td>
                                    <td>'.$item['order_quantity'].'</td>
                                    <td>'.$data['price'].'</td>
                                    <td>'.$item['order_subtotal'].'</td>
                                    </tr>';
                                }
                                
                                $html .= '</tbody>
                                <tfoot>
                                    <tr>
                                    <th class="text-right" colspan="4">Total</th><th>'.$sales['gross_amount'].'</th>
                                    </tr>
                                    <tr>
                                    <th class="text-right" colspan="4">Vatable</th><th>'.$sales['vatable'].'</th>
                                </tr>
                                    <tr>
                                    <th class="text-right" colspan="4">Vat '.$sales['vat_charge_rate'].'%'.'</th><th>'.$sales['vat_charge'].'</th>
                                </tr>';
                                if($sales['discount'] > 0){
                                    $html .='
                                    <tr>
                                    <th class="text-right" colspan="4">Discount</th><th>'.$sales['discount'].'</th>
                                </tr>
                                    ';
                                }   
                                $html .=' <tr>
                                <th class="text-right" colspan="4">Amount Payable</th><th>'.$sales['total_amount'].'</th>
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="4">Amount Tendered</th><th>'.$sales['amount_tentered'].'</th>
                                </tr>
                                <tr>
                                <th class="text-right" colspan="4">Change</th><th>'.$sales['amount_change'].'</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                </body>
                </html>';
                echo $html;
            }
            else
            {
                $items =  $this->Admin_Pos_Model->getSalesItemData1($id);
                $html = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>

                    <link rel="stylesheet" href="'.base_url('assets/bootstrap/css/bootstrap.min.css').'" >
                </head>
                <body onload="window.print() ">
                <div class="container">
                    <div class="row">
                        <div class="col">
                        <h3 class="text-center">'.$company['company_name'].'</h3>
                        <h5 class="text-center">'.$company['warehouse'].', '.$company['street'] .'</h5>
                        <h5 class="text-center">'.$company['barangay'].', '.$company['city'].', '. $company['province'].'</h5>
                        <p class="text-center"><strong>Contact Number: </strong>'.$company['phone'].' <strong>Email: </strong>'.$company['email'].'</p>
                
                        <div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Customer:</label>  <label class="border-bottom"> '.$customer['customer_firstname'].' '.$customer['customer_lastname'] .'</label><br>
                            <label for="">Reference No: </label> <label  class="border-bottom">'.$sales['ref_no'].'</label><br>
                            <label for="">Date:</label> <label  class="border-bottom"> '.date('M d, Y').'</label><br>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Product id</th>
                                    <th>name</th>
                                    <th>price</th>
                                    <th>Total Amount</th>
                                </thead>
                                <tbody>'; 

                                foreach ($items as $item) {    
                                    
                                    // $stock = $this->Admin_Spareparts_Model->getStockData($item['product_id']);
                                    // $data =$this->Admin_Spareparts_Model->getSparepartsData($stock['parts_id']);
                                    
                                    $html .= '<tr>
                                    <td>'.$item['id'].'</td>
                                    <td>'.$item['product_name'].'</td>
                                    <td>'.$item['price'].'</td>
                                    <td>'.$item['order_subtotal'].'</td>
                                    </tr>';
                                }
                                
                                $html .= '</tbody>
                                <tfoot>
                                    <tr>
                                    <th class="text-right" colspan="4">Total</th><th>'.$sales['gross_amount'].'</th>
                                    </tr>
                                    <tr>
                                    <th class="text-right" colspan="4">Vatable</th><th>'.$sales['vatable'].'</th>
                                </tr>
                                    <tr>
                                    <th class="text-right" colspan="4">Vat '.$sales['vat_charge_rate'].'%'.'</th><th>'.$sales['vat_charge'].'</th>
                                </tr>';
                                if($sales['discount'] > 0){
                                    $html .='
                                    <tr>
                                    <th class="text-right" colspan="4">Discount</th><th>'.$sales['discount'].'</th>
                                </tr>
                                    ';
                                }   
                                $html .=' <tr>
                                <th class="text-right" colspan="4">Amount Payable</th><th>'.$sales['total_amount'].'</th>
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="4">Amount Tendered</th><th>'.$sales['amount_tentered'].'</th>
                                </tr>
                                <tr>
                                <th class="text-right" colspan="4">Change</th><th>'.$sales['amount_change'].'</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                </body>
                </html>';
                echo $html;
            }

            
        }
    }

    // pos ebike
    public function purchaseEbike(){
        if($this->input->post('discount')){
            $discount = $this->input->post('discount');
        }
        else 
        {
            $discount = 0;
        }    
        if($this->input->post('truecase') == 1){
            $this->form_validation->set_rules('customer_select_id', 'customer', 'trim|required');
            $this->form_validation->set_rules('payment_amount_tentered', 'amount', 'trim|required'); 
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
            if($this->form_validation->run() == true){
                $random = round(microtime(true) * 1000);
                $target_directory1 = "uploads/purchaseForm/"."form".$random.'.png';
                move_uploaded_file($_FILES['purchase_form']['tmp_name'],"uploads/purchaseForm/"."form".$random.'.png');

                $info = array(
                    'ref_no' => mt_rand(1,999999),
                    'customer_id' => $this->input->post('customer_select_id'),
                    'discount' => $discount,
                    'purchase_form' => $target_directory1
                );
                $insert = $this->Admin_Pos_Model->insertSalesEbike($info);
                
                if($insert){
                    redirect(base_url('Admin_Pos/invoice'));
                }
                else 
                {
                 
                }
            }        
        }
        else 
        {
            $this->form_validation->set_rules('payment_amount_tentered', 'amount', 'trim|required');
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
                    'customer_valid_id' => $target_directory
                );

                $customer_id = $this->Admin_Customer_Model->insertCustomerData($data);
                if($customer_id){
                  
                    $target_directory1 = "uploads/purchaseForm/"."form".$random.'.png';
                    move_uploaded_file($_FILES['purchase_form']['tmp_name'],"uploads/purchaseForm/"."form".$random.'.png');

                    $info = array(
                        'ref_no' => mt_rand(1,999999),
                        'customer_id' => $customer_id, 
                        'discount' => $discount,
                        'purchase_form' => $target_directory1
                    );
                    $insert = $this->Admin_Pos_Model->insertSalesEbike($info);
                    if($insert){
                        redirect(base_url('Admin_Pos/invoice'));
                    }
                    else 
                    {
                       
                    }
                }

            }
        }
    }    

    public function invoice(){
        $data['pages'] = 'pos/ebike_invoice';
        $this->load->view('admin/layout/templates',$data);
    }
 
}