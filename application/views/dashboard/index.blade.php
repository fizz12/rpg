@layout('layouts/main')

@section('pagetitle')Dashboard@endsection

@section('content')
@if(Session::has('status'))
<div id="status"><span class="label label-success">{{ Session::get('status') }}</span></div>
@endif
<p>WELCOME TO DIE DASHBOARD NIG</p>
@endsection