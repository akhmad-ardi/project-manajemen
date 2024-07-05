<?php if (isset($project)): ?>
	<div class="row">
		<!-- Project Info -->
		<div class="col-md-6">
			<div class="card shadow-sm">
				<div class="card-body">
					<h3 class="card-title"><?= $page_info['title'] ?></h3>
					<h5 class="card-subtitle mb-3">
						<?= format_date($project->start_date) ?> -
						<?= format_date($project->finish_date) ?>
					</h5>
					<p><?= $project->description ?></p>

					<!-- note project -->
					<?php if ($note): ?>
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noteModal">
							<i class="bi bi-card-text fs-5 me-1"></i>
							<span>Note</span>
						</button>
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
							<i class="bi bi-plus fs-5 me-1"></i>
							Add Task
						</button>
					<?php else: ?>
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNoteModal">
							<i class="bi bi-plus fs-5 me-1"></i>
							<span>Add Note</span>
						</button>
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
							<i class="bi bi-plus fs-5 me-1"></i>
							Add Task
						</button>
					<?php endif ?>

					<?php if ($note): ?>
						<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_note', ['note' => $note]) ?>
					<?php else: ?>
						<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_add_note', ["project_id" => $project->id]) ?>
					<?php endif ?>

				</div>
			</div>
		</div>
		<!-- Project Team -->
		<div class="col-md-6">
			<?php if (isset($team_info['team'])): ?>
				<div class="card shadow-sm">
					<div class="card-body">
						<h3 class="card-title">Team Name: <?= $team_info['team']->name ?></h3>
						<h5 class="card-subtitle mb-3"><?= count($team_info['team_members']) + 1 ?> members</h5>

						<ul class="list-group">
							<li class="list-group-item"><?= $owner_project ?> <span class="badge bg-primary">owner</span></li>
							<?php foreach ($team_info['team_members'] as $member): ?>
								<li class="list-group-item"><?= $member ?></li>
							<?php endforeach ?>
						</ul>
					</div>
				</div>
			<?php else: ?>
				<div class="card shadow-sm h-100">
					<div class="card-body d-flex justify-content-center align-items-center">
						<button class="btn btn-primary stretched-link" type="button" data-bs-toggle="modal"
							data-bs-target="#createTeam">
							<i class="bi bi-plus me-1 fs"></i>
							Create Team
						</button>

						<!-- Modal Create Team -->
						<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_create_team', ["project_id" => $project->id]) ?>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>

	<!-- Tasks -->
	<div class="row mt-3">
		<div class="col">
			<div class="card shadow-sm">

				<!-- Table Task -->
				<?php $this->load->view('components/dashboard/project/dashboard_table_task', ['project_id' => $project->id]) ?>
			</div>
		</div>
	</div>
<?php else: ?>
	<div class="row align-items-center py-5 my-5">
		<div class="col">
			<h1 class="text-center">404</h1>
			<h3 class="text-center"><?= $page_info['title'] ?></h3>
			<div class="text-center mt-4">
				<a href="<?= base_url() . 'dashboard/projects' ?>" class="btn btn-danger">
					<i class="bi bi-arrow-left me-1 fs-5"></i>
					Back
				</a>
			</div>
		</div>
	</div>
<?php endif ?>
