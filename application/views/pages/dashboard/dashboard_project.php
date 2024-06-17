<div class="row">
  <!-- Project Info -->
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h3 class="card-title">Project 1</h3>
        <h5 class="card-subtitle mb-3">January 3, 2024 - January 10, 2024</h5>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae ullam corrupti possimus eos labore nisi,
          minus provident cumque quibusdam nesciunt distinctio ratione quo ad veritatis?
        </p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noteModal">
          <i class="bi bi-card-text fs-5 me-1"></i>
          <span>Note</span>
        </button>

        <?php $this->load->view('components/dashboard/project/dashboard_modal_note') ?>

      </div>
    </div>
  </div>
  <!-- Project Team -->
  <div class="col-md-6">
    <?php if ($team): ?>
      <div class="card shadow">
        <div class="card-body">
          <h3 class="card-title">Team Name: <?= $team->name ?></h3>
          <h5 class="card-subtitle mb-3"><?= count($team_members) ?> members</h5>

          <ul>
            <?php foreach ($team_members as $member): ?>
              <li><?= $member ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
    <?php else: ?>
      <div class="card shadow h-100">
        <div class="card-body d-flex justify-content-center align-items-center">
          <button class="btn btn-primary stretched-link" type="button" data-bs-toggle="modal"
            data-bs-target="#createTeam">
            <i class="bi bi-plus me-1 fs"></i>
            Create Team
          </button>

          <!-- Modal Create Team -->
          <?php $this->load->view('components/dashboard/project/dashboard_modal_create_team', ["project_id" => $project->id]) ?>
        </div>
      </div>
    <?php endif ?>
  </div>
</div>

<div class="row"></div>