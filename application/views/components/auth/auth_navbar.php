<nav class="navbar navbar-expand-lg navbar-light py-3">
	<div class="container px-4 px-lg-5">
		<a class="navbar-brand" href="#masthead">[Kelola]</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
			data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ms-auto my-2 my-lg-0 gap-3">
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>#masthead">Beranda</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>#about">Tentang Kami</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>#services">Fitur</a>
				</li>
				<li class="nav-item d-flex align-items-center">
					<a class="btn btn-primary rounded-pill px-4"
						href="/auth/<?= $page_info["title"] == "Sign In" ? "signup" : "signin" ?>">
						<?= $page_info["title"] == "Sign In" ? "Sign Up" : "Sign In" ?>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>