<header class="navbar navbar-dark sticky-top flex-between bg-primary p-0 pe-3 shadow">
	<a class="navbar-brand col-md-3 col-lg-2 me-0 p-3 fs-5 text-center" href="#"><?= $user->name ?></a>
	<div class="d-flex">
		<div class="navbar-nav">
			<div class="nav-item">
				<a role="button" class="nav-link p-3" data-bs-toggle="modal" data-bs-target="#signOutModal">Sign out</a>
			</div>
		</div>
		<button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse"
			data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	</div>
</header>

<div class="modal fade" id="signOutModal" tabindex="-1" aria-labelledby="signOutModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="signOutModalLabel">Sign Out</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Are You Sure?
			</div>
			<?= form_open(base_url() . '__actions__/auth/signout', ["method" => "post"], ["_method" => "delete"]) ?>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
				<button type="submit" class="btn btn-primary">Yes</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>