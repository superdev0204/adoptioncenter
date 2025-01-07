@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                @if ($agency)
                    <a href="/">Home</a> &gt;&gt; <a href="/agency-<?php echo $agency->id; ?>.html">Agency Detail</a> &gt;&gt; Create Answer
                @else
                    <a href="/">Home</a> &gt;&gt; <a href="<?php echo $page_url; ?>">Previous Page</a> &gt;&gt; Create Answer
                @endif
            </p>
        </div>
        <div>
            <span class="col-7">
                <h2>Create your answer for: </h2>
                @if ($agency)
                    <?php echo $agency->name; ?><br />
                    <?php echo $agency->address . ' ' . $agency->city . ' ' . $agency->state . ' ' . $agency->zip; ?><br/></br/>
                @endif
                Q: <?php echo $question->question; ?><br /><br />
                <p><?php echo $message; ?></p>

                @if( !$request->answer )
                    @if ($agency)
                        <form action="/send_answer?id={{ $agency->id }}&questionId={{ $question->id }}" method="post">
                    @else
                        <form action="/send_answer?page_url={{ $page_url }}&questionId={{ $question->id }}" method="post">
                    @endif
                        @csrf
                        <dl class="zend_form">
                            @if (!$user)
                                <dt id="user-label"><label for="answer_userName">Your Name</label></dt>
                                <dd id="user-element">
                                    @if (isset($request->answer_userName))
                                        <input type="text" id="answer_userName" name="answer_userName"
                                            value="{{ $request->answer_userName }}">
                                    @else
                                        <input type="text" id="answer_userName" name="answer_userName"
                                            value="{{ old('answer_userName') }}">
                                    @endif
                                    @error('answer_userName')
                                        <ul style="clear: both">
                                            <li>{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </dd>
                                <dt id="user-label"><label for="answer_userEmail">Your Email</label></dt>
                                <dd id="user-element">
                                    @if (isset($request->answer_userEmail))
                                        <input type="email" id="answer_userEmail" name="answer_userEmail"
                                            value="{{ $request->answer_userEmail }}">
                                    @else
                                        <input type="email" id="answer_userEmail" name="answer_userEmail"
                                            value="{{ old('answer_userEmail') }}">
                                    @endif
                                    @error('answer_userEmail')
                                        <ul style="clear: both">
                                            <li>{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </dd>
                            @endif
                            <dt id="answer-label"><label for="answer">Your Answer</label></dt>
                            <dd id="answer-element">
                                @if (isset($request->answer))
                                    <textarea id="answer" name="answer" cols="15" rows="5">{{ $request->answer }}</textarea>
                                @else
                                    <textarea id="answer" name="answer" cols="15" rows="5">{{ old('answer') }}</textarea>
                                @endif
                                @error('answer')
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