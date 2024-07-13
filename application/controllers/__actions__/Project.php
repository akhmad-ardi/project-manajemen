<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("middlewares/AuthMiddleware");

		$this->authmiddleware->is_signin($this->session);
	}

	public function add()
	{
		$this->validate_method("post");

		try {
			if (!$this->validation_input())
				throw new Exception("validation error");

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
				$this->session->set_flashdata("validation_add_project_errors", $this->form_validation->error_array());

			if ($e->getCode() == 400)
				$this->session->set_flashdata("validation_add_project_errors", ["error_add_project" => $e->getMessage()]);
			else if ($e->getCode() == 404)
				return redirect(base_url() . 'dashboard/projects?project=project-not-found');


			$this->session->set_flashdata("set_add_project_value", [
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
		$this->validate_method("post", "patch");

		try {
			if (!$this->validation_input())
				throw new Exception("validation error", 400);

			return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
		} catch (Exception $e) {
			log_message("error", "project " . $e->getMessage());

			$validation_errors = $this->form_validation->error_array();
			if (count($validation_errors))
				$this->session->set_flashdata("validation_edit_project_errors", $validation_errors);

			$this->session->set_flashdata("set_edit_project_value", [
				'name' => set_value('name'),
				'description' => set_value('description'),
				'start_date' => set_value('start_date'),
				'finish_date' => set_value('finish_date')
			]);
			log_message("debug", 'start_date: ' . set_value('start_date'));

			return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
		}
	}

	public function delete()
	{
		$this->validate_method("post", "delete");

		try {
			$project = $this->project_model->get_data(["id" => $this->input->post("project_id")]);
			if (!$project['is_success'])
				throw new Exception($project['message']);

			$note = $this->note_model->get_data(["project_id" => $project['data']->id]);
			if ($note['is_success'])
				$this->note_model->delete_data(["project_id" => $note['data']->project_id]);

			$team = $this->team_model->get_data(["project_id" => $project['data']->id]);
			if ($team['is_success']) {
				$this->teammembers_model->delete_data(["team_id" => $team['data']->id]);
				$this->team_model->delete_data(["project_id" => $team["data"]->project_id]);
			}

			$tasks = $this->task_model->get_all_data(["project_id" => $project['data']->id]);
			if ($tasks['is_success'])
				$this->task_model->delete_data(["project_id" => $project['data']->id]);

			$this->project_model->delete_data(["id" => $project['data']->id]);
			return redirect(base_url() . 'dashboard/projects');
		} catch (Exception $e) {
			log_message("error", $e->getMessage());

			return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
		}
	}

	private function validate_method($method, $_method = null)
	{
		if ($this->input->method() != $method || (isset($_method) && $this->input->post("_method") != $_method))
			return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
	}

	private function validation_input()
	{
		$this->form_validation->set_rules('name', 'Name Project', ['required']);
		$this->form_validation->set_rules('description', 'Description Project', ['required']);
		$this->form_validation->set_rules('start_date', 'Start Date', ['required']);
		$this->form_validation->set_rules('finish_date', 'Finish Date', ['required']);

		return $this->form_validation->run();
	}
}
