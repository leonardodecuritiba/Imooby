@php
$isAdmin = false;
if (\Auth::check() && \Auth::user()->isAdmin()) {
	$isAdmin = true;
}
@endphp
@extends('site.layouts.blog.template')
@section('content-side')
@if(isset($emptyPosts) && $emptyPosts)
<center>Nenhum resultado encontrado para '{{ $_GET['q'] }}'.</center>
@else
@foreach($posts as $post)
<div class="post">
    <div class="himg" style="background-image:url('{{ $post->image() }}')">
    </div>
    <div class="content">
        <span></span>
        <h5 class="text-muted">{{ $post->category->name }} - criador por {{ $post->user->name }} - {{ $post->formatedDate() }}</h5>
        <a href="{{ $post->url() }}"><h2>{{ $post->title }}{!! $isAdmin ? ' <a href="#" class="delete-post" data-title="'.$post->title.'" data-url="'.route('blog.deletePost', ['id'=>$post->id]).'"><i class="fa fa-trash-o"></i></a> <a href="'.route('blog.editPost', ['id'=>$post->id]).'"><i class="fa fa-pencil"></i></a>' : '' !!}</h2></a>
        <p>{!! $post->contentWithoutHtml(128) !!}</p>
        <a href="{{ $post->url() }}">Continuar lendo...</a>
    </div>
</div>
@endforeach
@if($isAdmin)
<div class="post">
<div class="content">
<h4>Administrador</h4>
<ul>
    <li><a href="{{ route('blog.createPost') }}">Criar postagem</a></li>
    <li><a href="{{ route('blog.createCategory') }}">Criar uma categoria</a></li>
</ul>
</div>
</div>
@endif
@endif
{{ $posts_paginate }}
@endsection
@if($isAdmin)
@section('scripts_content')
<script>
$(document).ready(function(){
	$( ".delete-post" ).click(function(){
        var delUrl = $(this).attr('data-url');
        var dTitle = $(this).attr('data-title');
		$.confirm({
            title: 'Excluir postagem',
            content: 'Tem certeza que deseja excluir a postagem "'+dTitle+'"?',
            buttons: {
                confirm: {
                    text: 'Confirmar',
                    btnClass: 'btn btn-info',
                    keys: ['enter', 'shift'],
                    action: function() {
                        window.location.href = delUrl;
                    }
                },
                cancel: {
                    text: 'Cancelar'
                }
            }
        });
	});
	});
	</script>
	@endsection
	@endif