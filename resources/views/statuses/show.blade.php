@extends('layouts.app')

@section('content')
<div class="ui container segments">
	<div class="ui grid">
		<div class="ui row">
			{{-- Status itself --}}
			<div class="ui twelve wide column">
				@segment
				<a href="#">
					{{ $status->ownerName }}
				</a> posted
				@endsegment
				@segment
					{{ $status->body }}
				@endsegment
				@segment
					@auth
					<form class="ui reply form" method="post" action="{{ route('post_comment', ['status' => $status->id]) }}">
						@csrf
						<div class="field">
							<input type="text" autocomplete="off" name="body" id="comment" placeholder="Write a comment" onsubmit="submit" autofocus>
						</div>
					</form>
					@else
						<div class="ui fluid center aligned container">
							<div class="ui compact floating message">
								<p>Please <a href="{{ route('login') }}">Login</a> to comment.</p>
							</div>
						</div>
					@endauth
				@endsegment
				@segment(['class' => 'comments'])
					<h3 class="ui dividing header">Comments</h3>
					<comments-component :status-id="{{ $status->id }}"></comments-component>
				@endsegment
			</div>
			{{-- Metadata --}}
			<div class="ui four wide column">
					@segment
						This status was published {{ $status->created_at->diffForHumans() }} by <a href="#">{{ $status->ownerName }}</a> and currently has {{ $status->comments_count }} {{ str_plural('comment', $status->comments_count) }}.
					@endsegment
			</div>
		</div>
	</div>
</div>
@endsection
