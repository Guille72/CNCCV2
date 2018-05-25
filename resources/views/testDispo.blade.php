@extends('layouts.app')
@section('content')

    <center>
        <div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="continue_with"
             data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>
    </center>

    <div class="container">
        {!! Form::open() !!}

        <div class="form-group">
            {!! Form::label('debut', 'Début') !!}
            {!! Form::date('debut', \Carbon\Carbon::class, ['class' => 'form-control', 'placeholder' => 'Début', 'id' => 'debut']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('fin', 'Fin') !!}
            {!! Form::date('fin', \Carbon\Carbon::class, ['class' => 'form-control', 'placeholder' => 'Fin', 'id' => 'fin']) !!}
        </div>

        <button class="btn btn-success" type="submit">Ajouter !</button>

        {!! Form::close() !!}


        @foreach($bookings as $booking)
            <center>
                <ul>
                    <li>{{ $booking->id }}</li>
                    <li>{{ $booking->arrivee }}</li>
                    <li>{{ $booking->depart }}</li>
                </ul>
            </center>
        @endforeach
    </div>

    <!--Div incluse dans le script du bas-->
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v3.0&appId=2050153445239859&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <script>
        // SDK
        window.fbAsyncInit = function () {
            FB.init({
                appId: '2050153445239859',
                cookie: true,
                xfbml: true,
                version: '{latest-api-version}'
            });

            FB.AppEvents.logPageView();

        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>
        // Checker la connexion
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    </script>

@endsection