@push('title')
    <title>Create New User</title>
@endpush

@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                <a href="/">Home</a> &gt;&gt; Sign Up
            </p>
        </div>
        <div>
            <span class="col-7">
                <h2>New User Sign Up</h2>

                <?php if ($message) :?>
                <p><?php echo $message; ?></p>
                <?php endif ?>

                @if (!$new_user)
                    <form method="post">
                        @csrf
                        <dl class="zend_form">
                            <dt id="login-label">&nbsp;</dt>
                            <dd id="login-element">
                                <fieldset id="fieldset-login">
                                    <legend>Login Information</legend>
                            <dt id="email-label"><label for="email">Email address (will be your username):</label></dt>
                            <dd id="email-element">
                                @if (isset($request->email))
                                    <input type="email" id="email" name="email" value="{{ $request->email }}">
                                @else
                                    <input id="email" name="email" type="email" value="{{ old('email') }}">
                                @endif
                                @error('email')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="pwd-label"><label for="pwd">Password:</label></dt>
                            <dd id="pwd-element">
                                <input type="password" id="password" name="password" autocomplete="off">
                                @error('password')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="confirmpassword-label"><label for="confirmpassword">Retype Password:</label></dt>
                            <dd id="confirmpassword-element">
                                <input type="password" id="password_confirmation" name="password_confirmation">
                                @error('password_confirmation')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            </fieldset>
                            </dd>
                            <dt id="account-label">&nbsp;</dt>
                            <dd id="account-element">
                                <fieldset id="fieldset-account">
                                    <legend>Account Information</legend>
                            <dt id="firstname-label"><label for="firstname">First Name:</label></dt>
                            <dd id="firstname-element">
                                @if (isset($request->firstname))
                                    <input type="text" id="firstname" name="firstname" value="{{ $request->firstname }}">
                                @else
                                    <input id="firstname" name="firstname" type="text" value="{{ old('firstname') }}">
                                @endif
                                @error('firstname')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="lastname-label"><label for="lastname">Last Name:</label></dt>
                            <dd id="lastname-element">
                                @if (isset($request->lastname))
                                    <input type="text" id="lastname" name="lastname" value="{{ $request->lastname }}">
                                @else
                                    <input id="lastname" name="lastname" type="text" value="{{ old('lastname') }}">
                                @endif
                                @error('lastname')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            {{-- <dt id="address-label"><label for="address">Address:</label></dt>
                            <dd id="address-element">
                                @if (isset($request->address))
                                    <input type="text" id="address" name="address" value="{{ $request->address }}">
                                @else
                                    <input id="address" name="address" type="text" value="{{ old('address') }}">
                                @endif
                                @error('address')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd> --}}
                            <dt id="city-label"><label for="city">City:</label></dt>
                            <dd id="city-element">
                                @if ($agency)
                                    <input class="textinput" type="text" id="city" name="city" value="{{$agency->city}}">
                                @else
                                    @if (isset($request->city))
                                        <input type="text" id="city" name="city" value="{{ $request->city }}">
                                    @else
                                        <input id="city" name="city" type="text" value="{{ old('city') }}">
                                    @endif
                                @endif
                                @error('city')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="state-label"><label for="state">State:</label></dt>
                            <dd id="state-element">
                                @if ($agency)
                                    <select class="textinput" id="state" name="state">
                                        <option value="">-Select-</option>
                                        @foreach ($states as $state)                                        
                                            @if ($state->state_code == $agency->state)
                                                <option value='{{ $state->state_code }}' selected>
                                                    {{ $state->state_name }}
                                                </option>
                                            @else
                                                <option value='{{ $state->state_code }}'>{{ $state->state_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                    <select class="textinput" id="state" name="state">
                                        <option value="">-Select-</option>
                                        @foreach ($states as $state)
                                            @if (isset($request->state))
                                                @if ($state->state_code == $request->state)
                                                    <option value='{{ $state->state_code }}' selected>
                                                        {{ $state->state_name }}
                                                    </option>
                                                @else
                                                    <option value='{{ $state->state_code }}'>{{ $state->state_name }}
                                                    </option>
                                                @endif
                                            @else
                                                @if ($state->state_code == old('state'))
                                                    <option value='{{ $state->state_code }}' selected>
                                                        {{ $state->state_name }}
                                                    </option>
                                                @else
                                                    <option value='{{ $state->state_code }}'>{{ $state->state_name }}
                                                    </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                                @error('state')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="zip-label"><label for="zip">Zip Code:</label></dt>
                            <dd id="zip-element">
                                @if ($agency)
                                    <input type="text" id="zip" name="zip" value="{{ $agency->zip }}">
                                @else
                                    @if (isset($request->zip))
                                        <input type="text" id="zip" name="zip" value="{{ $request->zip }}">
                                    @else
                                        <input id="zip" name="zip" type="text" value="{{ old('zip') }}">
                                    @endif
                                @endif
                                @error('zip')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            </fieldset>
                            </dd>
                            <dt id="challenge-label">&nbsp;</dt>
                            <dd id="challenge-element">
                                <input type="hidden" name="challenge" value="g-recaptcha-response">
                                <script type="text/javascript" src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>
                                <div class="g-recaptcha" data-sitekey="{{ env('DATA_SITEKEY') }}" data-theme="light"
                                    data-type="image" data-size="normal">
                                </div>
                                @error('recaptcha-token')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="register-label">&nbsp;</dt>
                            <dd id="register-element">
                                <input type="submit" name="submit" value="Register" />
                            </dd>
                        </dl>
                        </dl>
                    </form>
                @endif

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
