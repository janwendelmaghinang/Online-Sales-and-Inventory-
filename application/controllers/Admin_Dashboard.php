<?php

class Admin_Dashboard extends CI_Controller{
    public function __construct()
      {
        parent:: __construct();   
        $this->load->model('Admin_Spareparts_Model');    
        $this->load->model('Admin_Amortization_Model');     
        $this->load->model('Admin_Ebike_Model');       
        $this->load->model('Admin_Model_Model');       
        $this->load->model('Admin_Store_Model');       
        $this->load->model('Admin_Order_Model');       
        $this->load->model('Admin_User_Model');   
        date_default_timezone_set("Asia/Manila");    
      }
    public function index(){
 
      // if($sched1 ==  ){
      //   echo $sched1;
      // }
      // set default timezone
    
      // echo date('d M Y H:i:s');
// //define date and time
// $strtotime = 1307595105;

// // output
// echo date('d M Y H:i:s',$strtotime);

// more formats
// echo date('c',$strtotime); // ISO 8601 format
// echo date('r',$strtotime); // RFC 2822 format

    // $effectiveDate ='';
    // $effectiveDate = date('M d, Y', strtotime("+3 month"));
    // echo $effectiveDate;

        // echo date('d M Y H:i:s', strtotime(''));
    //dateof purchase write it as your variable from db

    // $datetime1 = strtotime('Jan 31, 2022');
    // $datetime2 = strtotime('Jan 30, 2022');
    // $secs = $datetime2 - $datetime1;// == return sec in difference
    // $days = $secs / 86400;
    // echo $days;
     
      // $date1 = date_create('Jan 31, 2022');
      // // $date1=date_create(date("Y-m-d", strtotime("+1 month")) );//   this is your warranty time after 2 years
      // $date2 = date_create(date("M d, Y")) ;//this gives current time
      // $diff = date_diff($date1,$date2);
      // $noOfDays = $diff->format("%a");
      // echo $noOfDays;
  
      // if($diff->format("%a") < 0 ){
      //   echo ' past due';
      // }
      // if($diff->format("%a") == 0 ){
      //   echo ' Due date';
      // }

      // $random = time() . rand(10*45, 100*98);
      // echo $random;
      
      // $random = round(microtime(true) * 1000);
      // echo $random;

      // print_r($this->session->userdata());
    //   if(!$this->session->userdata('admin_in')){
    //     $this->session->set_flashdata('not_logged_in');
    //     redirect(base_url('admin'));
    // }$this->Admin_Spareparts_Model->getSparepartsByModel(0)

        // $sample = $this->Admin_Ebike_Model->getProductionData(1);
        // if(!count($sample) == 0){
        //   for($i = 0; $i < count($sample); $i++ ){
        //      if($sample[$i]['set_serial'] == 0){
        //         // disable button
        //      }
        //   }
        // }
        // else
        // {
        //   // disavle na dito
        // }

        if(!$this->session->userdata('userLogged_in')){
          redirect(base_url('Admin'));
        }
        $data['users'] =  count($this->Admin_User_Model->getUserData());  
        $data['order_preparing'] = count($this->Admin_Order_Model->getOrderByStatusData(1));
        $data['order_ready'] = count($this->Admin_Order_Model->getOrderByStatusData(2));
        $data['order_completed'] = count($this->Admin_Order_Model->getOrderByStatusData(3));
        $data['models'] =  count($this->Admin_Model_Model->getModelData());  
        $data['stores'] =  count($this->Admin_Store_Model->getStoreData());
        $data['spareparts'] =  count($this->Admin_Spareparts_Model->getSparepartsData());
        $data['pages'] = 'dashboard';
        $this->load->view('admin/layout/templates',$data);
    }
}