@include('partials.header')

    <h1 class="header">Войти</h1>

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong style="color: red">Что-то не так с адресом электронной почты</strong>
            </span>
        @else
        <label for="email">Электронная почта</label>
        @endif

        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>


        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong style="color: red">Что-то не так с паролем</strong>
            </span>
        @else
        <label for="password">Пароль</label>
        @endif

        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

         <input type="submit" value="Войти"></input>
    </form>

@include('partials.footer')