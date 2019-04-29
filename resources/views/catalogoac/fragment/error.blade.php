@if(count($errors))
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
		@foreach($errors->all() as $error)
			<p> {{ $error }}</p>
		@endforeach
</div>
@endif