@push('title')
    <title>Password Reset</title>
@endpush

@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                <a href="/">Home</a> &gt;&gt; Password Reset
            </p>
        </div>
        <div>
            <span class="col-7">
                <h2>Password Reset!</h2>

                <?php if (isset($message)) :?>
                    <p><?php echo $message ?></p>
                <?php endif;?>

                <form method="POST">
                    @csrf
                    <dl class="zend_form">
                        <dt id="password-label"><label for="password">Password:</label></dt>
                        <dd id="password-element">
                            <input type="password" id="password" name="password" autocomplete="off" value="">
                            @error('password')
                                <ul>
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </dd>
                        <dt id="confirmpassword-label"><label for="confirmpassword">Retype Password:</label></dt>
                        <dd id="confirmpassword-element">
                            <input type="password" id="password_confirmation" name="password_confirmation" value="">
                            @error('password_confirmation')
                                <ul>
                                    <li>{{ $message }}</li>
                                </ul>
                            @enderror
                        </dd>
                        <dt id="submit-label">&nbsp;</dt>
                        <dd id="submit-element">
                            <input type="submit" name="submit" value="Submit">
                        </dd>
                    </dl>
                </form>

                <div class="clear"></div>
            </span>
            <span class="col-4">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                    style="display:inline-block;width:160px;height:600px"
                    data-ad-client="ca-pub-8651736830870146"
                    data-ad-slot="3476733769"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </span>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
@endsection
