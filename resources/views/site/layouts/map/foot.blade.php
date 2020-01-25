<!-- JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- CORE PLUGINS -->
@include('site.layouts.map.googleapijs')
<script src="{{asset('assets_site/js/json2.js')}}"></script>
<script src="{{asset('assets_site/js/jquery-2.1.1.min.js')}}"></script>
<script src="{{asset('assets_site/js/underscore.js')}}"></script>
<script src="{{asset('assets_site/js/moment-2.5.1.js')}}"></script>
<script src="{{asset('assets_site/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets_site/js/jquery-ui-touch-punch.js')}}"></script>
<script src="{{asset('assets_site/js/jquery.placeholder.js')}}"></script>
<script src="{{asset('assets_site/js/bootstrap.js')}}"></script>
<script src="{{asset('assets_site/js/jquery.touchSwipe.min.js')}}"></script>
<script src="{{asset('assets_site/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets_site/js/jquery.visible.js')}}"></script>
<script src="{{asset('assets_site/js/infobox.js')}}"></script>
<script src="{{asset('assets_site/js/clndr.js')}}"></script>
<script src="{{asset('assets_site/js/jquery.tagsinput.min.js')}}"></script>
<script src="{{asset('assets_site/js/bootstrap-datepicker-multiple.min.js')}}"></script>
<script src="{{asset('assets_site/js/bootstrap-datepicker-multiple.pt-BR.min.js')}}"></script>
<script src="{{asset('assets_site/js/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('assets_site/js/fileinput.min.js')}}"></script>
<script src="{{asset('assets_site/js/calendar.js')}}"></script>
<script src="{{asset('assets_site/js/jquery-confirm.min.js')}}"></script>
<script src="{{asset('assets_site/js/mask.js')}}"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    function moeda(z) {
        v = z.value;
        v = v.replace(/\D/g, "");
        v = v.replace(/[0-9]{12}/, "inválido");
        v = v.replace(/(\d{1})(\d{8})$/, "$1.$2");
        v = v.replace(/(\d{1})(\d{5})$/, "$1.$2");
        v = v.replace(/(\d{1})(\d{1,2})$/, "$1,$2");
        z.value = v;
    }
    function area(z) {
        v = z.value;
        v = v.replace(/\D/g, "");
        v = v.replace(/[0-9]{12}/, "inválido");
        v = v.replace(/(\d{1})(\d{8})$/, "$1.$2");
        v = v.replace(/(\d{1})(\d{5})$/, "$1.$2");
        v = v.replace(/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/, "$1,$2");
        z.value = v;
    }
</script>
@include('site.intercom')