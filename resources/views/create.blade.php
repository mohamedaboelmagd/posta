@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Posts</div>

				<div class="panel-body">
					<form class="form-custom" action='{{url("create")}}' method="post">
						<textarea rows="5" cols="80" name="name"></textarea>
						<br/>
						<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
						<input type="submit" value="Save" class="btn btn-md btn-success" name="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
