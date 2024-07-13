<div class="row row-cols-md-2 row-cols-1">
	<!-- Project Info -->
	<div class="col mb-2 mb-md-0">
		<div class="card shadow-sm">
			<div class="card-body">
				<h4 class="card-title"><?= $page_info['title'] ?></h4>
				<h6 class="card-subtitle mb-3">
					<?= format_date($project->start_date) ?> -
					<?= format_date($project->finish_date) ?>
				</h6>
				<p><?= $project->description ?></p>

				<div class="d-flex justify-content-between">
					<div>
						<!-- note project -->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noteModal"
							<?= $note ? "" : "disabled" ?>>
							<i class="bi bi-card-text fs-5 me-1"></i>
							<span>Note</span>
						</button>

						<?php if ($note): ?>
							<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_note', ['note' => $note]) ?>
						<?php endif ?>

						<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
							data-bs-target="#addTaskModal">
							<i class="bi bi-plus fs-5 me-1"></i>
							Add Task
						</button>

						<!-- add task -->
						<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_add_task', ['project' => $project]) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Project Team -->
	<div class="col">
		<div class="card shadow-sm">
			<div class="card-body">
				<h4 class="card-title">Team Name: <?= $team_info['team']->name ?></h4>
				<h6 class="card-subtitle mb-3"><?= count($team_info['team_members']) + 1 ?> members</h6>

				<ul class="list-group">
					<li class="list-group-item"><?= $owner_project ?> <span class="badge bg-primary">owner</span></li>
					<?php foreach ($team_info['team_members'] as $member): ?>
						<li class="list-group-item"><?= $member ?></li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- Tasks -->
<div class="row mt-3">
	<div class="col">
		<div class="card shadow-sm">

			<!-- Table Task -->
			<?php $this->load->view('components/dashboard/project/dashboard_table_task', ['project' => $project]) ?>
		</div>
	</div>
</div>