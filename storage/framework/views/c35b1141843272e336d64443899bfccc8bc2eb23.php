<?php $__env->startSection('content'); ?>
<?php if(Auth::user()->rol == 'DivEstProf'): ?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Registro de Opciones de Titulación</h3>
        <?php echo $__env->make('fragment.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <form action="<?php echo e(route('opcionestitulacionCtl.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group col-md-6">
                <label for="opcion_titulacion" class="bmd-label-floating col-form-label"><?php echo e(__('Opción de Titulación')); ?></label>
                    <input maxlength="10" id="opcion_titulacion" type="text" class="form-control<?php echo e($errors->has('opcion_titulacion') ? ' is-invalid' : ''); ?>" name="opcion_titulacion" value="" placeholder="I" required autofocus>
                    <?php if($errors->has('opcion_titulacion')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('opcion_titulacion')); ?></strong>
                        </span>
                    <?php endif; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="nombre_opcion" class="bmd-label-floating col-form-label"><?php echo e(__('Nombre')); ?></label>
                    <input maxlength="255" id="nombre_opcion" type="text" class="form-control<?php echo e($errors->has('nombre_opcion') ? ' is-invalid' : ''); ?>" name="nombre_opcion" value="" placeholder="Titulación Integral Por ..." required>
                    <?php if($errors->has('nombre_opcion')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('nombre_opcion')); ?></strong>
                        </span>
                    <?php endif; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="detalle_opcion" class="bmd-label-floating col-form-label"><?php echo e(__('Descripción')); ?></label>
                    <input maxlength="255" id="detalle_opcion" type="text" class="form-control<?php echo e($errors->has('detalle_opcion') ? ' is-invalid' : ''); ?>" name="detalle_opcion" value="" placeholder="Ejemplo: Producto de Investigación..." required>
                    <?php if($errors->has('detalle_opcion')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('detalle_opcion')); ?></strong>
                        </span>
                    <?php endif; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="reticula" class="bmd-label-floating col-form-label"><?php echo e(__('Año de la Retícula Para los Planes de Estudio')); ?></label>
                    <select id="reticula" type="text" class="form-control<?php echo e($errors->has('reticula') ? ' is-invalid' : ''); ?>" name="reticula" value="" required>
                      <?php $__currentLoopData = $Array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option id="reticula" value="<?php echo e($item->reticula); ?>"><?php echo e($item->reticula); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('reticula')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('reticula')); ?></strong>
                        </span>
                    <?php endif; ?>
            </div>


          <p class="col-md-12 form-group">
              <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
              <a name="cancel" id="cancel" data-toggle="modal" data-target="#modal1" href="#modal1" class="btn btn-raised btn-primary">Cancelar</a>
          </p>
        </form>

        <!-- Modal Structure -->
        <div id="modal1" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo e(route('opcionestitulacionCtl.index')); ?>" method="POST" id='form-modal1'>
                    <?php echo e(csrf_field()); ?>

                </form>
                <p>¿Seguro de que desea cancelar?</p>
              </div>
              <div class="modal-footer">
                <a href="<?php echo e(route('opcionestitulacionCtl.index')); ?>" type="button" class="btn btn-primary" >Aceptar</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /Users/aapintor/laravel/docencia/resources/views/opcionestitulacion/create.blade.php */ ?>