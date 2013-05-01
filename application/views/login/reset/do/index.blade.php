@layout('layouts/main')

@section('pagetitle')Reset Password@endsection

@section('content')
@if(Session::has('error'))
<div class="span3">
	<span class="label label-important">{{ Session::get('error') }}</span>
</div><br />
@elseif($errors->has())
<div id="validation-errors">
<span class="label label-important">
	<p>The following errors occured:</p>
	<ul id="errors">
		@foreach($errors->all() as $err)
			<li>{{ $err }}</li>
		@endforeach
	</ul>
</span>
</div>
@elseif(Session::has('status'))
<div class="span3">
	<span class="label label-success">{{ Session::get('status') }}</span>
</div><br />
@endif
<div class="span8">
	<?php echo Form::open('user/doreset'); ?>
		<?php echo Form::label('token', 'Reset Token'); ?>
		<?php echo Form::text('token', $token); ?>
		<!-- password field -->
		<?php echo Form::label('password', 'New Password'); ?>
		<?php echo Form::password('password'); ?>

		<?php echo Form::label('passconf', 'Confirm New Password'); ?>
		<?php echo Form::password('passconf'); ?>

		<!-- login button -->
		<?php echo Form::submit('Reset'); ?>
	<?php echo Form::close(); ?>
</div>
@endsection