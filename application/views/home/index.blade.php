@layout('layouts/main')


@section('pagetitle')Index@endsection

@section('content')
@if(Session::has('status'))
	<span class="label label-warning">{{ Session::get('status') }}</span>
@endif
<p>This be index content hyarr</p>
@endsection
