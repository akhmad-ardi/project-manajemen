<?php if ($toast_success || $toast_error): ?>
	<div class="toast-container position-fixed top-0 end-0 p-3">
		<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
				<h5 class="me-auto d-flex align-items-center m-0">
					<?php if ($toast_success): ?>
						<i class="bi bi-check2-circle text-success me-2"></i>
						<span><?= $toast_success ?></span>
					<?php else: ?>
						<i class="bi bi-exclamation-circle text-danger me-2"></i>
						<span><?= $toast_error ?></span>
					<?php endif; ?>
				</h5>
				<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		const toast = new bootstrap.Toast(document.getElementById("liveToast"))

		toast.show()
	</script>
<?php endif; ?>