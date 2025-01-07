@push('meta')
    <meta name="keywords"
        content="We list all adoption agencies available in {{ ucwords(strtolower($city->city)) }} {{ $city->state }}">
@endpush

@push('title')
    <title>{{ ucwords(strtolower($city->city)) }} {{ $city->state }} Adoption Agencies</title>
@endpush

@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                <a href="/">Adoption Center</a>&gt;&gt;
                <a href="/<?php echo $state->statefile; ?>-adoption"><?php echo $state->state_name; ?></a> &gt;&gt;
                <?php echo ucwords(strtolower($city->city)); ?> Adoption Agencies
            </p>
            <span class="col-7">
                <h1><span><?php echo ucwords(strtolower($city->city)); ?> Adoption Agencies</span></h1>
                <p>We are in the process of building our adoption agency database to help with adoption. Please be patient
                    as we're improving our system to serve you better. </p>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- AdoptionCenter Links -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8651736830870146"
                    data-ad-slot="2090784712" data-ad-format="link" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <?php $i=0; if(count($agencies)>=1): ?>
                <?php
                /** @var \Application\Domain\Entity\Agency $agency */
                foreach ($agencies as $agency): $i++;?>
                <h4><a href="/agency-<?php echo $agency->id; ?>.html"><?php echo $agency->name; ?> </a></h4>
                <strong><?php echo $agency->city . ', ' . $agency->state . ' ' . $agency->zip . ' | ' . $agency->phone; ?></strong>
                <p><?php echo $agency->details; ?></p>
                <?php if ($i == 2):?>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article"
                    data-ad-format="fluid" data-ad-client="ca-pub-8651736830870146" data-ad-slot="7447478207"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <?php endif;?>
                <?php endforeach;?>
                <?php else:?>
                <p>There is no adoption agencies in <?php echo $city->city . ', ' . $city->state; ?> </p>
                <?php endif;?>
            </span>
            <span class="col-4">
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
    
            <div class="question_section ">
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
        <div class="clear"></div>
    </div>
@endsection
