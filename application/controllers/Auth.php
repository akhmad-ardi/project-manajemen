<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('middlewares/AuthMiddleware');
  }

  public function index()
  {
    $this->authmiddleware->signed($this->session);

    redirect(base_url() . "auth/signin");
  }

  public function signup()
  {
    $this->authmiddleware->signed($this->session);

    return $this->load->view("layouts/auth/auth_layout", [
      "page_info" => array(
        "page" => "pages/auth/signup_page",
        "title" => "Sign Up"
      ),
      "validation_errors" => $this->session->flashdata("validation_errors"),
      "set_value" => $this->session->flashdata("set_value")
    ]);
  }

  public function signin()
  {
    $this->authmiddleware->signed($this->session);

    return $this->load->view("layouts/auth/auth_layout", [
      "page_info" => array(
        "page" => "pages/auth/signin_page",
        "title" => "Sign In"
      ),
      "validation_errors" => $this->session->flashdata("validation_errors"),
      "set_value" => $this->session->flashdata("set_value")
    ]);
  }
}