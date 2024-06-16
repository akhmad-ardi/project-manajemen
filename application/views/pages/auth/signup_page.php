<div class="container mx-auto row align-items-center py-3">
  <div class="col">
    <h3 class="text-center">Daftar Akun</h3>

    <div class="row justify-content-center mt-3">
      <?= form_open(base_url() . '__actions__/auth/signup', ["class" => "col-md-5", "method" => "post"]) ?>
      <div class="row">
        <div class="col">
          <div class="form-floating mb-3">
            <input name="username" class="form-control <?= isset($validation_errors['username']) ? "is-invalid" : "" ?>"
              id="username" type="text" value="<?= isset($set_value['username']) ? $set_value['username'] : '' ?>"
              placeholder="username" data-sb-validations="required,username" />
            <label for="username">Username</label>
            <div class="invalid-feedback" data-sb-feedback="username:required">
              <?= $validation_errors['username'] ?>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-floating mb-3">
            <input name="email" class="form-control <?= isset($validation_errors['email']) ? "is-invalid" : "" ?>"
              id="email" type="email" value="<?= isset($set_value['email']) ? $set_value['email'] : '' ?>"
              placeholder="name@example.com" data-sb-validations="required,username" />
            <label for="username">Email</label>
            <div class="invalid-feedback" data-sb-feedback="email:required">
              <?= $validation_errors['email'] ?>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-floating mb-3">
            <input name="password"
              class="form-control <?= isset($validation_errors['password']) || isset($validation_errors['password_match']) ? "is-invalid" : "" ?>"
              id="password" type="password" placeholder="password" data-sb-validations="required,password" />
            <label for="password">Password</label>
            <?php if (isset($validation_errors['password'])): ?>
              <div class="invalid-feedback" data-sb-feedback="password:required">
                <?= $validation_errors['password'] ?>
              </div>
            <?php endif; ?>

            <?php if (isset($validation_errors['password_match'])): ?>
              <div class="invalid-feedback" data-sb-feedback="password:required">
                <?= $validation_errors['password_match'] ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-floating mb-3">
            <input name="confirm_password"
              class="form-control <?= isset($validation_errors['confirm_password']) || isset($validation_errors['password_match']) ? "is-invalid" : "" ?>"
              id="confirm-password" type="password" placeholder="confirm-password"
              data-sb-validations="required,confirm-password" />
            <label for="confirm-password">Confirm Password</label>
            <?php if (isset($validation_errors['confirm_password'])): ?>
              <div class="invalid-feedback" data-sb-feedback="confirm-password:required">
                <?= $validation_errors['confirm_password'] ?>
              </div>
            <?php endif; ?>

            <?php if (isset($validation_errors['password_match'])): ?>
              <div class="invalid-feedback" data-sb-feedback="password:required">
                <?= $validation_errors['password_match'] ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <button type="submit" class="btn btn-primary w-100">Submit</button>

          <p class="mt-3 text-center">Silahkan
            <a href="<?php echo base_url() . 'auth/signin' ?>">masuk</a>
            jika sudah punya akun
          </p>
          <p class="mt-5 text-center">
            <a href="<?php echo base_url() ?>">
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