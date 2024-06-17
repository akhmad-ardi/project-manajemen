<div class="col">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title fw-bold"><?= $project->name ?></h4>
      <h6 class="card-subtitle mb-2 text-body-secondary">
        <?= DateTime::createFromFormat('Y-m-d H:i:s', $project->start_date)->format('F j, Y') ?> -
        <?= DateTime::createFromFormat('Y-m-d H:i:s', $project->finish_date)->format('F j, Y') ?>
      </h6>
      <p class="card-text"><?= $project->description ?></p>

      <a href="<?= base_url() . 'dashboard/projects?project=' . $project->slug ?>"
        class="btn btn-primary strectched-link">View Project</a>
    </div>
  </div>
</div>