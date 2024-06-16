<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('middlewares/AuthMiddleware');

    $this->authmiddleware->is_signin($this->session);
  }

  public function index()
  {
    return $this->load->view("layouts/dashboard/dashboard_layout", [
      "page_info" => [
        "page" => "dashboard_main",
        "title" => "Dashboard"
      ]
    ]);
  }

  public function projects()
  {
    return $this->load->view("layouts/dashboard/dashboard_layout", [
      "page_info" => [
        "page" => "dashboard_projects",
        "title" => "Projects"
      ]
    ]);
  }
}
