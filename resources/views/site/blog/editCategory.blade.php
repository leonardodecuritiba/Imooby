@extends('site.layouts.blog.templateWithoutHeader')
@section('content-side')
<div class="post">
<div class="content">
    <form method="POST" action="{{ route('blog.updateCategory') }}" role="form">
    {{ csrf_field() }}
    <input type="hidden" name="category_id" value="{{ $category->id }}">
        <legend>Editar categoria</legend>
        <div class="form-group">
            <label for="category_title">Nome da categoria:</label>
            <input type="text" class="form-control" id="category_title" name="name" value="{{ $category->name }}" placeholder="Nome da categoria">
        </div> 
        <div class="text-right">
        <button type="submit" class="btn btn-primary">Editar categoria</button>
        </div>
    </form>
</div>
</div>
@endsection