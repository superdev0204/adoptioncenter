@push('title')
    <title>Contact AdoptionCenter.us</title>
@endpush

@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script>
    <script src="{{ asset('js/tiny_mce/tiny_mce_activate.js') }}"></script>

    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                <a href="/">Home</a> &gt;&gt; Contact
            </p>
        </div>
        <div>
            <span class="col-7">
                <h1>Contact Adoption Center</h1>

                <?php if (isset($message)): ?>
                <p><?php echo $message; ?></p>
                <?php endif; ?>

                @if ($message != 'Email sent successfully')
                    <form method="post">
                        @csrf
                        <dl class="zend_form">
                            <dt id="name-label"><label for="name">Your Name:</label></dt>
                            <dd id="name-element">
                                @if (isset($request->name))
                                    <input type="text" id="name" name="name" value="{{ $request->name }}">
                                @else
                                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                                @endif
                                @error('name')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="email-label"><label for="email">Your e-mail address:</label></dt>
                            <dd id="email-element">
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
                            <dt id="subject-label"><label for="subject">Subject:</label></dt>
                            <dd id="subject-element">
                                @if (isset($request->subject))
                                    <input type="text" id="subject" name="subject" value="{{ $request->subject }}">
                                @else
                                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
                                @endif
                                @error('subject')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="message-label"><label for="message">Message:</label></dt>
                            <dd id="message-element">
                                @if (isset($request->message))
                                    <textarea id="message" name="message" cols="15" rows="5">{{ $request->message }}</textarea>
                                @else
                                    <textarea id="message" name="message" cols="15" rows="5">{{ old('message') }}</textarea>
                                @endif
                                @error('message')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
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
                            <dt id="sendEmail-label">&nbsp;</dt>
                            <dd id="sendEmail-element">
                                <input type="hidden" name="referer"
                                    value="{{ isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '' }}">
                                <input type="submit" name="submit" value="Send&#x20;e-mail">
                            </dd>
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
