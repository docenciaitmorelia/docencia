<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?php echo e(__('Editar al Usuario')); ?> <?php echo e($Usuario->name); ?></h3>
                    <form method="POST" action="<?php echo e(route('usuariosCtl.update', $Usuario->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo e(method_field('PUT')); ?>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nombre')); ?></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e($Usuario->name); ?>" placeholder="Introduzca Su Nombre Completo" required autofocus>
                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rol" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Rol')); ?></label>
                            <div class="col-md-6">
                                <select id="rol" type="text" class="form-control<?php echo e($errors->has('rol') ? ' is-invalid' : ''); ?>" name="rol">
                                  <option value="<?php echo e($Usuario->rol); ?>" selected><?php echo e($Usuario->rol); ?></option>
                                  <option value="Alumno">Alumno</option>
                                  <option value="Docente">Docente</option>
                                  <option value="DivEstProf">Jefe de División de Estudios Profesionales</option>
                                  <option value="Jefe de Docencia">Jefe de Docencia</option>
                                  <option value="Administrador">Administrador</option>
                                </select>
                                <?php if($errors->has('rol')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('rol')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="clave_area" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Área')); ?></label>
                            <div class="col-md-6">
                                <select id="clave_area" type="text" class="form-control<?php echo e($errors->has('clave_area') ? ' is-invalid' : ''); ?>" name="clave_area" required>
                                  <option value="<?php echo e($Usuario->clave_area); ?>"><?php echo e($Usuario->descripcion_area); ?></option>
                                  <?php $__currentLoopData = $Areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($area->clave_area); ?>"><?php echo e($area->descripcion_area); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('clave_area')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('clave_area')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Dirección de E-Mail')); ?></label>

                            <div class="col-md-6">
                                <input readonly id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e($Usuario->email); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Constraseña')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                  Tu contraseña debe tener, al menos 8 caracteres.
                                </small>
                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirma tu Contraseña')); ?></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-flat" name="submit"><i class="material-icons right">send</i>
                                    <?php echo e(__('Registrar')); ?>

                                </button>
                                <a href="<?php echo e(route('admin')); ?>" class="btn btn-primary btn-flat" ><i class="material-icons right">cancel</i>
                                    <?php echo e(__('Cancelar')); ?>

                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>