<!DOCTYPE html>
<html lang="pt-br">
<head>
    @include("site.layouts.map.head")
    @yield("styles_content")
    <script type="text/javascript">
        var map;
    </script>
</head>
<body class="notransition">
{{Session::get('status')}}
@yield("body_content")
@include("site.layouts.map.foot")
@yield("scripts_content")
@if (isset($errors) && (count($errors) > 0))
    <script type="text/javascript">
        $(document).ready(function () {
            $('#modal_danger').modal('show');
        })
    </script>
@endif
@if(session()->has('status'))
    <script type="text/javascript">
        $(document).ready(function () {
            $('#modal_sucesso').modal('show');
        })
    </script>
@endif
@include('site.layouts.alerts.danger')
@include('site.layouts.alerts.success')
@yield("modals_content")

<script src="{{asset('assets_site/js/app.js')}}"></script>
<script src="{{asset('js/imooby.js')}}" type="text/javascript"></script>
</body>
<!-- END BODY -->
</html>