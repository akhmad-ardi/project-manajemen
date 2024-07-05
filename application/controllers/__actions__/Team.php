<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library("middlewares/AuthMiddleware");

    if ($this->authmiddleware->is_signin($this->session))
      redirect(base_url() . 'dashboard');

    if ($this->input->method() != "post")
      redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
  }

  public function add()
  {
    try {
      $this->form_validation->set_rules('project_id', 'Project ID', ['required']);
      $this->form_validation->set_rules('name', 'Name Team', ['required']);
      $this->form_validation->set_rules('list_team_members[]', 'Team Member', 'required', [
        'required' => 'Please Choose User for Your Team Member'
      ]);

      if (!$this->form_validation->run())
        throw new Exception("validation error", 400);

      $create_team = $this->team_model->create_data([
        "name" => $this->input->post('name'),
        "project_id" => $this->input->post('project_id')
      ]);
      if (!$create_team['is_success'])
        throw new Exception($create_team['message'], 401);

      $team = $this->team_model->get_data(["project_id" => $this->input->post('project_id')]);
      if (!$create_team['is_success'])
        throw new Exception($team['message'], 402);

      for ($i = 0; $i < count($this->input->post('list_team_members')); $i++) {
        $user = $this->user_model->get_data(["email" => $this->input->post('list_team_members')[$i]]);
        $this->teammembers_model->create_data([
          "team_id" => $team['data']->id,
          "user_id" => $user['data']->id
        ]);
      }

      return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      if (count($this->form_validation->error_array()) && $e->getCode() == 400) {
        $this->session->set_flashdata('validation_errors', $this->form_validation->error_array());
        $this->session->set_flashdata('set_value', [
          "name" => set_value('name'),
          "list_team_members" => set_value('list_team_members')
        ]);
      }

      if ($e->getCode() == 401 || $e->getCode() == 402)
        $this->session->set_flashdata('validation_errors', ["team" => $e->getMessage()]);

      return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
    }
  }
}
