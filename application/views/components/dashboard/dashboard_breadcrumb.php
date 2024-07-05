<div class="row mb-4">
	<div class="col d-flex justify-content-between">
		<h3>
			<?= $page_info["title"] ?>
		</h3>

		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item <?= $this->uri->uri_string() == "dashboard" ? 'active' : '' ?>">
					<?php if ($this->uri->uri_string() == "dashboard"): ?>
						Home
					<?php else: ?>
						<a href="<?= base_url() . $url_home ?>"><?= $label_home ?></a>
					<?php endif ?>
				</li>
				<?php if ($this->uri->uri_string() != "dashboard"): ?>
					<li class="breadcrumb-item active"><?= $page_info["title"] ?></li>
				<?php endif ?>
			</ol>
		</nav>
	</div>
</div>
