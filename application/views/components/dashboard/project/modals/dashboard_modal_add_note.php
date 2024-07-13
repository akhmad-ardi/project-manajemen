<div class="modal fade " id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="addNoteLabel">Add Note</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<?= form_open(
				base_url() . '__actions__/note/add?project=' . $project->slug,
				['method' => 'post'],
				['project_id' => $project->id]
			) ?>
			<div class="modal-body">
				<?php if (isset($validation_add_note_errors['note'])): ?>
					<div class="mb-3">
						<div class="alert alert-danger" role="alert">
							<?= $validation_add_note_errors['note'] ?>
						</div>
					</div>
				<?php endif ?>

				<!-- title -->
				<div class="mb-3">
					<label for="title" class="form-label">Title</label>
					<input type="text" id="title" name="title"
						class="form-control <?= isset($validation_add_note_errors['title']) ? "is-invalid" : "" ?>"
						value="<?= isset($set_add_note_value['title']) ? $set_add_note_value['title'] : "" ?>"
						placeholder="Title Note" data-sb-validations="required,title">
					<?php if (isset($validation_add_note_errors['title'])): ?>
						<div class="invalid-feedback" data-sb-feedback="title:required">
							<?= $validation_add_note_errors['title'] ?>
						</div>
					<?php endif ?>
				</div>

				<!-- content -->
				<div class="mb-3">
					<label for="content" class="form-label">Content</label>
					<textarea id="content" name="content"
						class="form-control <?= isset($validation_add_note_errors['content']) ? "is-invalid" : "" ?>"
						value="<?= isset($set_add_note_value['content']) ? $set_add_note_value['content'] : "" ?>" rows="3"
						placeholder="Content Note"
						data-sb-validations="required,content"><?= isset($set_add_note_value['content']) ? $set_add_note_value['content'] : "" ?></textarea>
					<?php if (isset($validation_add_note_errors['content'])): ?>
						<div class="invalid-feedback" data-sb-feedback="content:required">
							<?= $validation_add_note_errors['content'] ?>
						</div>
					<?php endif ?>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		<?php if (isset($validation_add_note_errors)): ?>
			$("#addNoteModal").modal("show")
		<?php endif ?>
	})
</script>

<script src="<?= base_url() . 'assets/js/add-note.js' ?>"></script>