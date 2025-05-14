<main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center">
                <a href="index.html" class="d-block text-center align-items-center w-auto">
                  <img src="<?= base_url('assets/img/logohawe.png')?>" alt="" width="50%">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <p class="text-center small">"Special gift for a special moment"</p>
                  </div>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>
                  <form class="row g-3 needs-validation" novalidate action="<?= base_url('index.php/auth/do_login')?>" method="post">

                    <div class="col-12">
                      <label for="youremail" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                        <input type="email" name="email" class="form-control" id="youremail" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> -->
                    <div class="col-12">
                      <button class="btn btn-dark w-100" type="submit">Masuk</button>
                    </div>
                    <!-- <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                    </div> -->
                  </form>

                </div>
              </div>

              <div class="credits">
                Designed by <a href="#">Scriptechlight</a>
              </div>

            </div>
          </div>
        </div>

      </section>
    </div>
  </main><!-- End #main -->