<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthMiddleware
{
  public function is_signin($session)
  {
    if (!$session->userdata('is_signin')) {
      return redirect(base_url() . 'auth/signin');
    }
  }

  // this function for signin and signup
  public function signed($session)
  {
    if ($session->userdata('is_signin'))
      return redirect(base_url() . 'dashboard');
  }
}
