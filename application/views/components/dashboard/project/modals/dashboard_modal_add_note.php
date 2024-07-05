<div class="modal fade " id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addNoteLabel">Add Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open(
        base_url() . '__actions__/note/add?project=' . $_GET['project'],
        ['method' => 'post'],
        ['project_id' => $project_id]
      ) ?>
      <div class="modal-body">
        <?php if (isset($validation_errors['note'])): ?>
          <div class="mb-3">
            <div class="alert alert-danger" role="alert">
              <?= $validation_errors['note'] ?>
            </div>
          </div>
        <?php endif ?>

        <!-- title -->
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" id="title" name="title"
            class="form-control <?= isset($validation_errors['title']) ? "is-invalid" : "" ?>"
            value="<?= isset($set_value['title']) ? $set_value['title'] : "" ?>" placeholder="Title Note"
            data-sb-validations="required,title">
          <?php if (isset($validation_errors['title'])): ?>
            <div class="invalid-feedback" data-sb-feedback="title:required">
              <?= $validation_errors['title'] ?>
            </div>
          <?php endif ?>
        </div>

        <!-- content -->
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea id="content" name="content"
            class="form-control <?= isset($validation_errors['content']) ? "is-invalid" : "" ?>"
            value="<?= isset($set_value['content']) ? $set_value['content'] : "" ?>" rows="3" placeholder="Content Note"
            data-sb-validations="required,content"></textarea>
          <?php if (isset($validation_errors['content'])): ?>
            <div class="invalid-feedback" data-sb-feedback="content:required">
              <?= $validation_errors['content'] ?>
            </div>
          <?php endif ?>
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
        $("#addNoteModal").modal("show");
      });
    </script>
  ';
}

if (isset($set_value['content'])) {
  echo '
    <script type="text/javascript">
      $(document).ready(function () {
        $("#content").val("' . $set_value['content'] . '");
      });
    </script>
  ';
}
?>

<script src="<?= base_url() . 'assets/js/add-note.js' ?>"></script>