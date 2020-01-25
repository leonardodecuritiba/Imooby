<!-- JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- CORE PLUGINS -->
<script src="{{asset('assets_site/vendor/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_site/vendor/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
{{-- <script src="{{asset('assets_site/vendor/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script> --}}

<!-- PAGE LEVEL PLUGINS -->
<script src="{{asset('assets_site/vendor/jquery.easing.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_site/vendor/jquery.back-to-top.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_site/vendor/jquery.smooth-scroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_site/vendor/jquery.wow.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_site/vendor/swiper/js/swiper.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_site/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets_site/vendor/masonry/jquery.masonry.pkgd.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_site/vendor/masonry/imagesloaded.pkgd.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_site/js/jquery-confirm.min.js')}}"></script>
<script src="{{ asset('assets/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}" type="text/javascript"></script>

<!-- PAGE LEVEL SCRIPTS -->
@if(isset($withoutLayoutJs))
@else
<script src="{{asset('assets_site/js/layout.min.js')}}" type="text/javascript"></script>
@endif
<script src="{{asset('js/imooby.min.js')}}" type="text/javascript"></script>

@include('site.intercom')