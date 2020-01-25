@extends('site.layouts.blog.templateWithoutHeader')
@section('content-side')
<div class="post">
    <div class="himg" style="background-image:url('{{ $post->image() }}')">
    </div>
    <div class="content">
        <span></span>
        <h5 class="text-muted">{{ $post->category->name }} - criador por {{ $post->user->name }} - {{ $post->formatedDate() }}</h5>
        <a href="{{ $post->url() }}"><h2>{{ $post->title }}</h2></a>
        <p>{!! $post->content !!}</p>
        <hr>
<div class="row">
<div class="col-sm-12">
<h3>Comentários</h3>
</div>
</div>
@if($post->comments()->count()>0)
@foreach($post->comments as $comment)
<div class="row">
<div class="col-sm-2">
<div class="thumbnail">
<img class="img-responsive user-photo" src="{{ $comment->user->getThumbPhoto() }}">
</div><!-- /thumbnail -->
</div><!-- /col-sm-1 -->
<div class="col-sm-10">
<div class="panel panel-default">
<div class="panel-heading">
<strong>{{ $comment->user->getShortName() }}</strong> <span class="text-muted">{{ $comment->date()->diffForHumans() }}</span>

</div>
<div class="panel-body">
{{ $comment->content }}
</div><!-- /panel-body -->
</div><!-- /panel panel-default -->
</div><!-- /col-sm-5 -->
</div>
@endforeach
@else
<center>Nenhum comentário.</center>
@endif
<div class="row" style="margin-top:15px">
	<form action="{{ route('blog.comment') }}" method="POST" role="form">
    {{ csrf_field() }}
		<input type="hidden" name="post_id" value="{{ $post->id }}">
		<div class="form-group">
			<label for="">Mensagem</label>
			<textarea name="content" placeholder="Faça um comentário" class="form-control" rows="5"></textarea>
		</div>
		<button type="submit" class="btn btn-primary">Enviar mensagem</button>
	</form>
</div>
    </div>
</div>
@endsection