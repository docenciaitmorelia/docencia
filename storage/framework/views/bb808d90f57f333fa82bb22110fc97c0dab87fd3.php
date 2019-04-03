<?php $__env->startSection('content'); ?>
<?php if(Auth::user()->rol == 'DivEstProf'): ?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Registrar los pasos de cada Opción de Titulación</h3>
        <?php echo $__env->make('procesotitulacion.fragment.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <form action="<?php echo e(route('procesotitulacion.store')); ?>" method="POST">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" required>
            <div class="col-md-4">
          		<label for="opcion" class="control-label">Opción de titulación</label>
          		<select id="opcion" name="opcion" class="form-control">
          			<option value="">Seleccione Opción de titulación</option>
          			<?php $__currentLoopData = $opcion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $op): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          				<option value="<?php echo $op->id; ?>"><?php echo e($op->reticula); ?>/<?php echo e($op->nombre_opcion); ?></option>
          			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          		</select>
        	  </div>

          <div class="col-md-4">
              <label class="control-label" for="orden">Paso número:</label>
              <input maxlength="10" class="form-control" type="text" id="orden" name="orden" style="text-transform:uppercase;" required>
          </div>

          <div class="col-md-4">
              <label class="control-label" for="descripcion">Descripción del paso:</label>
              <select id="descripcion" name="descripcion" class="form-control">
                <option value="" selected>Seleccione Opción de titulación</option>
                  <option value="Registrar Opción de Titulación">Registrar Opción de Titulación</option>
                  <option value="Asignación de Sinodales">Asignación de Sinodales</option>
                  <option value="Impresión Definitiva">Impresión Definitiva</option>
                  <option value="Asignación de Revisores">Asignación de Revisores</option>
                  <option value="Liberación de Proyecto">Liberación de Proyecto</option>
                  <option value="Invitación a Ceremonia de Titulación">Invitación a Ceremonia de Titulación</option>
              </select>
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
                <form action="<?php echo e(route('procesotitulacion.index')); ?>" method="POST" id='form-modal1'>
                    <?php echo e(csrf_field()); ?>

                </form>
                <p>¿Seguro de que desea cancelar?</p>
              </div>
              <div class="modal-footer">
                <a href="<?php echo e(route('procesotitulacion.index')); ?>" type="button" class="btn btn-primary" >Aceptar</a>
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
<?php /* /Users/aapintor/laravel/docencia/resources/views/procesotitulacion/create.blade.php */ ?>