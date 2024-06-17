<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('middlewares/AuthMiddleware');

    if ($this->input->method() != "post")
      redirect(base_url() . "dashboard");
  }

  public function signin()
  {
    if ($this->authmiddleware->signed($this->session))
      return redirect(base_url() . 'dashboard');

    try {
      $this->form_validation->set_rules('email', 'Email', ['required', 'valid_email']);
      $this->form_validation->set_rules('password', 'Password', ['required', 'min_length[6]']);

      if (!$this->form_validation->run())
        throw new Exception("validation fail", 400);

      $user = $this->user_model->get_data(["email" => $this->input->post('email')]);
      if (!$user['is_success'])
        throw new InvalidArgumentException($user['message'], 404);

      if (!password_verify($this->input->post('password'), $user['data']->password))
        throw new InvalidArgumentException("Username or Password is wrong");

      $this->session->set_userdata(["id" => $user['data']->id, "is_signin" => TRUE]);

      return redirect(base_url() . "dashboard");
    } catch (InvalidArgumentException $e) {
      log_message('error', $e->getMessage());
      $this->session->set_flashdata("validation_errors", ["signin_error" => $e->getMessage()]);

      return redirect(base_url() . "auth/signin");
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      $this->session->set_flashdata("validation_errors", $this->form_validation->error_array());
      $this->session->set_flashdata("set_value", ['email' => set_value('email')]);

      return redirect(base_url() . "auth/signin");
    }
  }

  public function signup()
  {
    if ($this->authmiddleware->signed($this->session))
      return redirect(base_url() . 'dashboard');

    try {
      $this->form_validation->set_rules('username', 'Username', ['required']);
      $this->form_validation->set_rules('email', 'Email', ['required', 'valid_email', 'is_unique[user.email]']);
      $this->form_validation->set_rules('password', 'Password', ['required', 'min_length[6]']);
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', ['required', 'min_length[6]', 'matches[password]']);

      if (!$this->form_validation->run())
        throw new Exception("validation fail", 400);

      $create_data = $this->user_model->create_data([
        "name" => $this->input->post('username'),
        "email" => $this->input->post('email'),
        "password" => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
      ]);
      if (!$create_data['is_success'])
        throw new Exception($create_data['message']);

      return redirect(base_url() . "auth/signin");
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      $this->session->set_flashdata("validation_errors", $this->form_validation->error_array());
      $this->session->set_flashdata("set_value", [
        'username' => set_value('username'),
        'email' => set_value('email')
      ]);

      return redirect(base_url() . "auth/signup");
    }
  }

  public function signout()
  {
    if ($this->input->post('_method') != 'delete')
      return redirect(base_url() . "dashboard");

    $this->session->sess_destroy();
    return redirect(base_url() . "auth/signin");
  }
}