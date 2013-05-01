@layout('layouts/main')

@section('pagetitle')Login@endsection

@section('content')
@if(Session::has('error'))
<div class="span3">
	<span class="label label-important">{{ Session::get('error') }}</span>
</div><br />
@endif
<div class="span8">
	<?php echo Form::open('user/authenticate'); ?>
		<!-- username field -->
		<?php echo Form::label('username', 'Username'); ?>
		<?php echo Form::text('username'); ?>

		<!-- password field -->
		<?php echo Form::label('password', 'Password'); ?>
		<?php echo Form::password('password'); ?>

		<!-- login button -->
		<?php echo Form::submit('Login'); ?>
	<?php echo Form::close(); ?>
	<div id="forgot">
		<p><?php echo HTML::link_to_action('login@reset', 'Forgotten your password?'); ?></p>
	</div>
</div>
@endsection