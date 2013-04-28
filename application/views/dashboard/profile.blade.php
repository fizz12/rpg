@layout('layouts/main')

@section('pagetitle')Profile@endsection

@section('content')
@if(Session::has('status'))
<div id="status"><span class="label label-success">{{ Session::get('status') }}</span></div>
@endif
@if($user->avatar)
<div id="avatar" class="span3">
	<img src="<?php echo URL::base().'/avatars/'.$user->avatar;?>" alt="<?php echo $user->username.'\'s';?> Avatar" />
</div>
@else
<div id="avatar" class="span3">
	<img src="<?php echo URL::base().'/avatars/defaultavatar.jpg';?>" alt="<?php echo $user->username.'\'s';?> Avatar" />
</div>
@endif
<div class="span7">
	<div id="profile">
		<p><strong><u>{{ $user->username }}</u></style></strong></p>
		<hr />
		<div id="stats">
			<ul>
				<li>Strength: {{ $user->str }}</li>
				<li>Agility: {{ $user->agi }}</li>
				<li>Defense: {{ $user->def }}</li>
				<li>Total: {{ $user->str+$user->agi+$user->def }}</li>
			</ul>
		</div>
		<div id="signature">
			THIS IS AN PLACEHOLDER!
		</div>
	</div>
</div>
@endsection