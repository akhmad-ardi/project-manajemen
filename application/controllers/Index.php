<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
	public function index()
	{
		$this->load->view('layouts/main/main_layout', ['is_signin' => $this->session->userdata('is_signin') ?? false]);
	}
}
