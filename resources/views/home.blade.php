@extends('layouts.app')

    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('{{ asset('firebase-messaging-sw.js') }}')
            .then(function (registration) {
                console.log('Service Worker registrado com sucesso:', registration);
            })
            .catch(function (error) {
                console.error('Erro ao registrar Service Worker:', error);
            });
    }

    const firebaseConfig = {
        apiKey: "AIzaSyDAklL5MqFiqfVhmW9KkQjfke4qwOZCAV4",
        authDomain: "laravel-eb094.firebaseapp.com",
        projectId: "laravel-eb094",
        storageBucket: "laravel-eb094.appspot.com",
        messagingSenderId: "803826287274",
        appId: "1:803826287274:web:f1890d9ff2e36e8149c6d3"
    };

    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken();
        }).then(function (token) {
            axios.post("{{ route('fcmToken') }}", {
                _method: "POST",
                token
            }).then(({ data }) => {
                console.log(data);
            }).catch(({ response: { data } }) => {
                console.error(data);
            });

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();
    
</script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tela Inicial') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Bem-vindo ao sistema!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
