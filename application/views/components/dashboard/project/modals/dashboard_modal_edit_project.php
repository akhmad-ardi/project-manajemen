<!-- Modal Edit Project -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<?= form_open(
			base_url() . '__actions__/project/update?project=' . $project->slug,
			["method" => "post"],
			["_method" => "patch", "project_id" => $project->id]
		) ?>
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="editProjectModalLabel">Edit Project</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- name  -->
				<div class="mb-3">
					<label for="name" class="form-label">Name Project</label>
					<input type="text" name="name" id="name"
						class="form-control <?= isset($validation_edit_project_errors['name']) ? 'is-invalid' : '' ?>"
						placeholder="Name Project"
						value="<?= isset($set_edit_project_value['name']) ? $set_edit_project_value['name'] : $project->name ?>">
					<?php if (isset($validation_edit_project_errors['name'])): ?>
						<div class="invalid-feedback"><?= $validation_edit_project_errors['name'] ?></div>
					<?php endif ?>
				</div>

				<!-- description  -->
				<div class="mb-3">
					<label for="description" class="form-label">Description Project</label>
					<textarea name="description" id="description"
						class="form-control <?= isset($validation_edit_project_errors['description']) ? 'is-invalid' : '' ?>"
						id="description" rows="3"
						placeholder="Description Project"><?= isset($set_edit_project_value['description']) ? $set_edit_project_value['description'] : $project->description ?></textarea>
					<?php if (isset($validation_edit_project_errors['description'])): ?>
						<div class="invalid-feedback"><?= $validation_edit_project_errors['description'] ?></div>
					<?php endif ?>
				</div>

				<!-- start date  -->
				<div class="mb-3">
					<label for="start_date" class="form-label">Start Date Project</label>
					<input type="date" name="start_date" id="start_date"
						class="form-control <?= isset($validation_edit_project_errors['start_date']) ? 'is-invalid' : '' ?>"
						id="start_date"
						value="<?= isset($set_edit_project_value['start_date']) ? $set_edit_project_value['start_date'] : format_date($project->start_date, "Y-m-d H:i:s", "Y-m-d") ?>">
					<?php if (isset($validation_edit_project_errors['start_date'])): ?>
						<div class="invalid-feedback"><?= $validation_edit_project_errors['start_date'] ?></div>
					<?php endif ?>
				</div>

				<!-- finish date  -->
				<div class="mb-3">
					<label for="finish_date" class="form-label">Finish Date Project</label>
					<input type="date" name="finish_date" id="finish_date"
						class="form-control <?= isset($validation_edit_project_errors['finish_date']) ? 'is-invalid' : '' ?>"
						id="finish_date"
						value="<?= isset($set_edit_project_value['finish_date']) ? $set_edit_project_value['finish_date'] : format_date($project->finish_date, "Y-m-d H:i:s", "Y-m-d") ?>">
					<?php if (isset($validation_edit_project_errors['finish_date'])): ?>
						<div class="invalid-feedback"><?= $validation_edit_project_errors['finish_date'] ?></div>
					<?php endif ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>
		<?= form_close() ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		<?php if (isset($validation_edit_project_errors)): ?>
			$("#editProjectModal").modal('show')
		<?php endif ?>
	})
</script>