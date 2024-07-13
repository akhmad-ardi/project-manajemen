<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Note extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("middlewares/AuthMiddleware");

		$this->authmiddleware->is_signin($this->session);

		if ($this->input->method() != "post")
			redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
	}

	public function add()
	{
		try {
			$this->form_validation->set_rules('project_id', 'Project ID', ['required']);
			$this->form_validation->set_rules('title', 'Title Note', ['required']);
			$this->form_validation->set_rules('content', 'Content Note', ['required']);

			if (!$this->form_validation->run())
				throw new Exception('validation error', 400);

			$create_note = $this->note_model->create_data([
				'project_id' => $this->input->post('project_id'),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content')
			]);
			if (!$create_note['is_success'])
				throw new Exception($create_note['message'], 401);

			$this->session->set_flashdata("toast_success", "Note added");
			return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
		} catch (Exception $e) {
			log_message('error', 'Add Note : ' . $e->getMessage());
			$validation_errors = $this->form_validation->error_array();
			if (count($validation_errors) && $e->getCode() == 400) {
				$this->session->set_flashdata('validation_add_note_errors', $this->form_validation->error_array());
				$this->session->set_flashdata('set_add_note_value', [
					'title' => set_value('title'),
					'content' => set_value('content')
				]);
			}

			if ($e->getCode() == 401)
				$this->session->set_flashdata('validation_add_note_errors', ['note' => $e->getMessage()]);

			return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
		}
	}

	public function delete()
	{
		if ($this->input->post('_method') != "delete")
			return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);

		try {
			$this->form_validation->set_rules('project_id', 'Project ID', ['required']);

			if (!$this->form_validation->run())
				throw new Exception('validation error');

			$delete_note = $this->note_model->delete_data(["project_id" => $this->input->post('project_id')]);
			if (!$delete_note['is_success'])
				throw new Exception($delete_note['message'], 404);

			$this->session->set_flashdata('toast_success', 'Note deleted');
			return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
		} catch (Exception $e) {
			log_message('debug', $e->getMessage());

			$validation_error = $this->form_validation->error_array();
			if (isset($validation_error)) {
				$this->session->set_flashdata('validation_errors', $validation_error);
				return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
			}

			if ($e->getCode() >= 400) {
				$this->session->set_flashdata('alert_delete_error', $e->getMessage());
				return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
			}

			return redirect(base_url() . 'dashboard/projects?project=' . $_GET['project']);
		}
	}
}
