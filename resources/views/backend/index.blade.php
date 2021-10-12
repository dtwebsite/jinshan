<html lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>金山彩藝</title>

    <link href="{{ asset('common/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('common/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/css/custom.min.css') }}" rel="stylesheet">
    <meta name="robots" content="noindex, follow">
    <style>
        body.login{
            background: #F7F7F7 url("common/bg.jpg") center center no-repeat;
            background-size:100% 100%;
            padding-top: 5%;
        }
        .login_wrapper {           
            margin-top: 0;            
        }
    </style>
    <body class="login" >        
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h1>管理員登入</h1>
                        <div>
                            <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="帳號" required="" autocomplete="username" autofocus>
                        </div>
                        <div>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="密碼" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="loginBtn">
                            <button type="submit" class="btn btn btn-info">登入</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div>
                                <h1>金山彩藝</h1>
                                <p>© All Rights Reserved. 金山彩藝</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>        
    </body>
</html>