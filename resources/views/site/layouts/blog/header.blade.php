@if(App\Models\Blog\Post::count()>=3)
@php
$first_post = App\Models\Blog\Post::orderBy('created_at', 'DESC')->first();
$two_posts = App\Models\Blog\Post::orderBy('created_at', 'DESC')->where('id','!=', $first_post->id)->limit(2)->get();
@endphp
<div class="slidebox row" style="margin-top:95px">
	<div class="col-md-8" style="padding:0;">
		<a href="{{ $first_post->url() }}"><div class="slideimg" style="background-image:url('{{ $first_post->image() }}');">
			<div class="sfooter">
				<h2>{{ $first_post->shortTitle() }}</h2>
				<span>{{ $first_post->contentWithoutHtml(28) }}</span>
			</div>
		</div>
	</a>
</div>
<div class="col-md-4" style="padding:0;">
@foreach($two_posts as $tpost)
	<a href="{{ $tpost->url() }}">
		<div class="minslideimg" style="background-image:url('{{ $tpost->image() }}');">
			<div class="sfooter">
				<h5>{{ $tpost->shortTitle() }}</h5>
				<small>{{ $tpost->contentWithoutHtml(28) }}</small>
			</div>
		</div>
	</a>
@endforeach
</div>
</div>
@else
<div style="height:100px"></div>
@endif