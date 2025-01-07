@push('title')
    <title>Member Login</title>
@endpush

@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                <a href="/">Home</a> &gt;&gt; User Login
            </p>
        </div>
        <div>
            <span class="col-7">
                <h2>User Login</h2><br/>

                @if (request()->query('return_url'))
                    <p>If you don't have a Login Account yet, please <a href="/user/new?{{ explode("?", request()->query('return_url'))[1] }}">Click here to Register</a>.</p>
                @else
                    <p>If you don't have a Login Account yet, please <a href="/user/new">Click here to Register</a>.</p>
                @endif

                <?php if (isset($errorMessage)) :?>
                <p><?php echo $errorMessage; ?></p>
                <?php endif;?>
                
                <form method="POST" id="login">
                    @csrf
                    <dl class="zend_form">
                        <dt id="username-label"><label for="email">Username (email):</label></dt>
                        <dd id="username-element">
                            @if (isset($request->email))
                                <input type="email" id="email" name="email" value="{{ $request->email }}">
                            @else
                                <input type="email" id="email" name="email" value="{{ old('email') }}">
                            @endif
                            @error('email')
                                <ul>
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </dd>
                        <dt id="password-label"><label for="password">Password:</label></dt>
                        <dd id="password-element">
                            <input type="password" id="password" name="password">
                            @error('password')
                                <ul>
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </dd>
                        <dt id="login-label">&nbsp;</dt>
                        <dd id="login-element">
                            <input type="submit" name="submit" value="Login">
                        </dd>
                    </dl>
                </form>
                <br />
                <?php if (isset($errorMessage)) :?>
                <p>If you forget your password, click <a href="/user/reset">reset password</a>. </p>
                <?php endif; ?>

                <div class="clear"></div>
            </span>
            <span class="col-4">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px"
                    data-ad-client="ca-pub-8651736830870146" data-ad-slot="3476733769"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </span>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
@endsection
