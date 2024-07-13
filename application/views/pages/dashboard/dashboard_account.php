<div class="row justify-content-center">
	<div class="col-md-7">
		<div class="card shadow">
			<div class="card-body">
				<h4>Account</h4>

				<?= form_open(
					base_url() . "__actions__/user/update_account",
					["method" => "post"],
					["_method" => "patch"]
				) ?>
				<!-- Alert Error -->
				<?php if (isset($alert_password)): ?>
					<div class="mb-3">
						<div class="alert alert-danger d-flex align-items-center">
							<i class="bi bi-x-circle fs-5 me-1"></i>
							<span><?= $alert_password ?></span>
						</div>
					</div>
				<?php endif; ?>

				<!-- old password -->
				<div class="mb-3">
					<label for="basic-url" class="form-label ms-1">Old password</label>
					<div class="input-group mb-3">
						<input type="password" id="old-password-input" name="old_password"
							class="form-control <?= isset($validation_update_account_errors['old_password']) ? "is-invalid" : "" ?>"
							placeholder="Old password"
							value="<?= isset($set_update_account_value['old_password']) ? $set_update_account_value['old_password'] : "" ?>">
						<span class="input-group-text" id="old-password">
							<i class="bi bi-eye"></i>
						</span>
						<?php if (isset($validation_update_account_errors['old_password'])): ?>
							<div class="invalid-feedback"><?= $validation_update_account_errors['old_password'] ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- new password -->
				<div class="mb-3">
					<label for="basic-url" class="form-label ms-1">New password</label>
					<div class="input-group mb-3">
						<input type="password" id="new-password-input" name="new_password"
							class="form-control <?= isset($validation_update_account_errors['new_password']) ? "is-invalid" : "" ?>"
							placeholder="New password"
							value="<?= isset($set_update_account_value['new_password']) ? $set_update_account_value['new_password'] : "" ?>">
						<span class="input-group-text" id="new-password">
							<i class="bi bi-eye"></i>
						</span>
						<?php if (isset($validation_update_account_errors['new_password'])): ?>
							<div class="invalid-feedback"><?= $validation_update_account_errors['new_password'] ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- confirm passwordd -->
				<div class="mb-3">
					<label for="basic-url" class="form-label ms-1">Confirm password</label>
					<div class="input-group mb-3">
						<input type="password" id="confirm-password-input" name="confirm_password"
							class="form-control <?= isset($validation_update_account_errors['confirm_password']) ? "is-invalid" : "" ?>"
							placeholder="Confirm password"
							value="<?= isset($set_update_account_value['confirm_password']) ? $set_update_account_value['confirm_password'] : "" ?>">
						<span class="input-group-text" id="confirm-password">
							<i class="bi bi-eye"></i>
						</span>
						<?php if (isset($validation_update_account_errors['confirm_password'])): ?>
							<div class="invalid-feedback"><?= $validation_update_account_errors['confirm_password'] ?></div>
						<?php endif; ?>
					</div>
				</div>

				<div class="mb-3">
					<button type="submit" class="btn btn-primary w-100">Submit</button>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$("#old-password-input").focus(function () {
			$(this).removeClass("is-invalid")
		})
		$("#new-password-input").focus(function () {
			$(this).removeClass("is-invalid")
		})
		$("#confirm-password-input").focus(function () {
			$(this).removeClass("is-invalid")
		})

		function changeValueAttr(elementInput, elementEye) {
			elementInput.attr("type", elementInput.attr("type") === "password" ? "text" : "password")

			$(elementEye).empty()
			$(elementEye).append($(elementInput).attr("type") === "password" ? `<i class="bi bi-eye"></i>` : `<i class="bi bi-eye-slash"></i>`)
		}

		$("#old-password").on("click", function () {
			changeValueAttr($("#old-password-input"), $(this))
		})

		$("#new-password").on("click", function () {
			changeValueAttr($("#new-password-input"), $(this))
		})

		$("#confirm-password").on("click", function () {
			changeValueAttr($("#confirm-password-input"), $(this))
		})
	})
</script>