<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('middlewares/AuthMiddleware');

		$this->authmiddleware->is_signin($this->session);
	}

	public function add()
	{
		$this->validate_method('post');

		try {
			$this->form_validation->set_rules('project_id', 'Project ID', ['required']);

			if (!$this->validate_input())
				throw new Exception('validation error', 400);

			$create_task = $this->task_model->create_data([
				'project_id' => $this->input->post('project_id'),
				'name' => $this->input->post('name'),
				'start_date' => $this->input->post('start_date'),
				'finish_date' => $this->input->post('finish_date'),
			]);
			if (!$create_task['is_success'])
				throw new Exception($create_task['message'], 401);

			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					'is_success' => TRUE,
					'message' => 'Add Task Success'
				]));
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			$validation_errors = $this->form_validation->error_array();
			if (count($validation_errors) && $e->getCode() == 400)
				return $this->output->set_content_type('application/json')
					->set_output(json_encode([
						'is_success' => FALSE,
						'validation_errors' => $this->form_validation->error_array()
					]));


			if ($e->getCode() == 401)
				return $this->output->set_content_type('application/json')
					->set_output(json_encode([
						'is_success' => FALSE,
						'validation_errors' => ["message" => $e->getMessage()]
					]));

			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					'is_success' => FALSE,
					'message' => $e->getMessage()
				]));
		}
	}

	public function get_all()
	{
		if ($this->input->method() != 'get')
			return redirect('dashboard/projects?project=' . $_GET['project']);

		try {
			$tasks = $this->task_model->get_all_data(["project_id" => $this->input->get('project_id')]);
			if (!$tasks['is_success'])
				throw new Exception($tasks['message'], 404);

			$team = $this->team_model->get_data(["project_id" => $this->input->get('project_id')]);
			if ($team['is_success'])
				foreach ($tasks['data'] as $task) {
					$task->team_id = $team['data']->id;
				}

			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					"is_success" => TRUE,
					"data" => $tasks["data"]
				]));
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					"is_success" => FALSE,
					"message" => $e->getMessage()
				]));
		}
	}

	public function finish_unfinish()
	{
		$this->validate_method('post');

		try {
			$id_task = json_decode($this->input->raw_input_stream, true)['id_task'];
			$update_task = $this->task_model->finish_unfinish_data($id_task);
			if (!$update_task['is_success'])
				throw new Exception($update_task['message'], 400);

			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					'is_success' => TRUE,
					'message' => 'Update Task Success'
				]));
		} catch (Exception $e) {
			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					'is_success' => TRUE,
					'message' => 'Update Task Unsuccess'
				]));
		}
	}

	public function process()
	{
		$this->validate_method('post');

		try {
			$id_task = json_decode($this->input->raw_input_stream, true)['id_task'];
			$update_task = $this->task_model->process_unprocess_data($id_task);
			if (!$update_task['is_success'])
				throw new Exception($update_task['message'], 400);

			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					'is_success' => TRUE,
					'message' => 'Update Task Success'
				]));
		} catch (Exception $e) {
			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					'is_success' => TRUE,
					'message' => 'Update Task Unsuccess'
				]));
		}
	}

	public function update()
	{
		$this->validate_method("post", "patch");

		try {
			$this->form_validation->set_rules('project_id', 'Project ID', ['required']);
			$this->form_validation->set_rules('task_id', 'Task ID', ['required']);

			if (!$this->validate_input())
				throw new Exception('validation error');

			$task = $this->task_model->get_data(["id" => $this->input->post("task_id")]);
			if (!$task['is_success'])
				throw new Exception($task['message'], 404);

			$update_task = $this->task_model->update_data($task['data']->id, [
				"name" => $this->input->post("name"),
				"start_date" => $this->input->post("start_date"),
				"finish_date" => $this->input->post("finish_date"),
			]);
			if (!$update_task['is_success'])
				throw new Exception($update_task['message'], 500);

			$this->session->set_flashdata("toast_success", "Task updated");
			return redirect(base_url() . "dashboard/task/" . $this->input->post("project_id") . "?id=" . $this->input->post("task_id"));
		} catch (Exception $e) {
			log_message("error", $e->getMessage());
			$validation_errors = $this->form_validation->error_array();
			if (count($validation_errors)) {
				$this->session->set_flashdata("validation_task_edit_errors", $validation_errors);
				$this->session->set_flashdata("set_task_edit_errors", [
					"name" => set_value("name"),
					"start_date" => set_value("start_date"),
					"finish_date" => set_value("finish_date"),
				]);
			}

			if ($e->getCode() >= 400)
				$this->session->set_flashdata("toast_error", "Something error");


			return redirect(base_url() . "dashboard/task/" . $this->input->post("project_id") . "?id=" . $this->input->post("task_id"));
		}
	}

	public function delete()
	{
		$this->validate_method('post');

		try {
			$id_task = json_decode($this->input->raw_input_stream, true)['id_task'];
			$delete_task = $this->task_model->delete_data(["id" => $id_task]);
			if (!$delete_task['is_success'])
				throw new Exception($delete_task['message'], 400);

			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					'is_success' => TRUE,
					'message' => 'Delete Task Success'
				]));
		} catch (Exception $e) {
			return $this->output->set_content_type('application/json')
				->set_output(json_encode([
					'is_success' => TRUE,
					'message' => 'Delete Task Unsuccess'
				]));
		}
	}

	public function validate_method($method = "", $_method = null)
	{
		if ($this->input->method() != $method || (isset($_method) && $this->input->post("_method") != $_method))
			return redirect(base_url() . 'dashboard/projects');
	}

	public function validate_input()
	{
		$this->form_validation->set_rules('name', 'Name Task', ['required']);
		$this->form_validation->set_rules('start_date', 'Start Date', ['required']);
		$this->form_validation->set_rules('finish_date', 'Finish Date', ['required']);

		return $this->form_validation->run();
	}
}
