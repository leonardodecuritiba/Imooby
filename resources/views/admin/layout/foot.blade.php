{!! Html::script('assets_admin/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}
{!! Html::script('assets_admin/bower_components/jquery.nicescroll/jquery.nicescroll.min.js') !!}
{!! Html::script('assets_admin/bower_components/bootstrap-progressbar/bootstrap-progressbar.min.js') !!}
{!! Html::script('assets_admin/bower_components/iCheck/icheck.min.js') !!}


{!! Html::script('assets_admin/build/js/custom.min.js') !!}

{!! Html::script('assets_admin/bower_components/jquery.inputmask/dist/min/inputmask/inputmask.min.js') !!}
{!! Html::script('assets_admin/bower_components/jquery.inputmask/dist/min/inputmask/jquery.inputmask.min.js') !!}

<!-- PNotify -->
{!! Html::script('assets_admin/bower_components/pnotify/dist/pnotify.js') !!}
{!! Html::script('assets_admin/bower_components/pnotify/dist/pnotify.buttons.js') !!}
{!! Html::script('assets_admin/bower_components/pnotify/dist/pnotify.nonblock.js') !!}
<!-- /PNotify -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.show-cep').inputmask({'mask': '99999-999', 'removeMaskOnSubmit': true});
        $('.show-cpf').inputmask({'mask': '999.999.999-99', 'removeMaskOnSubmit': true});
        $('.show-cnpj').inputmask({'mask': '99.999.999/9999-99', 'removeMaskOnSubmit': true});
        $('.show-ie').inputmask({'mask': '999.999.999.999', 'removeMaskOnSubmit': true});
        $('.show-rg').inputmask({'mask': '99.999.999-9', 'removeMaskOnSubmit': true});
        $('.show-celular').inputmask({'mask': '(99) 99999-9999', 'removeMaskOnSubmit': true});
        $('.show-telefone').inputmask({'mask': '(99) 9999-9999', 'removeMaskOnSubmit': true});
    });
</script>

{!! Html::script('assets_admin/bower_components/jquery-maskmoney/dist/jquery.maskMoney.min.js') !!}
<script type="text/javascript">
    function initMaskMoney(selector) {
        $(selector).maskMoney({prefix: 'R$ ', allowNegative: false, thousands: '.', decimal: ',', affixesStay: false});
    }
    $(document).ready(function () {
        initMaskMoney($(".show-valor"));
    });
    function initMaskMoneyDolar(selector) {
        $(selector).maskMoney({prefix: '$ ', allowNegative: false, thousands: ',', decimal: '.', affixesStay: false});
    }
    $(document).ready(function () {
        initMaskMoneyDolar($(".show-valor-dolar"));
    });
    function initMaskMoneyPorcento(selector) {
        $(selector).maskMoney({suffix: ' %', allowNegative: false, thousands: '.', decimal: ',', affixesStay: false});
    }
    $(document).ready(function () {
        initMaskMoneyPorcento($(".show-porcento"));
    });
    function initMaskMoneyPeso(selector) {
        $(selector).maskMoney({suffix: ' Kg', allowNegative: false, thousands: '.', decimal: ',', affixesStay: false});
    }
    $(document).ready(function () {
        initMaskMoneyPeso($(".show-peso"));
    });
    function initMaskGarantia(selector) {
        $(selector).maskMoney({suffix: ' meses', precision: 0, affixesStay: false});
    }
    $(document).ready(function () {
        initMaskGarantia($(".show-meses"));
    });
    function initMaskMoneyNumero(selector) {
        $(selector).maskMoney({allowNegative: false, precision: 0, thousands: '', decimal: '', affixesStay: false});
    }
    $(document).ready(function () {
        initMaskMoneyNumero($(".show-inteiro"));
    });
</script>

<!-- daterangepicker -->
{{--{!! Html::script('assets_admin/bower_components/bootstrap-daterangepicker/js/datepicker/moment.min.js') !!}--}}
{!! Html::script('assets_admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') !!}
<script type="text/javascript">
    //    calender_style: "picker_4"
    var locale = {
        format: "DD/MM/YYYY",
        separator: " - ",
        applyLabel: "Aplicar",
        cancelLabel: "Cancelar",
        fromLabel: "De",
        toLabel: "A",
        customRangeLabel: "Customizado",
        daysOfWeek: [
            "Dom",
            "Seg",
            "Ter",
            "Qua",
            "Qui",
            "Sex",
            "Sáb"
        ],
        monthNames: [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
        ],
        "firstDay": 1
    };
    var dateOptionsToNow = {
        locale: locale,
        maxDate: new Date(),
        singleDatePicker: true,
        autoUpdateInput: false
    };
    var dateOptionsFromNow = {
        locale: locale,
        minDate: new Date(),
        singleDatePicker: true,
        autoUpdateInput: false
    };
    var dateOptionsEvery = {
        locale: locale,
        singleDatePicker: true,
        autoUpdateInput: false
    };
    $(document).ready(function () {

        $('.data-every').daterangepicker(dateOptionsEvery);
        $('.data-to-now').daterangepicker(dateOptionsToNow);
        $('.data-from-now').daterangepicker(dateOptionsFromNow);
        $('.data-every, .data-to-now, .data-from-now').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format(locale.format));
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('#buscar').keypress(function (e) {
            if (e.which == 13) {
                $('form#search').submit();
                return false;    //<---- Add this line
            }
        });
    });

    //desativação redirect
    $(document).ready(function () {
        $('div#modalDesativacao').on('show.bs.modal', function (e) {
            $origem = $(e.relatedTarget);
            nome_ = $($origem).data('nome');
            href_ = $($origem).data('href');
            $(this).find('.modal-content form').attr('action', href_);
            $(this).find('.modal-body').html('Você realmente deseja desativar <strong>' + nome_ + '</strong> e suas relações?');
        });
    });
    //exclusão tem redirect
    $(document).ready(function () {
        $('div#modalExclusao').on('show.bs.modal', function (e) {
            $origem = $(e.relatedTarget);
            nome_ = $($origem).data('nome');
            href_ = $($origem).data('href');
            $(this).find('.modal-content form').attr('action', href_);
            $(this).find('.modal-body').html('Você realmente deseja excluir <strong>' + nome_ + '</strong> e suas relações? Esta ação é irreversível!');
        });
    });

    <!-- script remoção -->
    $(document).ready(function () {

        $('div#modalRemocao').on('show.bs.modal', function (e) {
            $origem = $(e.relatedTarget);
            nome_ = $($origem).data('nome');
            href_ = $($origem).data('href');
            $el = $($origem).data('elemento');
            $(this).find('.modal-body').html('Você realmente deseja remover <strong>' + nome_ + '</strong> e suas relações? Esta ação é irreversível!');
            $(this).find('.btn-ok').click(function () {

//                console.log($el);return;
                $('div#modalRemocao').modal('hide');
                $.ajax({
                    url: href_,
                    type: 'post',
                    data: {"_method": 'delete', "_token": "{{ csrf_token() }}"},
                    dataType: "json",
                    /*
                     beforeSend: function () {
                     $(".onLoading").show();
                     },
                     complete: function (xhr, textStatus) {
                     $(".onLoading").hide();
                     },
                     error: function (xhr, textStatus) {
                     console.log('xhr-error: ' + xhr);
                     console.log('textStatus-error: ' + textStatus);
                     },
                     */
                    success: function (json) {
                        if (json.code) {
                            console.log(json.status);

                            $el = $($origem).closest('tr');
                            if ($el.length == 0) {
                                $el = $($origem).closest('.tr');
                            }
                            $($el).remove();
                        } else {
                            alert(json.response);
                        }
                    }
                });

            });
        });
    });
</script>

<!-- script ativar/desativar -->
<script>
    function ajaxActive($target_, action_) {
        var href_ = '{{url('ajax')}}';
        if (typeof $($target_).data('href') != 'undefined') {
            href_ = $($target_).data('href');
        }
        $.ajax({
            url: href_,
            type: 'GET',
            data: {
                id: $($target_).data('id'),
                table: $($target_).data('table'),
                pk: $($target_).data('pk'),
                sk: $($target_).data('sk'),
                action: action_
            },
            dataType: "json",
            error: function (xhr, textStatus) {
                console.log('xhr-error: ' + xhr.responseText);
                console.log('textStatus-error: ' + textStatus);
            },
            success: function (json) {
                console.log(json);
                if (json.status == 1) {
                    if (json.valor == 1) {
                        $($target_).data('value', 1);
                        $($target_).html('<i class="fa fa-eye-slash"></i>Desativar');
                        $($target_).closest('tr').find('td.td-active:first').html('<span class="btn btn-success btn-xs">Ativo</span>');
                    } else {
                        $($target_).data('value', 0);
                        $($target_).html('<i class="fa fa-eye"></i>Ativar');
                        $($target_).closest('tr').find('td.td-active:first').html('<span class="btn btn-danger btn-xs">Inativo</span>');
                    }
                }
            }
        });
    }
    $(document).ready(function () {
        $('a.btn-active').click(function () {
            if ($(this).data('value')) {
                ajaxActive($(this), 'desativar');
            } else {
                ajaxActive($(this), 'ativar');
            }
        });
    });
</script>
<!-- /script ativar/desativar -->


<!-- bootstrap progress js -->
<script>
    //    NProgress.done();
</script>