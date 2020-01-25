@extends('site.layouts.blog.templateWithoutHeader')
@section('extra_styles')
<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.4/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.4/css/froala_style.min.css' rel='stylesheet' type='text/css' />
@endsection
@section('content-side')
<div class="post">
<div class="content">
<h4>Administrador</h4>
<ul>
	<li><a href="{{ route('blog.createPost') }}">Criar postagem</a></li>
	<li><a href="{{ route('blog.createCategory') }}">Criar uma categoria</a></li>
</ul>
</div>
</div>
@endsection
@section('extra_script')
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.4/js/froala_editor.min.js'></script>
<script> $(function() { $('.textarea').froalaEditor() }); </script>
@endsection