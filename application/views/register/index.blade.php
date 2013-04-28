@layout('layouts/main')

@section('pagetitle')Register@endsection

@section('content')
@if($errors->has())
	<div id="validation-errors"><span class="label label-important">
		<p>The following errors occured:</p>
		<ul id="errors">
			@foreach($errors->all() as $err)
				<li>{{ $err }}</li>
			@endforeach
		</ul>
	</div>
@endif
<div class="span8">
	<?php echo Form::open('user/register'); ?>
		<!-- username field -->
		<?php echo Form::label('username', 'Username'); ?>
		<?php echo Form::text('username'); ?>

		<!-- email field -->
		<?php echo Form::label('email', 'Email'); ?>
		<?php echo Form::text('email'); ?>

		<!-- email confirm field -->
		<?php echo Form::label('emailconf', 'Confirm Email'); ?>
		<?php echo Form::text('emailconf'); ?>

		<!-- password field -->
		<?php echo Form::label('password', 'Password'); ?>
		<?php echo Form::password('password'); ?>

		<!-- password confirm field -->
		<?php echo Form::label('passconf', 'Password Again'); ?>
		<?php echo Form::password('passconf'); ?>

		<!-- acccept ToS field -->
		<?php echo Form::label('tos', 'Terms of Service'); ?>
		<?php echo Form::checkbox('tos', true); ?>

		<!-- login button -->
		<?php echo Form::submit('Register');?>
	<?php echo Form::close(); ?>
</div>
@endsection