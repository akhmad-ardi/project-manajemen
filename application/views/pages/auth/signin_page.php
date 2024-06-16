<div class="container mx-auto row align-items-center py-5">
  <div class="col">
    <h3 class="text-center">Masuk</h3>

    <div class="row justify-content-center mt-3">
      <?= form_open(base_url() . '__actions__/auth/signin', ["class" => "col-md-5", "method" => 'post']) ?>
      <div class="row">
        <div class="col">
          <?php if (isset($validation_errors['signin_error'])): ?>
            <div class="alert alert-danger" role="alert">
              <?= $validation_errors['signin_error'] ?>
            </div>
          <?php endif ?>

          <div class="form-floating mb-3">
            <input class="form-control <?= isset($validation_errors['email']) ? "is-invalid" : "" ?>" name="email"
              id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email"
              value="<?= isset($set_value['email']) ? $set_value['email'] : '' ?>" />
            <label for="email">Email</label>

            <?php if (isset($validation_errors['email'])): ?>
              <div class="invalid-feedback" data-sb-feedback="email:required">
                <?= $validation_errors['email'] ?>
              </div>
            <?php endif ?>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-floating mb-3">
            <input class="form-control <?= isset($validation_errors['password']) ? "is-invalid" : "" ?>" name="password"
              id="password" type="password" placeholder="password" data-sb-validations="required,password" />
            <label for="password">Password</label>

            <?php if (isset($validation_errors['password'])): ?>
              <div class="invalid-feedback" data-sb-feedback="password:required">
                <?= $validation_errors['password'] ?>
              </div>
            <?php endif ?>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <button type="submit" class="btn btn-primary w-100">Submit</button>

          <p class="mt-3 text-center">Silahkan
            <a href="<?= base_url() . 'auth/signup' ?>">daftar</a>
            jika belum punya akun
          </p>
          <p class="mt-5 text-center">
            <a href="<?= base_url() ?>">
              <i class="bi-house-door-fill"></i>
              Beranda
            </a>
          </p>
        </div>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>