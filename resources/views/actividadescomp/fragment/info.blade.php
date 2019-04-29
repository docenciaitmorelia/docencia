@if(Session::has('info'))
	<div class="alert alert-dismissible alert-info">
		<button type="button" class="close" data-dismiss="alert">×</button>
		{{ Session::get('info') }}
	</div>
@endif