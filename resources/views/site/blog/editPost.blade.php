@extends('site.layouts.blog.templateWithoutHeader')
@section('extra_styles')
<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.4/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.4/css/froala_style.min.css' rel='stylesheet' type='text/css' />
@endsection
@section('content-side')
@if(App\Models\Blog\Category::count()>0)
<div class="post">
<div class="content">
    <form method="POST" action="{{ route('blog.updatePost') }}" role="form">
    {{ csrf_field() }}
    <input type="hidden" name="to_update" value="1">
    <input type="hidden" name="post_id" value="{{ $post->id }}">
        <legend>Editar postagem</legend>
        <div class="form-group">
               <div action="{{ route('blog.postPhoto', ['id'=>$post->id]) }}"
               class="dropzone"
               id="dropzoneFoto">
               </div>
        </div>
        <div class="form-group">
            <label for="post_title">Titulo</label>
            <input type="text" name="title" value="{{ $post->title }}" class="form-control" id="post_title" placeholder="Titulo da postagem">
        </div>
        <div class="form-group">
            <label for="post_cat">Categoria</label>
            <select name="category" id="post_cat" class="form-control" required="required">
                @foreach(App\Models\Blog\Category::getAll() as $category)
                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="post_cat">Conteúdo</label>
            <textarea class="textarea" name="content" placeholder="Conteúdo do postagem">{{ $post->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="">Descrição (meta):</label>
            <textarea name="description" class="form-control" value="{{ old('description') }}" maxlength="160" placeholder="Descrição da postagem"></textarea>
        </div>
        <div class="text-right">
        <button type="submit" class="btn btn-primary">Editar postagem</button>
        </div>
    </form>

</div>
</div>
@else
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    Nenhuma categoria criada, <a href="{{ route('blog.createCategory') }}">crie uma categoria.</a>
</div>
@endif
@endsection
@section('extra_script')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js??apiKey=j6zb6pd4bohl4zpvl0jqxphn2gejv1jaxhr4uej3b9r6bqzr"></script>
<script> 
    $(document).ready(function(){ 
        tinymce.init({ selector:'.textarea' });
        Dropzone.options.dropzoneFoto = {
            maxFiles: 1,
            init: function() {
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            }
        };
    });
</script>
@endsection