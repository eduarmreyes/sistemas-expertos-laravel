@extends('layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>UEES</b> Sistemas Expertos</a>
        </div><!-- /.login-logo -->

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="login-box-body">
    <p class="login-box-msg"> {{ trans('adminlte_lang::message.siginsession') }} </p>
    <form class="form-login" action="{{ url('/login') }}" method="post">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group hidden profiles">
            <select id="profiles" name="profiles" class="form-control"></select>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember"> {{ trans('adminlte_lang::message.remember') }}
                    </label>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte_lang::message.buttonsign') }}</button>
            </div><!-- /.col -->
        </div>
    </form>

    <a href="{{ url('/password/reset') }}">{{ trans('adminlte_lang::message.forgotpassword') }}</a><br>
    <a href="{{ url('/register') }}" class="text-center">{{ trans('adminlte_lang::message.registermember') }}</a>

</div><!-- /.login-box-body -->

</div><!-- /.login-box -->

    @include('layouts.partials.scripts_auth')

    <script>
        $(function () {
            $(document).on("ready", function() {
                PNotify.prototype.options.styling = "bootstrap3";
                // configure iCheck
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
                // login with ajax
                $(".form-login").on("submit", function(e) {
                    $.ajax({
                        data: $(this).serialize(),
                        error: function(data) {
                            var oNotify = null;
                            if (typeof data.responseText === "undefined") {
                                oNotify = {
                                    title: "Acceso Negado",
                                    text: "Error grave, por favor revise la consola.",
                                    type: "error"
                                };
                            } else {
                                oNotify = {
                                    title: "Acceso Negado",
                                    text: data.responseText,
                                    type: "error"
                                };
                            }
                            new PNotify(oNotify);
                        },
                        success: function(data) {
                            if (data.authenticated) {
                                if (data.user_teams.length === 1) {
                                    fnSetProfile(data.user_teams_id, data.user_teams);
                                    window.location = "{{ url('/home') }}";
                                } else {
                                    $("#profiles").append("<option value='0'>Seleccione un Perfil</option>");
                                    $.each(data.user_teams, function(i, u) {
                                        $("#profiles").append("<option value='" + data.user_teams_id[i] + "'>" + u + "</option>");
                                    });
                                    $(".profiles").removeClass("hidden");
                                }
                            } else {
                                new PNotify({
                                    title: 'Acceso Negado',
                                    text: 'Credenciales Incorrectas.',
                                    type: "error"
                                });
                                fnClearForm();
                            }
                        },
                        type: "post",
                        url: "{{ url('/login') }}"
                    });
                    e.preventDefault();
                });
                // select profile and start session
                $("#profiles").on("change", function() {
                    fnSetProfile($(this).find("option:selected").val(), $(this).find("option:selected").text());
                });
            });
            function fnClearForm() {
                $("input").val("");
            }
            function fnSetProfile(sProfileID, sProfile) {
                $.ajax({
                    data: {
                        sProfileID: sProfileID,
                        sProfile: sProfile,
                    },
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    error: function(data) {
                        console.log(data);
                    },
                    success: function(data) {
                        window.location = "{{ url('/home') }}";
                    },
                    type: "post",
                    url: "{{ url('/profile/set') }}"
                });
            }
        });
    </script>
</body>

@endsection
