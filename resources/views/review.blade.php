@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                <a href="/">Home</a> &gt;&gt; Contact
            </p>
        </div>
        <div>
            <span class="col-7">
                <h2>Create your comment for:</h2>
                <?php echo $agency->name; ?><br />
                <?php echo $agency->address . ' ' . $agency->city . ' ' . $agency->state . ' ' . $agency->zip; ?>
                <p><?php echo $message; ?></p>

                @if (!isset($review->id))
                    <form method="post" enctype="application/x-www-form-urlencoded" action="/agency/comment">
                        @csrf
                        <dl class="zend_form">
                            <dt id="email-label"><label for="email">Email address (will not be published):</label></dt>
                            <dd id="email-element">
                                @if (isset($request->email))
                                    <input type="email" id="email" name="email" value="{{ $request->email }}">
                                @else
                                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                                @endif
                                @error('email')
                                    <ul style="clear: both">
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="name-label"><label for="name">Display Name:</label></dt>
                            <dd id="name-element">
                                @if (isset($request->name))
                                    <input type="text" id="name" name="name" value="{{ $request->name }}">
                                @else
                                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                                @endif
                                @error('name')
                                    <ul style="clear: both">
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="comment-label"><label for="comment">Write your comment:</label></dt>
                            <dd id="comment-element">
                                @if (isset($request->comment))
                                    <textarea cols="15" rows="5" id="comment" name="comment">{{ $request->comment }}</textarea>
                                @else
                                    <textarea cols="15" rows="5" id="comment" name="comment">{{ old('comment') }}</textarea>
                                @endif
                                @error('comment')
                                    <ul style="clear: both">
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
                            <dt id="addComment-label">&nbsp;</dt>
                            <dd id="addComment-element">
                                <input type="submit" name="submit" value="Add Comment">
                            </dd>
                        </dl>
                        <br>
                        <input type="hidden" name="id" value="{{ $agency->id }}">
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
