@layout('layouts/main')

@section('pagetitle')Login@endsection

@section('content')
@if(Session::has('loginerror'))
<div class="span3">
	<span class="label label-important">{{ Session::get('loginerror') }}</span>
</div><br />
@elseif(Session::has('autherror'))
<div class="span3">
	<span class="label label-important">{{ Session::get('autherror') }}</span>
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
		<?php echo Form::submit('Login');?>
	<?php echo Form::close(); ?>
</div>
@endsection