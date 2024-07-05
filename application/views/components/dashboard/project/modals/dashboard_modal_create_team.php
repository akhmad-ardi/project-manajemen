<div class="modal fade " id="createTeam" tabindex="-1" aria-labelledby="createTeamLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <?= form_open(
        base_url() . '__actions__/team/add?project=' . $_GET['project'],
        ["method" => "post"],
        ['project_id' => $project_id]
      ) ?>
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createTeamLabel">Create Team</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php if (isset($validation_errors['team'])): ?>
          <div class="mb-3">
            <div class="alert alert-danger" role="alert">
              <i class="bi bi-exclamation-circle"></i>
              <?= $validation_errors['team'] ?>
            </div>
          </div>
        <?php endif ?>

        <!-- team name -->
        <div class="mb-3">
          <label for="team_name" class="form-label">Team Name</label>
          <input type="text" name="name" id="team_name"
            class="form-control <?= isset($validation_errors['name']) ? "is-invalid" : "" ?>"
            value="<?= isset($set_value['name']) ? $set_value['name'] : "" ?>" placeholder="Team Name"
            data-sb-validations="required,team_name">
          <?php if (isset($validation_errors['name'])): ?>
            <div class="invalid-feedback" data-sb-feedback="team_name:required">
              <?= $validation_errors['name'] ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- choose team members -->
        <div class="mb-3">
          <label for="choose_team_member" class="form-label">
            Choose Team Member
            <span id="alert_error_choose_team_member" class="badge text-bg-danger d-none"></span>
          </label>
          <div class="input-group mb-3">
            <input type="text" id="choose_team_member"
              class="form-control <?= isset($validation_errors['list_team_members[]']) ? "is-invalid" : "" ?>"
              list="list_email_user" placeholder="Type to search user with email..."
              data-sb-validations="required,choose_team_member">
            <button type="button" id="btn_add_member" class="input-group-text rounded-end bg-primary text-white">
              <i class="bi bi-plus fs-5 me-1"></i> Add Member
            </button>
            <?php if (isset($validation_errors['list_team_members[]'])): ?>
              <div class="invalid-feedback" data-sb-feedback="choose_team_member:required">
                <?= $validation_errors['list_team_members[]'] ?>
              </div>
            <?php endif ?>
          </div>

          <!-- team members -->
          <datalist id="list_email_user">
            <?php foreach ($users as $user): ?>
              <option value="<?= $user->email ?>"></option>
            <?php endforeach ?>
          </datalist>
        </div>

        <div class="mb-3">
          <p class="mb-2">Team Member</p>

          <ul id="list_group" class="list-group">
            <?php if (isset($set_value['list_team_members']) && !isset($validation_errors['list_team_members[]'])): ?>
              <?php for ($i = 0; $i < count($set_value['list_team_members']); $i++): ?>
                <li class="list-group-item">
                  <div class="form-check">
                    <input class="form-check-input d-none" type="checkbox" name="list_team_members[]"
                      value="<?= $set_value['list_team_members'][$i] ?>" id="<?= $set_value['list_team_members'][$i] ?>"
                      checked>
                    <label class="form-check-label" for="<?= $set_value['list_team_members'][$i] ?>">
                      <?= $set_value['list_team_members'][$i] ?>
                    </label>
                  </div>
                </li>
              <?php endfor ?>
            <?php endif ?>
          </ul>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<?php
if (isset($validation_errors)) {
  echo '
  <script type="text/javascript">
    $(document).ready(function () {
      $("#createTeam").modal("show");
    });
  </script>
  ';
}
?>

<script src="<?= base_url() ?>assets/js/create-team.js"></script>