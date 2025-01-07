@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                @if ($agency)
                    <a href="/">Home</a> &gt;&gt; <a href="/agency-<?php echo $agency->id; ?>.html">Agency Detail</a> &gt;&gt; Create Question
                @else
                    <a href="/">Home</a> &gt;&gt; <a href="<?php echo $page_url; ?>">Previous Page</a> &gt;&gt; Create Question
                @endif
            </p>
        </div>
        <div>
            <span class="col-7">
                <h2>Create your question for:</h2>
                @if ($agency)
                    <?php echo $agency->name; ?><br />
                    <?php echo $agency->address . ' ' . $agency->city . ' ' . $agency->state . ' ' . $agency->zip; ?>
                    <p><?php echo $message; ?></p>
                @endif

                @if( !$request->question )
                    @if ($agency)
                        <form action="/send_question?id={{ $agency->id }}" method="post">
                    @else
                        <form action="/send_question?page_url={{ $page_url }}" method="post">
                    @endif
                        @csrf
                        <dl class="zend_form">
                            @if (!$user)
                                <dt id="user-label"><label for="userName">Your Name</label></dt>
                                <dd id="user-element">
                                    @if (isset($request->userName))
                                        <input type="text" id="userName" name="userName" value="{{ $request->userName }}">
                                    @else
                                        <input type="text" id="userName" name="userName" value="{{ old('userName') }}">
                                    @endif
                                    @error('userName')
                                        <ul style="clear: both">
                                            <li>{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </dd>
                                <dt id="user-label"><label for="userEmail">Your Email</label></dt>
                                <dd id="user-element">
                                    @if (isset($request->userEmail))
                                        <input type="email" id="userEmail" name="userEmail" value="{{ $request->userEmail }}">
                                    @else
                                        <input type="email" id="userEmail" name="userEmail" value="{{ old('userEmail') }}">
                                    @endif
                                    @error('userEmail')
                                        <ul style="clear: both">
                                            <li>{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </dd>
                            @endif
                            <dt id="question-label"><label for="question">Your Question</label></dt>
                            <dd id="question-element">
                                @if (isset($request->question))
                                    <textarea id="question" name="question" cols="15" rows="5">{{ $request->question }}</textarea>
                                @else
                                    <textarea id="question" name="question" cols="15" rows="5">{{ old('question') }}</textarea>
                                @endif
                                @error('question')
                                    <ul style="clear: both">
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            @if (!$user)
                                <dt id="challenge-label">&nbsp;</dt>
                                <dd id="challenge-element">
                                    <input type="hidden" name="challenge" value="g-recaptcha-response">
                                    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>
                                    <div class="g-recaptcha" data-sitekey="{{ env('DATA_SITEKEY') }}" data-theme="light"
                                        data-type="image" data-size="normal">
                                    </div>
                                    @error('recaptcha-token')
                                        <ul style="clear: both">
                                            <li>{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </dd>
                            @endif
                            <dt id="addComment-label">&nbsp;</dt>
                            <dd id="addComment-element">
                                <input type="submit" name="submit" value="Submit">
                            </dd>
                        </dl>
                    </form>
                @endif
                <div class="clear"></div>
            </span>
        </div>
        <div class="clear"></div>
    </div>
@endsection