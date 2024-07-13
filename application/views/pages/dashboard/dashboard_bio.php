<div class="row justify-content-center">
	<div class="col-md-7">
		<div class="card shadow">
			<div class="card-body">
				<h4>Bio</h4>

				<?= form_open(
					base_url() . "__actions__/user/update_bio",
					["method" => "post"],
					["_method" => "patch"]
				) ?>

				<?php if (isset($validation_bio_edit_errors['alert_error'])): ?>
					<div class="mb-3">
						<div class="alert alert-danger"><?= $validation_bio_edit_errors['alert_error'] ?></div>
					</div>
				<?php endif; ?>

				<div class="mb-3">
					<label for="name" class="form-label ms-1">Name</label>
					<input type="text"
						class="form-control <?= isset($validation_bio_edit_errors['name']) ? "is-invalid" : "" ?>" name="name"
						id="name" placeholder="Name"
						value="<?= isset($set_bio_edit_value['name']) ? $set_bio_edit_value['name'] : $user->name ?>"
						disabled>
					<?php if (isset($validation_bio_edit_errors['name'])): ?>
						<div class="invalid-feedback"><?= $validation_bio_edit_errors['name'] ?></div>
					<?php endif ?>
				</div>

				<div class="mb-3">
					<label for="email" class="form-label ms-1">Email</label>
					<input type="email"
						class="form-control <?= isset($validation_bio_edit_errors['email']) ? "is-invalid" : "" ?>"
						name="email" id="email" placeholder="Email"
						value="<?= isset($set_bio_edit_value['email']) ? $set_bio_edit_value['email'] : $user->email ?>"
						disabled>
					<?php if (isset($validation_bio_edit_errors['email'])): ?>
						<div class="invalid-feedback"><?= $validation_bio_edit_errors['email'] ?></div>
					<?php endif ?>
				</div>

				<div id="buttons" class="mb-3">
					<button id="edit_button" type="button" class="btn btn-outline-primary w-100">Edit</button>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		const container_buttons = `
			<div id="container_buttons">
				<button type="submit" class="btn btn-primary w-100 mb-1">Submit</button>
				<button id="cancel_button" type="button" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
					<i class="bi bi-x-circle me-1"></i>
					<span>Cancel</span>
				</button>
			</div>
		`

		$("#name").focus(function () {
			$(this).removeClass("is-invalid")
		})

		$("#email").focus(function () {
			$(this).removeClass("is-invalid")
		})

		<?php if (isset($validation_bio_edit_errors)): ?>
			$("#name").removeAttr("disabled")
			$("#email").removeAttr("disabled")
			$("#buttons").empty()
			$("#buttons").append(container_buttons)
		<?php endif; ?>

		$("#buttons").on("click", "#edit_button", function () {
			$(this).remove()
			$("#name").removeAttr("disabled")
			$("#email").removeAttr("disabled")

			$("#buttons").append(container_buttons)
		})

		$("#buttons").on("click", "#cancel_button", function () {
			$("#container_buttons").remove()
			$("#name").attr("disabled", true)
			$("#email").attr("disabled", true)

			$("#buttons").append(`
				<button id="edit_button" type="button" class="btn btn-outline-primary w-100">Edit</button>
			`)
		})
	})
</script>