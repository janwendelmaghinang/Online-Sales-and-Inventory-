<?php

class Email extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('form');
    }

    // public function index() {


    //     // $this->load->view('email_form');
    // }

    public function sendmail() {
        
        $email = $this->input->post('email');
        $message = $this->input->post('message');
        $subject = $this->input->post('subject');
        
        $from_email = "maghinangjanwendel.pdm@gmail.com";
        $to_email = $email;

        //Load email library 
        $this->load->library('email');

        $this->email->from($from_email, 'Your Name');
        $this->email->to($to_email);
        $this->email->subject($subject);
        // $this->email->message($message);
                $this->email->set_alt_message(
            `
            <table border="0" cellpadding="0" cellspacing="0" align="center" width="600" style="border-collapse:collapse;border-spacing:0;padding:0;width:inherit;max-width:600px;border-radius:3px;border-spacing:0;background:#f7f7fd;margin:19px 8px 0 8px">
                            <tbody>
            
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;border-spacing:0;margin:0;padding:0;padding-left:4.25%;padding-right:4.25%;width:100%;font-size:24px;font-weight:bold;line-height:130%;padding-top:0px;color:#001133;background:#fff;font-family:Arial,sans-serif">
                                    <p style="border-top:1px solid #e1e1ec;margin:0"></p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;border-spacing:0;margin:0;padding:0;padding-left:4.25%;padding-right:4.25%;width:100%;font-size:24px;font-weight:bold;line-height:130%;padding-top:40px;color:#001133;background:#fff;font-family:Arial,sans-serif">
                                    You're all set!
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;border-spacing:0;margin:0;padding:0;padding-bottom:20px;padding-left:4.25%;padding-right:4.25%;width:87.5%;font-size:16px;line-height:24px;padding-top:24px;background:#fff;color:#333c4d;font-family:Arial,sans-serif">
                                    Dear hi Member,
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="border-collapse:collapse;border-spacing:0;margin:0;padding:0;padding-bottom:24px;padding-left:4.25%;padding-right:4.25%;width:87.5%;background:#fff;font-size:16px;line-height:24px;color:#333c4d;font-family:Arial,sans-serif">
                                    Your identity verification has been successfully completed. Thank you for your time!
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="text-align:left;background:#fff;border-bottom-left-radius:8px;border-bottom-right-radius:8px;padding-bottom:30px">
                                    
                                    <div style="color:#333c4d;text-decoration:none;font-size:16px;line-height:24px;padding:0 42px;margin-top:0px;line-height:22px;background:#fff;font-family:Arial,sans-serif">
                                        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="text-align:left;background:#fff;border-bottom-left-radius:8px;border-bottom-right-radius:8px">
                                    <div style="color:#333c4d;text-decoration:none;font-size:16px;line-height:24px;padding:0 42px;margin-bottom:0;background:#fff;margin-top:0px;line-height:22px;font-family:Arial,sans-serif">
                                        Let's get hi together!
                                    </div>
                                    <div style="color:#333c4d;text-decoration:none;font-size:16px;line-height:24px;padding:0 42px;margin-bottom:30px;margin-top:5px;line-height:22px;font-family:Arial,sans-serif">
                                        The hi Team
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="text-align:center;border-radius:8px">
                                    <div style="font-family:Arial,sans-serif;font-size:12px;color:rgba(4,29,47,0.6);margin-top:20px;padding:0 42px;line-height:18px;text-align:center;margin-bottom:28px">
                                        Copyright © 2021 hi.<br>
                                        All rights reserved.
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>`
        );


        //Send mail 
        if ($this->email->send())
            $this->session->set_flashdata("email_sent", "Email sent successfully.");
        else
            $this->session->set_flashdata("email_sent", "Error in sending Email.");
        $this->load->view('email_form');
    }

}

?>