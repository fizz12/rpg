@layout('layouts/main')

@section('pagetitle')Profile@endsection

@section('content')
@if(Session::has('status'))
<div id="status"><span class="label label-success">{{ Session::get('status') }}</span></div>
@endif
<p><?php echo 'id:'. $id;?></p><br />
<p>PROFILE PAGE</p>
@endsection