@push('meta')
    <meta name="keywords" content="{{ ucwords(strtolower($state->state_name)) }} adoption agencies">
@endpush

@push('title')
    <title>{{ ucwords(strtolower($state->state_name)) }} Adoption Agencies</title>
@endpush

@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0"><a href="/">Adoption Center</a> &gt;&gt;
                <?php echo $state->state_name; ?> Adoption </p>
            <span class="col-7">
                <h1><span>Adoption Agencies in <?php echo $state->state_name; ?></span></h1>
                <?php if($cities):?>
                <p>We currently have <?php echo $state->agencies_count; ?> adoption agencies available in our database. Please select from our
                    list to view available agencies in that city.</p>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- AdoptionCenter Links -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8651736830870146"
                    data-ad-slot="2090784712" data-ad-format="link" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <span class="us_table us_bg">
                    <ul>
                        <?php
                        /** @var \Application\Domain\Entity\City $city */
                        foreach ($cities as $city): ?>
                        <li>
                            <a href="/agencies/<?php echo $city->filename; ?>_city">
                                <?php echo ucwords(strtolower($city->city)); ?> </a> ( <?php echo $city->agencies_count; ?> )
                        </li>
                        <?php endforeach;?>
                        <span class="clear"></span>
                    </ul>
                </span>
                <?php else: ?>
                <p>We are in the process of building our child care jobs database to help find jobs and employee easier and
                    cheaper. Please be patient as we're improving our system to serve you better. </p>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- AdoptionCenter Responsive -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8651736830870146"
                    data-ad-slot="4146078448" data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <?php endif; ?>
            </span>
            <span class="col-4">
                <h2><span>Adoption Resources</span></h2>
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

        <div class="section">
            <span>
                <?php if(count($agencies)>=1):?>
                <h2 class="no_pad"><span>Latest Updates</span></h2>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article"
                    data-ad-format="fluid" data-ad-client="ca-pub-8651736830870146" data-ad-slot="7447478207"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <ul>
                    <?php
                    /** @var \Application\Domain\Entity\Agency $agency */
                    foreach ($agencies as $agency): ?>
                    <li>
                        <p>
                            <a href="/agency-<?php echo $agency->id; ?>.html"><?php echo $agency->name; ?> </a>
                            <?php echo $agency->phone; ?>
                            <?php echo $agency->address . ', ' . $agency->city . ', ' . $agency->state . ' ' . $agency->zip; ?>
                        </p>
                    </li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </span>
            <div class="clear"></div>
        </div>

        <style>
            .question_section{
                width:100%!important;
            }
            /* .question-title{
                margin:auto!important;
                float:none!important;
            } */
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
            /* .ask-question-btn{
                margin:auto!important;
                float:none!important;
            } */
            .answer-btn{
                clear: both;
                float:right!important;
            }
        </style>

        <div class="section">
            <div class="question_section">
                <div class="question-title">
                    <h2 class="black-title">Ask the Community</h2>
                    <p>Connect, Seek Advice, Share Knowledge</p>
                </div>
                <div class="ask-question-btn">
                    <input type="button" class="btn" value="Ask a Question" onclick="window.location.href='/send_question?page_url={{ $page_url }}'" />
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
                                <input type="button" class="btn" value="Answer the Question Above" onclick="window.location.href='/send_answer?page_url={{ $page_url }}&questionId={{$question->id}}'" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
