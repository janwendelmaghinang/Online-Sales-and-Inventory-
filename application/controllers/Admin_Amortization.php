<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Amortization extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Admin_Amortization_Model');
        $this->load->Model('Admin_Spareparts_Model');
        $this->load->Model('Admin_Customer_Model');
        $this->load->Model('Admin_Color_Model');
        $this->load->Model('Admin_Model_Model');
        $this->load->Model('Admin_Company_Model');
        $this->load->Model('Admin_Pos_Model');
        $this->load->Model('Admin_Installment_Model');
        date_default_timezone_set("Asia/Manila");
    }

    public function index()
	{
        $data['pastdue'] = count($this->Admin_Amortization_Model->getInstallmentReleased(3, 3));
        $data['pages'] = 'amortization/amortization';
        $this->load->view('admin/layout/templates',$data);
    }
    
    public function fetchAmortization(){
        $result = array('data' => array());

        $loan = $this->Admin_Amortization_Model->getInstallmentReleased(3, 2);
      
        foreach($loan as $key=>$value){
            
         $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);
         $dueDate = $this->Admin_Amortization_Model->getSchedDueDate($value['id']);
         
          $status = '';
         if($dueDate['due_date'] == 1){
            $status = '<span class=" badge badge-warning">Due Date</span>';
         }
         if($value['paid_status'] == 2){
            $status2 = '<span class=" badge badge-success">Still Paying</span>';
         }

         $buttons = '';
            $buttons .= '<a class="btn btn-outline-dark" href="'.base_url('Admin_Amortization/monthly_schedule/'.$value['id'].'').'">View</a>';	
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="disapproved('.$value['id'].')" data-toggle="modal" data-target="#disapprovedModal">Disapproved</button>';
    
        $result['data'][$key] = array(
            $value['ebike_name'],
            $value['ebike_color'],
            $customer['customer_firstname'].' '.$customer['customer_lastname'] ,
            $dueDate['date'],
            $status2.'<br>'.$status,
            $buttons
            );
        }
        echo json_encode($result);
    }

    public function monthly_schedule($id = null)
	{
        if($id){

        }
        else
        {
            redirect(base_url('Admin_Amortization'));
        }

       
        $data['application'] = $this->Admin_Amortization_Model->getInstallmentDataById($id);
        $data['sched'] = $this->Admin_Amortization_Model->getSched($id);
        $data['customer'] = $this->Admin_Customer_Model->getCustomerData($data['application']['customer_id']);
        $data['pages'] = 'amortization/monthly';
        $this->load->view('admin/layout/templates',$data);
    } 

    public function fetchSched($id = null ){
        $result = array('data' => array());

        $sched = $this->Admin_Amortization_Model->getSchedData($id);
        $p = 1;
        foreach($sched as $key=>$value){

        $payBtn = '';
        if($value['payBtn'] == 1){
           $payBtn = '';
        }
        else
        {
            $payBtn = 'disabled';
        }

         $buttons = '';
            $buttons .= '<button '.$payBtn.' type="button" class="btn btn-outline-dark" onclick="paynow('.$value['id'].')" data-toggle="modal" data-target="#paymentModal">Pay Now</button>';	
            // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="disapproved('.$value['id'].')" data-toggle="modal" data-target="#disapprovedModal">Disapproved</button>';
            $status = ($value['paid'] == 1) ? '<span class="badge badge-success">Paid</span>' : '<span class="badge badge-warning">Unpaid</span>';
       
        $dueDate = '';
        if($value['due_date'] == 1){
           $dueDate = '<span class=" badge badge-warning">Due Date</span>';
        }
        if($value['due_date'] == 2){
            $dueDate = '<span class=" badge badge-danger">Past Due</span>';
         }

        $result['data'][$key] = array(
            $p,
            $value['date'].'<br>'. $dueDate,
             '₱ '.number_format(($value['beginning_balance']), 2, '.', ','),
             '₱ '.number_format(($value['principal']), 2, '.', ','),
             '₱ '.number_format(($value['interest']), 2, '.', ','),
             '₱ '.number_format(($value['penalty']), 2, '.', ','),
             '₱ '.number_format(($value['total_payment_due']), 2, '.', ','),
             '₱ '.number_format(($value['total_payment']), 2, '.', ','),
             '₱ '.number_format(($value['ending_balance']), 2, '.', ','),
            $value['date_paid'],
            $status,
            $buttons
            );
            $p++;
        }
        echo json_encode($result);
    }

    public function update_due(){
        $response = array();
              // update due date
              $penalty = $this->Admin_Amortization_Model->getPenaltyData();

              $sched = $this->Admin_Amortization_Model->getAllSchedData();

              foreach($sched as $value){
              if($value['paid'] == 0 ){

                $date1 = strtotime($value['date']);
                $date2 = strtotime(date("M d, Y")) ;//this gives current time
                $secs = $date1 - $date2 ;
                $days = $secs / 86400;
                // $noOfDays = $diff->format("%a days");
    
                if($days == 0 && $value['due_date'] == 0){

                    $data = array(
                        'due_date' => 1,
                        // 'date_paid' => '<span class=" badge badge-warning">Due Date</span>'
                     );
                     $this->Admin_Amortization_Model->update_due_date($data, $value['id']);
                }
                if($days < 0){
                     $sum = ($value['principal'] + $value['interest']);
                     $total_penalty = ($sum * $penalty['penalty_percentage'])/100;

                    // update to past due loan sched
                    $data = array(
                       'due_date' => 2,
                       'penalty' => $total_penalty,
                       'total_payment_due' => ($total_penalty + $sum)
                    //    'date_paid' => '<span class=" badge badge-danger">Past Due</span>'
                    );
                    $this->Admin_Amortization_Model->update_due_date($data, $value['id']);
                    // update to past due application tbl
                    $ps = array(
                        'paid_status' => 3
                    );
                    $this->Admin_Amortization_Model->update($ps, $value['application_id']);
                }
            }
        }   
        echo json_encode($response); 
    }

    public function payment_update($id = null){
        $response = array();
        // $pHidden = $this->input->post('paymentValueHidden');
        $data = array(
            'total_payment' => $this->input->post('paymentValue'),
            'ending_balance' => $this->input->post('ending_balanced'),
            'beginning_balance' => $this->input->post('beginning_balanced'),
            'date_paid' => date('M d, Y'),
            'paid' => 1,
            'payBtn' => 0
        );

        $update = $this->Admin_Amortization_Model->payment_update($data, $id);
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

    public function pastdue()
	{
        $data['pastdue'] = count($this->Admin_Amortization_Model->getInstallmentReleased(3, 3));
        $data['pages'] = 'amortization/pastdue';
        $this->load->view('admin/layout/templates',$data);
    }

    public function fetchAmortizationPastDue(){
        $result = array('data' => array());

        $loan = $this->Admin_Amortization_Model->getInstallmentReleased(3, 3);
      
        foreach($loan as $key=>$value){
            
         $customer = $this->Admin_Customer_Model->getCustomerData($value['customer_id']);
         $dueDate = $this->Admin_Amortization_Model->getSchedDueDate($value['id']);
         
          $status = '';

         if($value['paid_status'] == 3){
            $status = '<span class=" badge badge-danger">Past Due</span>';
         }

         $buttons = '';
            $buttons .= '<a class="btn btn-outline-dark" href="'.base_url('Admin_Amortization/monthly_schedule/'.$value['id'].'').'">View</a>';	
            $buttons .= '<button type="button" class="btn btn-outline-dark " onclick="pullout('.$value['id'].')" data-toggle="modal" data-target="#pulloutModal">Pull Out</button>';
    
        $result['data'][$key] = array(
            $value['ebike_name'],
            $value['ebike_color'],
            $customer['customer_firstname'].' '.$customer['customer_lastname'] ,
            $dueDate['date'],
            $status,
            $buttons
            );
        }
        echo json_encode($result);
    }

    public function pullout(){
        $id = $this->input->post('id');
        $response = array();

        if($id){
            $data = array(
               'paid_status' => 4,
               'pullout_status' => 1
            );
            $update = $this->Admin_Amortization_Model->pullout($data, $id);
            if($update){
                $response['success'] == true;
            }
            else 
            {
                $response['success'] == false;
            }
        }
        else
        {
            $response['success'] == false;
        }

        echo json_encode($response);
    }

    public function getLoanSchedById(){
        $response = array();
        $id = $this->input->post('id');
        $sched = $this->Admin_Amortization_Model->getLoanSched($id);
        $response = $sched;
        echo json_encode($response);
    }

}