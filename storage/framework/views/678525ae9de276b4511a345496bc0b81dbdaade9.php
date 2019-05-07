<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-body">
      <?php if(Auth::user()->rol == 'Administrador'): ?>
        <h3 class="card-title"><?php echo e(__('Administrar Usuarios')); ?></h3>
        <div class="row">
          <div class="col s12">
              <?php $__currentLoopData = $Usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo e($usuario->name); ?></h5>
                        <p class="card-text">Id: <?php echo e($usuario->id); ?></p>
                        <p class="card-text">Rol: <?php echo e($usuario->rol); ?></p>
                        <p class="card-text">Área: <?php echo e($usuario->descripcion_area); ?></p>
                        <p class="card-text">Email: <?php echo e($usuario->email); ?></p>
                        <a href="<?php echo e(route('usuariosCtl.edit',$usuario->id)); ?>" class="card-link"><i class="material-icons">create</i></a>
                        <a data-toggle="modal" data-target="#modal<?php echo e($usuario->id); ?>" class="card-link modal-trigger" href="#modal<?php echo e($usuario->id); ?>"><i class="material-icons">delete</i></a>

                        <!-- Modal Structure -->
                        <div id="modal<?php echo e($usuario->id); ?>" class="modal" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Eliminar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="<?php echo e(route('usuariosCtl.destroy',$usuario->id)); ?>" method="POST" id='form-<?php echo e($usuario->id); ?>'>
                                    <?php echo e(csrf_field()); ?>

                                    <?php echo e(method_field('DELETE')); ?>

                                </form>
                                <p>¿Seguro que deseas eliminar el usuario <?php echo e($usuario->name); ?>?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('form-<?php echo e($usuario->id); ?>').submit();">Sí, Quiero Eliminar el Registro</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        <?php else: ?>
          <h3 class="card-title"><?php echo e(__('Usuario No Autorizado')); ?></h3>
            <p class="card-text">No tienes los suficientes privilegios para acceder a este módulo.</p>
        <?php endif; ?>


        <?php if(Auth::user()->rol == 'Administrador'): ?>
          <a type="button" href="<?php echo e(route('usuariosCtl.create')); ?>" class="btn btn-primary bmd-btn-fab">
            <i class="material-icons">add</i>
          </a>
          <a type="button" href="<?php echo e(route('home')); ?>" class="btn btn-primary bmd-btn-fab">
            <i class="material-icons">home</i>
          </a>
        <?php endif; ?>
        <script type="text/javascript">
        $('.modal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
        })
        </script>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>