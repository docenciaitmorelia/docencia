<?php $__env->startSection('content'); ?>
<?php if(Auth::user()->rol == 'DivEstProf'): ?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-4">
					<a href="<?php echo e(route('procesotitulacion.create')); ?>" class="btn btn-raised btn-primary"><i class="material-icons">add</i></a>
				</div>
				<form action="" method="GET" class="form-horizontal">
  				<div class="col-md-6 form-group">
  					<input maxlength="255" type="text" id="s" name="s" style="text-transform:uppercase;" placeholder="Buscar..." class="form-control">
  				</div>
  				<div class="col-md-2">
  					<button type="submit" class="btn btn-raised btn-primary"><i class="material-icons">search</i></button>
  				</div>
				</form>
  			<br>
  			<br>
  			<br>
  			<br>
        <?php echo $__env->make('procesotitulacion.fragment.info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  			<h3>Proceso de Titulaciones</h3>
        <?php $idr=0; ?>
        <div id="accordion2">
        <?php $__currentLoopData = $reticulas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reticula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php $idr=$idr+1; ?>
            <div class="card">
              <div class="card-header" id="headingr<?php echo e($idr); ?>">
                <h3 class="mb-0">
                  <a class="btn btn-link" data-toggle="collapse" data-target="#collapser<?php echo e($idr); ?>" aria-expanded="true" aria-controls="collapser<?php echo e($idr); ?>">
                    Retícula: <b><?php echo e($reticula); ?></b>
                  </a>
                </h3>
              </div>
              <div id="collapser<?php echo e($idr); ?>" class="collapse" aria-labelledby="headingr<?php echo e($idr); ?>" data-parent="#accordion2">
                <div class="card-body">
                  <!--Acordion para planes de estudio -->
                  <div id="accordion<?php echo e($idr); ?>">
                    <?php $id=0; ?>
                    <?php $__currentLoopData = $opciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($reticula != $item['reticula']): ?>
                        <?php continue; ?>
                      <?php endif; ?>
                      <?php $id=$id+1 ?>
                      <div class="card">
                        <div class="card-header" id="heading<?php echo e($id); ?>">
                          <h3 class="mb-0">
                            <a class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo e($idr); ?><?php echo e($id); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($idr); ?><?php echo e($id); ?>">
                              <?php echo e($item['nombre_opcion']); ?>

                            </a>
                          </h3>
                        </div>

                        <div id="collapse<?php echo e($idr); ?><?php echo e($id); ?>" class="collapse" aria-labelledby="heading<?php echo e($id); ?>" data-parent="#accordion<?php echo e($idr); ?>">
                          <div class="card-body">
                            <table class="table table-striped table-hover ">
                              <thead>
                                <tr>
                                  <th>Retícula</th>
                                  <th>No. Paso</th>
                                  <th>Descripción</th>
                                  <th colspan="1">&nbsp;</th>
                                  <th colspan="1">&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $__currentLoopData = $procesotitulacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procesot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if($item['nombre_opcion'] != $procesot->nombre_opcion || $reticula != $procesot->reticula): ?>
                                    <?php continue; ?>
                                  <?php endif; ?>
                                  <tr>
                                    <td>
                                      <strong><?php echo e($procesot->reticula); ?></strong>
                                    </td>
                                    <td>
                                      <strong><?php echo e($procesot->orden); ?></strong>
                                    </td>
                                    <td>
                                        <strong><?php echo e($procesot->descripcion); ?></strong>
                                    </td>
                                    <td width="20px">
                                      <a href="<?php echo e(route('procesotitulacion.edit', $procesot->id)); ?>"class="btn btn-raised btn-primary">
                                        <i class="material-icons">create</i>
                                      </a>
                                    </td>
                                    <td width="20px">
                                      <form action="<?php echo e(route('procesotitulacion.destroy', $procesot->id)); ?>" method="POST">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-raised btn-primary"><i class="material-icons">clear</i></button>
                                      </form>
                                    </td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div> <!--end accordion-->
                </div>
              </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div> <!--end accordion2-->



      </div> <!--end card body-->
    </div> <!--end card-->
  </div> <!--end col-->
</div> <!--end row-->
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /Users/aapintor/laravel/docencia/resources/views/procesotitulacion/index.blade.php */ ?>