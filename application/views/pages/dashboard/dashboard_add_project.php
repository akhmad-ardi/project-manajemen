<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow">
      <div class="card-body">
        <?= form_open(base_url() . "__actions__/project/add", ["method" => "post"]) ?>
        <!-- alert -->
        <?php if (isset($validation_errors['error_add_project'])): ?>
          <div class="mb-3">
            <div class="alert alert-danger" role="alert">
              <?= $validation_errors['error_add_project'] ?>
            </div>
          </div>
        <?php endif ?>

        <!-- name project -->
        <div class="mb-3">
          <label for="name" class="form-label">Name Project</label>
          <input name="name" type="text" value="<?= isset($set_value['name']) ? $set_value['name'] : '' ?>"
            class="form-control <?= isset($validation_errors['name']) ? 'is-invalid' : '' ?>" id="name"
            placeholder="Name Project" aria-describedby="nameFeedback">

          <?php if (isset($validation_errors['name'])): ?>
            <div id="nameFeedback" class="invalid-feedback">
              <?= $validation_errors['name'] ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- description project -->
        <div class="mb-3">
          <label for="description" class="form-label">Description Project</label>
          <textarea name="description" value="<?= isset($set_value['description']) ? $set_value['description'] : '' ?>"
            class="form-control <?= isset($validation_errors['description']) ? 'is-invalid' : '' ?>" id="description"
            placeholder="Description Project" rows="3" aria-describedby="descriptionFeedback"></textarea>

          <?php if (isset($validation_errors['description'])): ?>
            <div id="descriptionFeedback" class="invalid-feedback">
              <?= $validation_errors['description'] ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- start date project -->
        <div class="mb-3">
          <label for="start_date" class="form-label">Start Date Project</label>
          <input name="start_date" type="date"
            value="<?= isset($set_value['start_date']) ? $set_value['start_date'] : '' ?>"
            class="form-control <?= isset($validation_errors['start_date']) ? 'is-invalid' : '' ?>" id="start_date"
            aria-describedby="nameFeedback">

          <?php if (isset($validation_errors['start_date'])): ?>
            <div id="nameFeedback" class="invalid-feedback">
              <?= $validation_errors['start_date'] ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- start date project -->
        <div class="mb-3">
          <label for="finish_date" class="form-label">Finish Date Project</label>
          <input name="finish_date" type="date"
            value="<?= isset($set_value['finish_date']) ? $set_value['finish_date'] : '' ?>"
            class="form-control <?= isset($validation_errors['finish_date']) ? 'is-invalid' : '' ?>" id="finish_date"
            aria-describedby="nameFeedback">

          <?php if (isset($validation_errors['finish_date'])): ?>
            <div id="nameFeedback" class="invalid-feedback">
              <?= $validation_errors['finish_date'] ?>
            </div>
          <?php endif; ?>
        </div>

        <div>
          <button type="submit" class="btn btn-primary mb-1 w-100">Submit</button>
          <a href="<?= base_url() . "dashboard/projects" ?>" class="btn btn-danger mb-1 w-100">
            <i class="bi bi-arrow-left fs-6"></i>
            Back
          </a>
        </div>

        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>