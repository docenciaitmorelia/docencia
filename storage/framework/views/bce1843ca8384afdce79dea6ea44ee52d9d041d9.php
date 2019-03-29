<?php if(Session::has('info')): ?>
	<div class="alert alert-dismissible alert-info">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo e(Session::get('info')); ?>

	</div>
<?php endif; ?>
<?php /* /Users/aapintor/laravel/docencia/resources/views/opcionestitulacion/fragment/info.blade.php */ ?>