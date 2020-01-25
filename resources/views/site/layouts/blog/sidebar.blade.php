{{-- <div class="psidebox">
	<h4>SOBRE NÓS</h4>
	<img src="{{ asset('assets_site/img/placa.png') }}" style="width:100%;">
	<p style="margin-top:15px">O Imooby é uma startup com a missão de simplificar todas as etapas que envolvem o processo de locação de imóveis residencias. Nossa plataforma conecta proprietários e inquilinos de forma fácil e segura...</p>
	<a href="#">Saiba Mais</a>
</div> --}}
<div class="psidebox">
	<h4>CATEGORIAS</h4>
	<ul>
		@foreach(App\Models\Blog\Category::getAll() as $category)
		<li><a href="{{ $category->url() }}">{{ $category->name }}</a>
		@if(isset($isAdmin) && $isAdmin)
		<a href="{{ route('blog.editCategory', ['id'=>$category->id]) }}"><i class="fa fa-pencil"></i></a>
		@endif</li>
		@endforeach
	</ul>
</div>