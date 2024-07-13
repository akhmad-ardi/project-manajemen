<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card shadow">
			<div class="card-body">
				<?= form_open(
					base_url() . "__actions__/task/update",
					["method" => "post"],
					["_method" => "patch", "project_id" => $project->id, "task_id" => $task->id]
				) ?>
				<h4 class="mb-3">Edit Task [<?= $task->name ?>]</h4>

				<div class="mb-3">
					<label for="name" class="form-label ms-1">Name</label>
					<input type="text" id="name" name="name"
						class="form-control <?= isset($validation_task_edit_errors['name']) ? "is-invalid" : "" ?>"
						value="<?= isset($set_task_edit_errors['name']) ? $set_task_edit_errors['name'] : $task->name ?>">
					<?php if (isset($validation_task_edit_errors['name'])): ?>
						<div class="invalid-feedback"><?= $validation_task_edit_errors['name'] ?></div>
					<?php endif; ?>
				</div>

				<div class="mb-3">
					<label for="start_date" class="form-label ms-1">Start Date</label>
					<input type="date" id="start_date" name="start_date"
						class="form-control <?= isset($validation_task_edit_errors['start_date']) ? "is-invalid" : "" ?>"
						value="<?= isset($set_task_edit_errors['start_date']) ? $set_task_edit_errors['start_date'] : $task->start_date ?>">
					<?php if (isset($validation_task_edit_errors['start_date'])): ?>
						<div class="invalid-feedback"><?= $validation_task_edit_errors['start_date'] ?></div>
					<?php endif; ?>
				</div>

				<div class="mb-3">
					<label for="finish_date" class="form-label ms-1">Finish Date</label>
					<input type="date" id="finish_date" name="finish_date"
						class="form-control <?= isset($validation_task_edit_errors['finish_date']) ? "is-invalid" : "" ?>"
						value="<?= isset($set_task_edit_errors['finish_date']) ? $set_task_edit_errors['finish_date'] : $task->finish_date ?>">
					<?php if (isset($validation_task_edit_errors['finish_date'])): ?>
						<div class="invalid-feedback"><?= $validation_task_edit_errors['finish_date'] ?></div>
					<?php endif; ?>
				</div>

				<div class="mb-3">
					<button type="submit" class="btn btn-primary mb-1 w-100">Submit</button>
					<a href="<?= base_url() . 'dashboard/projects?' . (isset($team_id) ? 'team=' . $team_id : 'project=' . $project->slug) ?>"
						class="btn btn-danger mb-1 w-100">
						<i class="bi bi-arrow-left ms-1"></i>
						<span>Back</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$("#name").focus(function () {
			$(this).removeClass("is-invalid")
		})
		$("#start_date").focus(function () {
			$(this).removeClass("is-invalid")
		})
		$("#finish_date").focus(function () {
			$(this).removeClass("is-invalid")
		})
	})
</script>