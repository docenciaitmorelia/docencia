<?php $__env->startSection('content'); ?>
<?php if(Auth::user()->rol == 'DivEstProf'): ?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-4">
					<a href="<?php echo e(route('opcionestitulacionCtl.create')); ?>" class="btn btn-raised btn-primary"><i class="material-icons">add</i></a>
				</div>
        <!-- Elocuent para cuadro de búsqueda -->
				<form action="" method="GET" class="form-horizontal">
				<div class="col-md-6 form-group">
					<input type="text" id="s" name="s" style="text-transform:uppercase;" placeholder="Buscar opción de titulación..." class="form-control">
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-raised btn-primary"><i class="material-icons">search</i></button>
				</div>
				</form>
        <!-- Fin Elocuent para cuadro de búsqueda -->


			<?php echo $__env->make('fragment.info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="card">
        <div class="card-body">
    			<h3 class="card-title">Opciones de Titulación</h3>
    			<table class="table table-striped table-hover">
    				<thead>
    					<tr>
    						<th>Opción de Titulación</th>
    						<th>Nombre</th>
    			      <th>Detalle</th>
    						<th>Plan de Estudios</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php $__currentLoopData = $Array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    						<tr>
    							<td>
    								<strong><?php echo e($item->opcion_titulacion); ?></strong>
    							</td>
    							<td>
    								<strong><?php echo e($item->nombre_opcion); ?></strong>
    							</td>
                  <td>
                      <strong><?php echo e($item->detalle_opcion); ?></strong>
                  </td>
                  <td>
                      <strong><?php echo e($item->plan_de_estudios); ?></strong>
                  </td>
    							<td width="20px">
    								<a href="<?php echo e(route('opcionestitulacionCtl.edit', $item->id)); ?>"class="btn btn-raised btn-primary">
    									<i class="material-icons">create</i>
    								</a>
    							</td>
    							<td width="20px">
    								<form action="<?php echo e(route('opcionestitulacionCtl.destroy', $item->id)); ?>" method="POST">
    									<?php echo e(csrf_field()); ?>

    									<input type="hidden" name="_method" value="DELETE">
    									<button class="btn btn-raised btn-primary"><i class="material-icons">clear</i></button>
    							</td>
    						</tr>
    					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    				</tbody>
    			</table>
        </div>
      </div>
		</div>
	</div>
</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /Users/aapintor/laravel/docencia/resources/views/opcionestitulacion/index.blade.php */ ?>