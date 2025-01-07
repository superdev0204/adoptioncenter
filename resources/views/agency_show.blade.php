@if (strlen($agency->name) <= 40)
    {
    @push('title')
        <title>{{ $agency->name . ' | ' . $agency->city . ' ' . $agency->state }} Adoption Agency</title>
    @endpush
@else
    @push('title')
        <title>{{ $agency->name . ' | ' . $agency->city . ' ' . $agency->state }}</title>
    @endpush
@endif

@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                <?php if ($city): ?>
                <a href="/<?php echo $state->statefile; ?>-adoption"><?php echo $state->state_name; ?> Adoption</a> &gt;&gt;
                <a href="/agencies/<?php echo $city->filename; ?>_city"><?php echo ucwords(strtolower($city->city)); ?> Agencies</a>&gt;&gt;
                <?php endif; ?>
                <?php echo $agency->name; ?>
            </p>
            <span class="col-7">
                <h1><?php echo $agency->name . ', ' . ucwords(strtolower($city->city)) . ' ' . $agency->state; ?></h1>

                <div class="clinic_table">
                    <div class="row">
                        <ul>
                            <li class="heading"><b>Agency Name</b></li>
                            <li class="data"><?php echo $agency->name; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row">
                        <ul>
                            <li class="heading"><b>Agency Location</b></li>
                            <li class="data"><?php echo $agency->address . '<br/>' . $agency->city . ', ' . $agency->state . ' ' . $agency->zip; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article"
                            data-ad-format="fluid" data-ad-client="ca-pub-8651736830870146" data-ad-slot="7447478207"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        <iframe width="600" height="400" frameborder="0" style="border:0"
                            src="https://www.google.com/maps/embed/v1/place?key=<?php echo env('GOOGLE_API_KEY'); ?>&q=<?php echo urlencode($agency->address . ', ' . $agency->city . ' ' . $agency->state . ' ' . $agency->zip); ?>"></iframe>
                    </div>
                    <div class="row">
                        <ul>
                            <li class="heading"><b>Contact Phone</b></li>
                            <li class="data"><?php echo $agency->phone; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row">
                        <ul>
                            <li class="heading"><b>Contact Name</b></li>
                            <li class="data"><?php echo $agency->contact; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row">
                        <ul>
                            <li class="heading"><b>License Number</b></li>
                            <li class="data"><?php echo $agency->license_no; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row">
                        <ul>
                            <li class="heading"><b>Web Site</b></li>
                            <li class="data"><?php echo $agency->website; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row">
                        <ul>
                            <li class="heading"><b>Services Offered</b></li>
                            <li class="data"><?php echo $agency->services; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row">
                        <ul>
                            <li class="heading"><b>Description</b></li>
                            <li class="data"><?php echo $agency->details; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row">
                        <ul>
                            <li class="heading"><b>Adoption Process</b></li>
                            <li class="data"><?php echo $agency->adoption_process; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row">
                        <ul>
                            <li class="heading"><b>District Office</b></li>
                            <li class="data"><?php echo $agency->district_office; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row no-border">
                        <ul>
                            <li class="heading"><b>District Office Phone</b></li>
                            <li class="data"><?php echo $agency->do_phone; ?></li>
                            <li class="clear"></li>
                        </ul>
                    </div>
                    <div class="row">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- AdoptionCenter Links -->
                        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8651736830870146"
                            data-ad-slot="2090784712" data-ad-format="link" data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
                <?php if (count($comments) > 0):?>
                <?php
                /** @var \Application\Domain\Entity\Comment $comment */
                foreach ($comments as $comment): ?>
                Comment from <?php echo $comment->name . ': ' . $comment->comment; ?><br />
                <?php endforeach;?>
                <?php endif;?>

                <h2 style="margin-top: 20px; display: inline-block">Leave your comment:</h2>
                <form method="post" enctype="application/x-www-form-urlencoded" action="/agency/comment">
                    @csrf
                    <dl class="zend_form">
                        <dt id="email-label"><label for="email">Email address (will not be published):</label></dt>
                        <dd id="email-element">
                            <input type="email" id="email" name="email" value="">
                        </dd>
                        <dt id="name-label"><label for="name">Display Name:</label></dt>
                        <dd id="name-element">
                            <input id="name" name="name" type="text" value="">
                        </dd>
                        <dt id="comment-label"><label for="comment">Write your comment:</label></dt>
                        <dd id="comment-element">
                            <textarea id="comment" name="comment" cols="15" rows="5"></textarea>
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

                <style>
                    .question_section{
                        width:100%!important;
                    }
                    .question-title{
                        margin:auto!important;
                        float:none!important;
                    }
                    .question-wrapper{
                        width:100%!important
                    }
                    .single-question{
                        padding: 20px!important
                    }
                    .answer{
                        padding-left:20px!important;
                        clear: both
                    }
                    .reply{
                        clear: both;
                    }
                    .ask-question-btn{
                        clear: both;
                    }
                    .ask-question-btn{
                        margin:auto!important;
                        float:none!important;
                    }
                    .answer-btn{
                        float:right!important;
                    }
                </style>

                <div class="question_section ">
                    <div class="question-title">
                        <h2 class="black-title">Ask the Community</h2>
                        <p>Connect, Seek Advice, Share Knowledge</p>
                    </div>
                    <div class="ask-question-btn">
                        <a href="/send_question?id={{ $agency->id }}" style="margin-top:0px">Ask a Question</a>
                    </div>
                    <div class="question-wrapper">
                        @foreach ($questions as $question)
                            <div class="single-question clinic_table">
                                <div class="question">
                                    <p>Question by {{ $question->question_by }} ({{ $question->passed }} ago): <?php echo $question->question;?></p>
                                </div>
                                @foreach ($question->answers as $answer)
                                    <div class="answer">
                                        <p>Answer: <?php echo $answer->answer;?></p>
                                    </div>
                                @endforeach
                                <div class="answer-btn">
                                    <a href="/send_answer?id={{$agency->id}}&questionId={{$question->id}}">Answer the Question Above</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </span>
            <span class="col-4">
                <br /><br />
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- AdoptionCenter Links -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8651736830870146"
                    data-ad-slot="2090784712" data-ad-format="link" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <h3>Notes</h3>
                <span>Are you the owner or director of this agency?</span><br/><br/>
                <a href="/agency/update?id=<?php echo $agency->id; ?>" style="display:unset; padding:5px">Update Agency Information</a><br/><br/>
                <span>If you notice any inaccurate information on this page, please let us know so we can correct.</span><br/><br/>
                <a href="/contact?id=<?php echo $agency->id; ?>" style="display:unset; padding:5px">Report Incorrect Information</a><br/><br/>
                <h2><span>Adoption Resources</span></h2>
                <?php if (count($resources) > 0):?>
                <ul>
                    <?php
                    /** @var \Application\Domain\Entity\Resource $resource */
                    foreach ($resources as $resource) : ?>
                    <li>
                        <a href="/resource/<?php echo $resource->pagename; ?>"><?php echo $resource->header; ?></a><br />
                        <?php echo $resource->description; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- AdoptionCenter Responsive -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8651736830870146"
                    data-ad-slot="4146078448" data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </span>
            <div class="clear"></div>
        </div>
    </div>
@endsection
