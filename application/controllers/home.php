<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
            // Reset user NSI
            $this->session->unset_userdata('user_nsi');
            $this->session->set_userdata('user_nsi', FALSE);
            $data = array(
                'title' => 'Exam Results',
                'mDescription' => '',
                'mKeywords' => '',
            );
		$this->load->view('vheader',$data);
                $this->load->view('vhome');
                
//        $this->load->library('encrypt');
//        $msg = 'My secret message';
//        $encrypted_string = $this->encrypt->encode($msg);
//        echo $encrypted_string;
//        echo $this->encrypt->decode($encrypted_string);
	}
}
