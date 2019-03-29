<?php $__env->startSection('title', 'Acceder'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <div class="card-body">
                  <h3 class="card-title"><?php echo e(__('Acceder')); ?></h3>

                      <form method="POST" action="<?php echo e(route('login')); ?>">
                          <?php echo csrf_field(); ?>

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Dirección de E-Mail')); ?></label>

                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                  <?php if($errors->has('email')): ?>
                                      <span class="invalid-feedback" role="alert">
                                          <strong><?php echo e($errors->first('email')); ?></strong>
                                      </span>
                                  <?php endif; ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Contraseña')); ?></label>

                              <div class="col-md-6">
                                  <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                  <?php if($errors->has('password')): ?>
                                      <span class="invalid-feedback" role="alert">
                                          <strong><?php echo e($errors->first('password')); ?></strong>
                                      </span>
                                  <?php endif; ?>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-6 offset-md-4">
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                      <label class="form-check-label" for="remember">
                                          <?php echo e(__('Recordarme en este navegador')); ?>

                                      </label>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button type="submit" class="btn waves-effect waves-light btn-flat amarillomarista"><i class="material-icons right">send</i>
                                      <?php echo e(__('Acceder')); ?>

                                  </button>

                                  <?php if(Route::has('password.request')): ?>
                                      <a class="btn btn-link btn-flat amarillomarista" href="<?php echo e(route('password.request')); ?>"><i class="material-icons right">search</i>
                                          <?php echo e(__('¿Olvidaste tu Contraseña?')); ?>

                                      </a>
                                  <?php endif; ?>
                              </div>
                          </div>
                      </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /Users/aapintor/laravel/docencia/resources/views/auth/login.blade.php */ ?>