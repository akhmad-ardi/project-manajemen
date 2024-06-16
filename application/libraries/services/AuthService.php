<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthService
{
  public function sign_up_form($input, $form_validation, $user_model)
  {
    try {
      $form_validation->set_rules('username', 'Username', ['required']);
      $form_validation->set_rules('email', 'Email', ['required', 'valid_email', 'is_unique[user.email]']);
      $form_validation->set_rules('password', 'Password', ['required', 'min_length[6]']);
      $form_validation->set_rules('confirm_password', 'Confirm Password', ['required', 'min_length[6]', 'matches[password]']);

      if (!$form_validation->run())
        throw new Exception("validation fail", 400);

      $create_data = $user_model->create_data([
        "name" => $input->post('username'),
        "email" => $input->post('email'),
        "password" => password_hash($input->post('password'), PASSWORD_BCRYPT)
      ]);
      if (!$create_data['is_success'])
        throw new Exception($create_data['message']);

      return array("is_success" => TRUE);
    } catch (Exception $e) {
      log_message('error', $e->getMessage());

      return array(
        "is_success" => FALSE,
        "validation_errors" => $form_validation->error_array()
      );
    }
  }

  public function sign_in_form($input, $form_validation, $user_model)
  {
    try {
      $form_validation->set_rules('email', 'Email', ['required', 'valid_email']);
      $form_validation->set_rules('password', 'Password', ['required', 'min_length[6]']);

      if (!$form_validation->run())
        throw new Exception("validation fail", 400);

      $user = $user_model->get_data(["email" => $input->post('email')]);
      if (!$user['is_success'])
        throw new InvalidArgumentException($user['message'], 404);

      if (!password_verify($input->post('password'), $user['data']->password))
        throw new InvalidArgumentException("Username or Password is wrong");

      return ['is_success' => TRUE, 'id' => $user['data']->id];
    } catch (InvalidArgumentException $e) {
      log_message('error', $e->getMessage());

      return array(
        "is_success" => FALSE,
        "validation_errors" => ["signin_error" => $e->getMessage()]
      );
    } catch (Exception $e) {
      log_message('error', $e->getMessage());

      return array(
        "is_success" => FALSE,
        "validation_errors" => $form_validation->error_array()
      );
    }
  }
}