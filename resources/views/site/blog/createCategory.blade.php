@extends('site.layouts.blog.templateWithoutHeader')
@section('content-side')
<div class="post">
<div class="content">
    <form method="POST" role="form">
    {{ csrf_field() }}
        <legend>Criar categoria</legend>
        <div class="form-group">
            <label for="category_title">Nome da categoria:</label>
            <input type="text" class="form-control" id="category_title" name="name" value="{{ old('name') }}" placeholder="Nome da categoria">
        </div> 
        <div class="text-right">
        <button type="submit" class="btn btn-primary">Criar categoria</button>
        </div>
    </form>
</div>
</div>
@endsection