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

  public function projects($param = "")
  {
    // detail project
    if (isset($_GET['project']) && !$param) {
      $project = $this->project_model->get_data([
        "user_id" => $this->session->userdata('id'),
        "slug" => $_GET['project']
      ]);

      $users = $this->user_model->get_all_data(["id " . "!=" => $this->session->userdata('id')]);

      $team = $this->team_model->get_data([
        "project_id" => isset($project['data']) ? $project['data']->id : ""
      ]);

      $team_members = $this->teammembers_model->get_all_data([
        "team_id" => $team['is_success'] ? $team['data']->id : null,
      ]);

      $team_member_user = array();
      foreach ($team_members['data'] as $member) {
        $user = $this->user_model->get_data(["id" => $member->user_id]);
        array_unshift($team_member_user, $user['data']->name);
      }
      log_message('debug', 'team_member_user: ' . json_encode($team_member_user));

      return $this->load->view("layouts/dashboard/dashboard_layout", [
        "page_info" => array(
          'page' => 'dashboard_project',
          "title" => $project['is_success'] ? $project['data']->name : $project['message']
        ),
        "validation_errors" => $this->session->flashdata("validation_errors"),
        "set_value" => $this->session->flashdata("set_value"),
        "project" => $project['is_success'] ? $project['data'] : null,
        "team" => $team['is_success'] ? $team['data'] : null,
        "team_members" => count($team_member_user) ? $team_member_user : null,
        "notes" => null,
        "users" => $users['data']
      ]);
    }

    // add project
    if ($param) {
      return $this->load->view("layouts/dashboard/dashboard_layout", [
        "page_info" => array(
          'page' => 'dashboard_add_project',
          "title" => "Add Project"
        ),
        "validation_errors" => $this->session->flashdata("validation_errors"),
        "set_value" => $this->session->flashdata("set_value")
      ]);
    }

    // projects
    $projects = $this->project_model->get_all_data(
      ['user_id' => $this->session->userdata('id')]
    );

    return $this->load->view("layouts/dashboard/dashboard_layout", [
      "page_info" => [
        "page" => "dashboard_projects",
        "title" => "Projects"
      ],
      "projects" => isset($projects['data']) ? $projects['data'] : []
    ]);
  }
}
