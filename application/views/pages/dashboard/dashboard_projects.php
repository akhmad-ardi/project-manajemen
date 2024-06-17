<div class="row row-cols-1 row-cols-md-3 g-3">
  <?php foreach ($projects as $project): ?>
    <?php $this->load->view('components/dashboard/project/dashboard_card', ['project' => $project]) ?>
  <?php endforeach; ?>

  <div class="col">
    <div class="card h-100">
      <div class="card-body d-grid align-items-center">
        <div class="text-center">
          <a href="<?= base_url() . "dashboard/projects/add" ?>" class="btn btn-primary stretched-link">
            <i class="bi bi-plus fs-4"></i>
            Add Project
          </a>
        </div>
      </div>
    </div>
  </div>
</div>