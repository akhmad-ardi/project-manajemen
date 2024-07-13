<?php
$list_menu_dashboard = array(
	[
		"segment" => "dashboard",
		"label" => "Dashboard",
		"icon" => "speedometer",
		"href" => base_url() . "dashboard"
	],
	[
		"segment" => "dashboard/projects",
		"label" => "Projects",
		"icon" => "columns-gap",
		"href" => base_url() . "dashboard/projects"
	],
);

$list_menu_profile = array(
	[
		"segment" => "dashboard/bio",
		"label" => "Bio",
		"icon" => "person",
		"href" => base_url() . "dashboard/bio"
	],
	[
		"segment" => "dashboard/account",
		"label" => "Account",
		"icon" => "key",
		"href" => base_url() . "dashboard/account"
	],
);
?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse pt-0 pt-md-5">
	<div class="position-sticky pt-md-3 sidebar-sticky">
		<ul class="nav flex-column">
			<?php foreach ($list_menu_dashboard as $menu): ?>
				<li class="nav-item">
					<a class="nav-link <?= $menu["segment"] == $this->uri->uri_string ? "active" : "" ?>" aria-current="page"
						href="<?= $menu['href'] ?>">
						<i class="bi bi-<?= $menu['icon'] ?> fs-4 me-2"></i>
						<?= $menu['label'] ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<!-- Profile -->
		<h6
			class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
			<span>Profile</span>
		</h6>

		<ul class="nav flex-column mb-2">
			<?php foreach ($list_menu_profile as $profile): ?>
				<li class="nav-item">
					<a class="nav-link <?= $profile["segment"] == $this->uri->uri_string ? "active" : "" ?>"
						href="<?= $profile['href'] ?>">
						<i class="bi bi-<?= $profile['icon'] ?> fs-4 me-2"></i>
						<?= $profile['label'] ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<!-- Auth -->
		<h6
			class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
			<span>Auth</span>
		</h6>

		<ul class="nav flex-column mb-2">
			<li class="nav-item">
				<a role="button" class="nav-link text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#signOutModal">
					<i class="bi bi-power fs-4 me-2"></i>
					Sign Out
				</a>
			</li>
		</ul>
	</div>
</nav>
