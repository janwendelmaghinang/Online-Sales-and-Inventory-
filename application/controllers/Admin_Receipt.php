<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Receipt extends CI_Controller{
     
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Admin_Receipt_Model');
        $this->load->Model('Admin_Spareparts_Model');
        $this->load->Model('Admin_Customer_Model');
        $this->load->Model('Admin_Color_Model');
        $this->load->Model('Admin_Model_Model');
        $this->load->Model('Admin_Company_Model');
        $this->load->Model('Admin_Pos_Model');
        $this->load->Model('Admin_Installment_Model');
        date_default_timezone_set("Asia/Bangkok");
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
                    <div class="col col-sm-12 col-md-4 col-lg-4">
                        <table class="table table-sm table-borderless">
                            <tr>
                               <td class="tdWidth"><p class=" tLabel font-weight-bold">Customer:</p></td><td class=" tData text-capitalize">'.$customer['customer_firstname'].' '.$customer['customer_lastname'] .'</td>
                            </tr>
                            <tr>
                               <td class="tdWidth"><p class=" tLabel font-weight-bold">Contact:</p></td><td class=" tData text-capitalize">'.$customer['customer_contact'].'</td>
                            </tr>
                            <tr>
                               <td class="tdWidth"><p class=" tLabel font-weight-bold">Email:</p></td><td class=" tData ">'.$customer['customer_email'].'</td>
                            </tr>
                            <tr>
                                <td class="tdWidth"><p class=" tLabel font-weight-bold">Address:</p></td><td class=" tData text-capitalize">'.$customer['customer_street'].' '.$customer['customer_subdivision'].' '.$customer['customer_barangay'].'</td>
                            </tr>
                            <tr>
                                <td class="tdWidth"></td><td class=" tData text-capitalize">'.$customer['customer_city'].' '.$customer['customer_province'].'</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col col-sm-12 col-md-4 col-lg-4">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td class="tdWidth"><p class=" tLabel font-weight-bold">Reference Number:</p></td><td class=" tData text-capitalize">' .$sales['ref_no'].'</td>
                            </tr>
                            <tr>
                                <td class="tdWidth"><p class=" tLabel font-weight-bold">Sales Date:</p></td><td class=" tData text-capitalize">'.$sales['sales_date'].'</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col col-sm-12 col-md-4 col-lg-4">
                        <table class="table table-sm table-borderless">
                            <tr>
                               <td class="tdWidth"><p class=" tLabel font-weight-bold">Receipt ID:</p></td><td class=" tData text-capitalize ">' .$sales['id'].'</td>
                            </tr>
                            <tr>
                               <td class="tdWidth"><p class=" tLabel font-weight-bold">Receipt Date:</p></td><td class=" tData text-capitalize">'.date('M d, Y').'</td>
                            </tr>
                        </table>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Name</th>
                                    <th>qty</th>
                                    <th>price</th>
                                    <th>Total Amount</th>
                                </thead>
                                <tbody>'; 

                                foreach ($items as $item) {    
                                    
                                    $stock = $this->Admin_Spareparts_Model->getStockData($item['product_id']);
                                    $data =$this->Admin_Spareparts_Model->getSparepartsData($stock['parts_id']);
                                    
                                    $html .= '<tr>
                                    <td>'.$item['product_name'].'</td>
                                    <td>'.$item['order_quantity'].'</td>
                                    <td>'.$item['price'].'</td>
                                    <td>'.$item['order_subtotal'].'</td>
                                    </tr>';
                                }
                                
                                $html .= '</tbody>
                                <tfoot>
                                    <tr>
                                    <th class="text-right" colspan="3">Total</th><th>'.$sales['gross_amount'].'</th>
                                    </tr>
                                    <tr>
                                    <th class="text-right" colspan="3">Vatable</th><th>'.$sales['vatable'].'</th>
                                </tr>
                                    <tr>
                                    <th class="text-right" colspan="3">Vat '.$sales['vat_charge_rate'].'%'.'</th><th>'.$sales['vat_charge'].'</th>
                                </tr>';
                                if($sales['discount'] > 0){
                                    $html .='
                                    <tr>
                                    <th class="text-right" colspan="3">Discount</th><th>'.$sales['discount'].'</th>
                                </tr>
                                    ';
                                }   
                                $html .=' <tr>
                                <th class="text-right" colspan="3">Amount Payable</th><th>'.$sales['total_amount'].'</th>
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="3">Amount Tendered</th><th>'.$sales['amount_tentered'].'</th>
                                </tr>
                                <tr>
                                <th class="text-right" colspan="3">Change</th><th>'.$sales['amount_change'].'</th>
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
                <body">
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
                        <div class="col col-sm-12 col-md-4 col-lg-4">
                            <table class="table table-sm table-borderless">
                                <tr>
                                <td class="tdWidth"><p class=" tLabel font-weight-bold">Customer:</p></td><td class=" tData text-capitalize">'.$customer['customer_firstname'].' '.$customer['customer_lastname'] .'</td>
                                </tr>
                                <tr>
                                   <td class="tdWidth"><p class=" tLabel font-weight-bold">Reference Number:</p></td><td class=" tData text-capitalize">' .$sales['ref_no'].'</td>
                                </tr>
                                <tr>
                                   <td class="tdWidth"><p class=" tLabel font-weight-bold">Sales Date:</p></td><td class=" tData text-capitalize">'.$sales['sales_date'].'</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col col-sm-12 col-md-4 col-lg-4">
                        </div>
                        <div class="col col-sm-12 col-md-4 col-lg-4">
                            <table class="table table-sm table-borderless">
                                <tr>
                                   <td class="tdWidth"><p class=" tLabel font-weight-bold">Receipt ID:</p></td><td class=" tData text-capitalize ">' .$sales['id'].'</td>
                                </tr>
                                <tr>
                                   <td class="tdWidth"><p class=" tLabel font-weight-bold">Receipt Date:</p></td><td class=" tData text-capitalize">'.date('M d, Y').'</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Model</th>
                                    <th>Color</th>
                                    <th>Price</th>
                                    <th>Total Amount</th>
                                </thead>
                                <tbody>'; 

                                foreach ($items as $item) {    
                                    
                                    // $stock = $this->Admin_Spareparts_Model->getStockData($item['product_id']);
                                    // $data =$this->Admin_Spareparts_Model->getSparepartsData($stock['parts_id']);
                                    
                                    $html .= '<tr>
                                    <td>'.$item['product_name'].'</td>
                                    <td>'.$item['color'].'</td>
                                    <td>'.$item['price'].'</td>
                                    <td>'.$item['price'].'</td>
                                    </tr>';
                                }
                                
                                $html .= '</tbody>
                                <tfoot>
                                    <tr>
                                    <th class="text-right" colspan="3">Total</th><th>'.$sales['gross_amount'].'</th>
                                    </tr>
                                    <tr>
                                    <th class="text-right" colspan="3">Vatable</th><th>'.$sales['vatable'].'</th>
                                </tr>
                                    <tr>
                                    <th class="text-right" colspan="3">Vat '.$sales['vat_charge_rate'].'%'.'</th><th>'.$sales['vat_charge'].'</th>
                                </tr>';
                                if($sales['discount'] > 0){
                                    $html .='
                                    <tr>
                                    <th class="text-right" colspan="3">Discount</th><th>'.$sales['discount'].'</th>
                                </tr>
                                    ';
                                }   
                                $html .=' <tr>
                                <th class="text-right" colspan="3">Amount Payable</th><th>'.$sales['total_amount'].'</th>
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="3">Amount Tendered</th><th>'.$sales['amount_tentered'].'</th>
                                </tr>
                                <tr>
                                <th class="text-right" colspan="3">Change</th><th>'.$sales['amount_change'].'</th>
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

    public function print1($id){

        $sales =  $this->Admin_Receipt_Model->getSalesData($id);
        $loan =  $this->Admin_Installment_Model->getInstallmentDataById($sales['loan_id']);
        $company = $this->Admin_Company_Model->getCompanyData();
        // $sales = $this->Admin_Pos_Model->getSalesData($id);
        $customer = $this->Admin_Customer_Model->getCustomerData($sales['customer_id']);
        
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
                <div class="col mb-3">
                <h3 class="text-center">'.$company['company_name'].'</h3>
                <h5 class="text-center">'.$company['warehouse'].', '.$company['street'] .'</h5>
                <h5 class="text-center">'.$company['barangay'].', '.$company['city'].', '. $company['province'].'</h5>
                <p class="text-center"><strong>Contact Number: </strong>'.$company['phone'].' <strong>Email: </strong>'.$company['email'].'</p>
            <div><br><br><br>
            </div>
            <div class="row">
                <div class="col col-sm-12 col-md-4 col-lg-4">
                    <table class="table table-sm table-borderless">
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Customer:</p></td><td class=" tData text-capitalize">'.$customer['customer_firstname'].' '.$customer['customer_lastname'] .'</td>
                        </tr>
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Contact:</p></td><td class=" tData text-capitalize">'.$customer['customer_contact'].'</td>
                        </tr>
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Email:</p></td><td class=" tData ">'.$customer['customer_email'].'</td>
                        </tr>
                        <tr>
                            <td class="tdWidth"><p class=" tLabel font-weight-bold">Address:</p></td><td class=" tData text-capitalize">'.$customer['customer_street'].' '.$customer['customer_subdivision'].' '.$customer['customer_barangay'].'</td>
                        </tr>
                        <tr>
                            <td class="tdWidth"></td><td class=" tData text-capitalize">'.$customer['customer_city'].' '.$customer['customer_province'].'</td>
                        </tr>
                    </table>
                </div>
                <div class="col col-sm-12 col-md-4 col-lg-4">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="tdWidth"><p class=" tLabel font-weight-bold">Reference Number:</p></td><td class=" tData text-capitalize">' .$sales['ref_no'].'</td>
                        </tr>
                        <tr>
                            <td class="tdWidth"><p class=" tLabel font-weight-bold">Sales Date:</p></td><td class=" tData text-capitalize">'.$sales['sales_date'].'</td>
                        </tr>
                    </table>
                </div>
                <div class="col col-sm-12 col-md-4 col-lg-4">
                    <table class="table table-sm table-borderless">
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Receipt ID:</p></td><td class=" tData text-capitalize ">' .$sales['id'].'</td>
                        </tr>
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Receipt Date:</p></td><td class=" tData text-capitalize">'.date('M d, Y').'</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <th>Model</th>
                            <th>Color</th>
                            <th>Motor Number</th>
                            <th>Chassis Number</th>
                        </thead>
                        <tbody>'; 
                           $html .= '<tr>
                            <td>'.$loan['ebike_name'].'</td>
                            <td>'.$loan['ebike_color'].'</td>
                            <td>'.$loan['motor_number'].'</td>
                            <td>'.$loan['chasis_number'].'</td>
                            </tr>';                 
                        $html .= '</tbody>
                    </table>
                    <table class="table table-bordered w-50">
                    <thead>
                        <th>Terms</th>
                        <th>Due Date</th>
                        <th>Monthly Ammortization</th>
                        <th>Price</th>
                    </thead>
                    <tbody>'; 
                       $html .= '<tr>                
                                 <td>'.$loan['terms'].'</td>
                                 <td>'.$loan['due_date'].'</td>
                                 <td>₱ '.number_format(($loan['monthly']), 2, '.', ',').'</td>
                                 <td>₱ '.number_format(($loan['price']), 2, '.', ',').'</td>
                                 </tr>';                 
                    $html .= '</tbody>

                </table>
               </div>
            </div>
            <label for=""><strong>Warranty</strong></label>
            <div class="row">
            <div class="col">
                   <table class="table table-bordered">
                    <thead>
                        <th>Motor Warranty Start Date</th>
                        <th>Motor Warranty End Date</th>

                    </thead>
                    <tbody>'; 
                    $html .= '<tr>                
                                <td>'.$loan['warranty_start'].'</td>
                                <td>'.$loan['motor_warranty_end'].'</td>
                                </tr>';                 
                    $html .= '</tbody>

                   </table>
                </div>
                <div class="col">
                       <table class="table table-bordered">
                        <thead>
                            <th>Service Warranty Start Date</th>
                            <th>Service Warranty End Date</th>
    
                        </thead>
                        <tbody>'; 
                        $html .= '<tr>                
                                    <td>'.$loan['warranty_start'].'</td>
                                    <td>'.$loan['service_warranty_end'].'</td>
                                    </tr>';                 
                        $html .= '</tbody>
    
                       </table>
                    </div>
            </div>
        </div>
        </body>
        </html>';
        echo $html;

}

public function print_online($id){
    if($id){
        $company = $this->Admin_Company_Model->getCompanyData();
        $sales = $this->Admin_Receipt_Model->getSalesData($id);
        $customer = $this->Admin_Receipt_Model->getCustomerData($sales['customer_id']);
        $order =  $this->Admin_Receipt_Model->getOrderData($id);
        $items =  $this->Admin_Receipt_Model->getSalesItemData($order['id']);
    
// onload="window.print()"
            $html = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>

                <link rel="stylesheet" href="'.base_url('assets/bootstrap/css/bootstrap.min.css').'" >
            </head>
            <body onload="window.print()">
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
                <div class="col col-sm-12 col-md-4 col-lg-4">
                    <table class="table table-sm table-borderless">
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Customer:</p></td><td class=" tData text-capitalize">'.$customer['customer_firstname'].' '.$customer['customer_lastname'] .'</td>
                        </tr>
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Contact:</p></td><td class=" tData text-capitalize">'.$customer['customer_contact'].'</td>
                        </tr>
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Email:</p></td><td class=" tData ">'.$customer['customer_email'].'</td>
                        </tr>
                        <tr>
                            <td class="tdWidth"><p class=" tLabel font-weight-bold">Address:</p></td><td class=" tData text-capitalize">'.$customer['customer_street'].' '.$customer['customer_subdivision'].' '.$customer['customer_barangay'].'</td>
                        </tr>
                        <tr>
                            <td class="tdWidth"></td><td class=" tData text-capitalize">'.$customer['customer_city'].' '.$customer['customer_province'].'</td>
                        </tr>
                    </table>
                </div>
                <div class="col col-sm-12 col-md-4 col-lg-4">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="tdWidth"><p class=" tLabel font-weight-bold">Reference Number:</p></td><td class=" tData text-capitalize">' .$sales['ref_no'].'</td>
                        </tr>
                        <tr>
                            <td class="tdWidth"><p class=" tLabel font-weight-bold">Sales Date:</p></td><td class=" tData text-capitalize">'.$sales['sales_date'].'</td>
                        </tr>
                    </table>
                </div>
                <div class="col col-sm-12 col-md-4 col-lg-4">
                    <table class="table table-sm table-borderless">
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Order ID</p></td><td class=" tData text-capitalize">'.$order['id'].'</td>
                        </tr>
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Receipt ID:</p></td><td class=" tData text-capitalize ">' .$sales['id'].'</td>
                        </tr>
                        <tr>
                           <td class="tdWidth"><p class=" tLabel font-weight-bold">Receipt Date:</p></td><td class=" tData text-capitalize">'.date('M d, Y').'</td>
                        </tr>
                    </table>
                </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead>
                                <th>Name</th>
                                <th>qty</th>
                                <th>price</th>
                                <th>Total Amount</th>
                            </thead>
                            <tbody>'; 

                            foreach($items as $item) {    
                                
                                // $stock = $this->Admin_Spareparts_Model->getStockData($item['product_id']);
                                // $data =$this->Admin_Spareparts_Model->getSparepartsData($stock['parts_id']);
                                
                                $html .= '<tr>
                                <td>'.$item['product_name'].'</td>
                                <td>'.$item['order_quantity'].'</td>
                                <td>'.$item['price'].'</td>
                                <td>'.$item['order_subtotal'].'</td>
                                </tr>';
                            } 
                            $html .=' <tr>
                            <th class="text-right" colspan="3">Total</th><th>'.$sales['total_amount'].'</th>
                            </tr> 
                            <tr>
                                <th class="text-right" colspan="3">Amount Tendered</th><th>'.$sales['total_amount'].'</th>
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