@extends('site.layouts.institucional.template')
@section('styles_content')

<style type="text/css">
	body {
		padding-right: 0px !important;
	}
</style>
@endsection
@section('body_content')
<!--========== HEADER ==========-->
@include('site.layouts.blog.navbar')

<div class="container">
	@include('site.layouts.blog.header')
	<div class="row" style="padding-top: 60px;">
		{{-- Blog left-side  --}}
		<div class="col-lg-8">
			@yield('content-side')
		</div>
		{{-- Blog right-side --}}
		<div class="col-md-4" style="padding: 0 35px;">
			@include('site.layouts.blog.sidebar')
		</div>
	</div>
</div>
<!--========== END PAGE LAYOUT ==========-->
<div style="height:300px"></div>
<!--========== FOOTER ==========-->
@include('site.layouts.institucional.footer')
<!--========== END FOOTER ==========-->

@endsection