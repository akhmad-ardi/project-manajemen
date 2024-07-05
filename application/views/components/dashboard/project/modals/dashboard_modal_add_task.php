<!-- Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="addTaskModalLabel">Add Task</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form_add_task">
				<input type="hidden" name="project_id" value="<?= $project_id ?>">
				<div class="modal-body">
					<!-- alert -->
					<div id="alert_message"></div>

					<!-- task -->
					<div class="mb-3">
						<label for="name" class="form-label">Task</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Task">
						<div id="name-feedback" class="invalid-feedback"></div>
					</div>

					<!-- start date -->
					<div class="mb-3">
						<label for="start_date" class="form-label">Start date</label>
						<input type="date" class="form-control" name="start_date" id="start_date">
						<div id="start_date-feedback" class="invalid-feedback"></div>
					</div>

					<!-- finish date -->
					<div class="mb-3">
						<label for="finish_date" class="form-label">Finish date</label>
						<input type="date" class="form-control" name="finish_date" id="finish_date">
						<div id="finish_date-feedback" class="invalid-feedback"></div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" id="addTaskModal_close" class="btn btn-secondary"
						data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#addTaskModal_close').on('click', function () {
			$(`#name`).removeClass('is-invalid')
			$(`#start_date`).removeClass('is-invalid')
			$(`#finish_date`).removeClass('is-invalid')
		})

		$('#form_add_task').on('submit', function (e) {
			e.preventDefault()
			$(`#name`).removeClass('is-invalid')
			$(`#start_date`).removeClass('is-invalid')
			$(`#finish_date`).removeClass('is-invalid')

			$.ajax({
				url: '<?= base_url() . '__actions__/task/add?project=' . $_GET['project'] ?>',
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				success: function (response) {
					if (!response.is_success) {
						for (const key in response.validation_errors) {
							$(`#${key}-feedback`).text(response.validation_errors[key])
							$(`#${key}`).addClass('is-invalid')
						}
					} else {
						$('#addTaskModal').modal('hide');
						$('#form_add_task')[0].reset();

						// update table tasks
						get_all_tasks('<?= base_url('__actions__/task/get_all?project_id=' . $project_id) ?>')
					}
				}
			})
		})

	})
</script>