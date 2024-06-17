<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library("middlewares/AuthMiddleware");

    if ($this->authmiddleware->is_signin($this->session))
      redirect(base_url() . 'dashboard');
  }

  public function add()
  {
    try {
      $this->form_validation->set_rules('name', 'Name Project', ['required']);
      $this->form_validation->set_rules('description', 'Description Project', ['required']);
      $this->form_validation->set_rules('start_date', 'Start Date', ['required']);
      $this->form_validation->set_rules('finish_date', 'Finish Date', ['required']);

      if (!$this->form_validation->run())
        throw new Exception("validation fail");

      $slug_project = slugify($this->input->post('name'));

      $data = array(
        "user_id" => $this->session->userdata('id'),
        "name" => $this->input->post('name'),
        "slug" => $slug_project,
        "description" => $this->input->post('description'),
        "start_date" => $this->input->post('start_date'),
        "finish_date" => $this->input->post('finish_date')
      );

      $create_project = $this->project_model->create_data($data);
      if (!$create_project['is_success'])
        throw new Exception($create_project['message'], 400);

      $get_project = $this->project_model->get_data(["slug" => $slug_project]);
      if (!$get_project['is_success'])
        throw new Exception($get_project['message'], 404);

      return redirect(base_url() . 'dashboard/projects?project=' . $get_project['data']->slug);
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      if (count($this->form_validation->error_array()))
        $this->session->set_flashdata("validation_errors", $this->form_validation->error_array());

      if ($e->getCode() == 400)
        $this->session->set_flashdata("validation_errors", ["error_add_project" => $e->getMessage()]);
      else if ($e->getCode() == 404)
        return redirect(base_url() . 'dashboard/projects?project=project-not-found');


      $this->session->set_flashdata("set_value", [
        'name' => set_value('name'),
        'description' => set_value('description'),
        'start_date' => set_value('start_date'),
        'finish_date' => set_value('finish_date')
      ]);

      return redirect(base_url() . 'dashboard/projects/add');
    }
  }

  public function update()
  {

  }
}
