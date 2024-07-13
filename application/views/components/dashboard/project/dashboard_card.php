<div class="col">
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title fw-bold"><?= isset($project) ? $project->name : $team_project->team->name ?></h4>
			<h6 class="card-subtitle mb-2 text-body-secondary">
				<?= format_date(isset($project) ? $project->start_date : $team_project->start_date) ?> -
				<?= format_date(isset($project) ? $project->finish_date : $team_project->finish_date) ?>
			</h6>
			<?php if (isset($project)): ?>
				<p class="card-text"><?= $project->description ?></p>
			<?php endif; ?>

			<a href="<?= isset($project) ?
				base_url() . 'dashboard/projects?project=' . $project->slug :
				base_url() . 'dashboard/projects?team=' . $team_project->team->id ?>"
				class="btn btn-primary stretched-link mt-2">View
				Project</a>
		</div>
	</div>
</div>