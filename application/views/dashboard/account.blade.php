@layout('layouts/main')

@section('pagetitle')Dashboard@endsection

@section('content')
@if(Session::has('status'))
<div id="status"><span class="label label-success">{{ Session::get('status') }}</span></div>
@elseif(Session::has('error'))
<div id="error"><span class="label label-warning">{{ Session::get('error') }}</span></div>
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
	<div id="welcome">
			<h3>Welcome, {{ $user->username }}!</h3>
	</div><hr />
	<div id="userinfo">
		<div id="emailchange">
			<span class="label label-info"><b>Change Email</b> (Current email: {{ $user->email }})</span>
			<?php echo Form::open('dashboard/change_email');?>
				<!-- Change Email -->
				<?php echo Form::hidden('uid', base64_encode($user->id)); ?>
				<?php echo Form::label('email', 'New Email'); ?>
				<?php echo Form::text('email');?>
				<?php echo Form::label('emailconf', 'Confirm New Email'); ?>
				<?php echo Form::text('emailconf'); ?>
				<?php echo Form::label('password', 'Current Password'); ?>
				<?php echo Form::password('password'); ?>
				<br />
				<?php echo Form::submit('Change Email'); ?>
			<?php echo Form::close();?>
		</div><br />
		<div id="passwordchange">
			<span class="label label-info"><b>Change Password</b></span>
			<?php echo Form::open('dashboard/change_password'); ?>
				<!-- Change Password -->
				<?php echo Form::hidden('uid', base64_encode($user->id)); ?>
				<?php echo Form::label('newpass', 'New Password'); ?>
				<?php echo Form::password('newpass');?>
				<?php echo Form::label('newpassconf', 'Confirm New Password'); ?>
				<?php echo Form::password('newpassconf'); ?>
				<?php echo Form::label('password', 'Current Password'); ?>
				<?php echo Form::password('password'); ?>
				<br />
				<?php echo Form::submit('Change Password'); ?>
			<?php echo Form::close(); ?>
		</div>
	</div>
	<p><a href="../dashboard">Back to Dashboard</a></p>
</div>
@endsection