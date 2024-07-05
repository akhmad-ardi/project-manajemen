<div class="col">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="card-title fw-bold"><?= $project->name ?></h4>
      <h6 class="card-subtitle mb-2 text-body-secondary">
        <?= format_date($project->start_date) ?> -
        <?= format_date($project->finish_date) ?>
      </h6>
      <p class="card-text"><?= $project->description ?></p>

      <a href="<?= base_url() . 'dashboard/projects?project=' . $project->slug ?>"
        class="btn btn-primary strectched-link">View Project</a>
    </div>
  </div>
</div>