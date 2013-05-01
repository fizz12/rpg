@layout('layouts/main')

@section('pagetitle')Dashboard@endsection

@section('content')
@if(Session::has('status'))
<div id="status"><span class="label label-success">{{ Session::get('status') }}</span></div>
@elseif(Session::has('profile_error'))
<div id="status"><span class="label label-warning">{{ Session::get('profile_error') }}</span></div>
@elseif(Session::has('error'))
<div id="status"><span class="label label-warning">{{ Session::get('error') }}</span></div>
@elseif($errors->has())
<div id="validation-errors"><span class="label label-warning">
	<p>The following errors occurred:</p>
	<ul id="errors">
		@foreach($errors->all() as $err)
			<li>{{ $err }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="span8">
	<p><h2>WELCOME TO ZE DASHBOARD MOFO</h2></p>
	<p><a href="{{ URL::to('dashboard/account') }}">Edit Account Settings</a></p>
</div>
@endsection