<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('services/AuthService');
    $this->load->library('middlewares/AuthMiddleware');

    if ($this->input->method() != "post")
      redirect(base_url() . "dashboard");
  }

  public function signin()
  {
    if ($this->authmiddleware->signed($this->session))
      return redirect(base_url() . 'dashboard');

    $sign_in = $this->authservice->sign_in_form($this->input, $this->form_validation, $this->user_model);

    if (!$sign_in['is_success']) {
      $this->session->set_flashdata("validation_errors", $sign_in['validation_errors']);
      $this->session->set_flashdata("set_value", [
        'email' => set_value('email')
      ]);

      return redirect(base_url() . "auth/signin");
    }

    $this->session->set_userdata([
      "id" => $sign_in['id'],
      "is_signin" => TRUE
    ]);
    return redirect(base_url() . "dashboard");
  }

  public function signup()
  {
    if ($this->authmiddleware->signed($this->session))
      return redirect(base_url() . 'dashboard');

    $sign_up = $this->authservice->sign_up_form($this->input, $this->form_validation, $this->user_model);

    if (!$sign_up['is_success']) {
      $this->session->set_flashdata("validation_errors", $sign_up['validation_errors']);
      $this->session->set_flashdata("set_value", [
        'username' => set_value('username'),
        'email' => set_value('email')
      ]);

      return redirect(base_url() . "auth/signup");
    }

    return redirect(base_url() . "auth/signin");
  }

  public function signout()
  {
    if ($this->input->post('_method') != 'delete')
      return redirect(base_url() . "dashboard");

    $this->session->sess_destroy();
    return redirect(base_url() . "auth/signin");
  }
}