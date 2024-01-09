@if(Session::has('success'))
	<div class="alert alert-success alert-dismissible fade show flex justify-between">
		<div class="alert-body">
			<strong>Success!</strong> {{Session::get('success')}}
		</div>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	{{ Session::forget('success') }}
@endif

@if(Session::has('error'))
	<div class="alert alert-danger alert-dismissible fade show flex justify-between">
		<div class="alert-body">
			<strong>Error!</strong> {{Session::get('error')}}
		</div>
		<button type="button" class="close border border-dark" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	{{ Session::forget('error') }}
@endif

<script>
	$(document).ready(function(){
		setTimeout(function() {
			$('.alert').fadeOut('slow');
		}, 5000);
		setTimeout(function() {
			$('.alert').remove();
		}, 6000);
	});
</script>