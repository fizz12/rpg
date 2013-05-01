@layout('layouts/main')

@section('pagetitle')Send Password Reset@endsection

@section('content')
@if(Session::has('error'))
<div class="span3">
	<span class="label label-important">{{ Session::get('error') }}</span>
</div><br />
@elseif(Session::has('status'))
<div class="span3">
	<span class="label label-success">{{ Session::get('status') }}</span>
</div><br />
@endif
<div class="span8">
	<?php echo Form::open('user/sendreset'); ?>
		<!-- username field -->
		<?php echo Form::label('username', 'Username'); ?>
		<?php echo Form::text('username'); ?>

		<!-- login button -->
		<?php echo Form::submit('Send Reset Email'); ?>
	<?php echo Form::close(); ?>
</div>
@endsection