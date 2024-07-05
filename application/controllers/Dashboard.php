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
			if (!$project['is_success'])
				return redirect(base_url() . 'dashboard/projects');

			$users = $this->user_model->get_all_data(["id " . "!=" => $this->session->userdata('id')]);

			$owner_project = $this->user_model->get_data(["id" => $project['data']->user_id]);

			$note = $this->note_model->get_data(["project_id" => $project['data']->id]);

			$team = $this->team_model->get_data([
				"project_id" => $project['data']->id
			]);

			$team_member_user = array();
			if ($team['is_success']) {
				$team_members = $this->teammembers_model->get_all_data([
					"team_id" => $team['data']->id,
				]);

				foreach ($team_members['data'] as $member) {
					$user = $this->user_model->get_data(["id" => $member->user_id]);
					array_unshift($team_member_user, $user['data']->name);
				}
			}

			$tasks = $this->task_model->get_all_data(["project_id" => $project['data']->id]);

			return $this->load->view("layouts/dashboard/dashboard_layout", [
				"page_info" => array(
					'page' => 'dashboard_project',
					"title" => $project['data']->name
				),
				"breadcrumb" => [
					"label_home" => "Projects",
					"url_home" => "dashboard/projects"
				],
				"validation_errors" => $this->session->flashdata("validation_errors"),
				"set_value" => $this->session->flashdata("set_value"),

				// data detail project
				"project" => $project['data'],
				"note" => $note['is_success'] ? $note['data'] : null,
				"owner_project" => $owner_project['is_success'] ? $owner_project['data']->name : null,
				"team_info" => $team['is_success'] ? array(
					'team' => $team['data'],
					'team_members' => count($team_member_user) ? $team_member_user : null
				) : null,
				"tasks" => $tasks['is_success'] ? $tasks['data'] : null,

				// this 'users' is form create team
				"users" => $users['data'],
			]);
		}

		// add project
		if ($param) {
			return $this->load->view("layouts/dashboard/dashboard_layout", [
				"page_info" => array(
					'page' => 'dashboard_add_project',
					"title" => "Add Project"
				),
				"breadcrumb" => [
					"label_home" => "Projects",
					"url_home" => "dashboard/projects"
				],
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
			"breadcrumb" => [
				"label_home" => "Dashboard",
				"url_home" => "dashboard"
			],
			"projects" => isset($projects['data']) ? $projects['data'] : []
		]);
	}
}
