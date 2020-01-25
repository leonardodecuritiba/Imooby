<!DOCTYPE html>
<html lang="pt-br" class="no-js">
<head>
    @include("site.layouts.institucional.head")
    @yield("styles_content")
</head>
<body id="body" data-spy="scroll" data-target=".header">
@include('site.layouts.modal.register')
@include('site.layouts.modal.login')
@include('site.layouts.modal.lost_pwd')
{{--@include('site.layouts.modal.new_pwd')--}}
@include('site.layouts.modal.contact')
@yield("body_content")
@include("site.layouts.institucional.foot")
@yield("scripts_content")
@if (isset($errors) && (count($errors) > 0))
    @include('site.layouts.alerts.danger')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#modal_danger').modal('show');
        });
    </script>
@endif
@if (session()->has('status'))
    @include('site.layouts.alerts.success')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#modal_sucesso').modal('show');
        })
    </script>
@endif
@yield("modals_content")
</body>
<!-- END BODY -->
</html>