@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div>
            <a href="/admin">Admin</a> &gt;&gt; Q/A <br />

            <h2>New Questions</h2>
            <a href='/admin/question_editor' style="float:right; margin-right:30px">New Question</a>
            <table class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Approve</th>
                        <th>Name</th>
                        <th>By</th>
                        <th>Questions</th>
                        <th>Update</th>
                        <th>Not Approve</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td>
                                <form method="post" action="/admin/question/approve">
                                    @csrf
                                    <input type="hidden" name="id" value="<?php echo $question->id; ?>" />
                                    <input type="submit" value="Approve" />
                                </form>
                            </td>
                            <td><a target="_blank" href="{{ $question->link }}">{{ $question->name }}</a></td>
                            <td>{{ $question->question_by }}</td>
                            <td><?php echo $question->question; ?></td>
                            <td>
                                <form method="get" action="/admin/question_editor">
                                    <input type="hidden" name="id" value="<?php echo $question->id; ?>" />
                                    <input type="submit" value="Update" />
                                </form>
                            </td>
                            <td>
                                <form method="post" action="/admin/question/disapprove">
                                    @csrf
                                    <input type="hidden" name="id" value="<?php echo $question->id; ?>" />
                                    <input type="submit" value="Not Approve" />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table><br />
            <h2>New Answers</h2>
            <table class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Approve</th>
                        <th>Name</th>
                        <th>By</th>
                        <th>Answers</th>
                        <th>Update</th>
                        <th>Not Approve</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $answer)
                        <tr>
                            <td>
                                <form method="post" action="/admin/answer/approve">
                                    @csrf
                                    <input type="hidden" name="id" value="<?php echo $answer->id; ?>" />
                                    <input type="submit" value="Approve" />
                                </form>
                            </td>
                            <td><a target="_blank" href="{{ $answer->link }}">{{ $answer->name }}</a></td>
                            <td>{{ $answer->answer_by }}</td>
                            <td><?php echo $answer->answer; ?></td>
                            <td>
                                <form method="get" action="/admin/answer_editor">
                                    <input type="hidden" name="id" value="<?php echo $answer->id; ?>" />
                                    <input type="submit" value="Update" />
                                </form>
                            </td>
                            <td>
                                <form method="post" action="/admin/answer/disapprove">
                                    @csrf
                                    <input type="hidden" name="id" value="<?php echo $answer->id; ?>" />
                                    <input type="submit" value="Not Approve" />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table><br />
            <div class="clear"></div>
        </div>
    </div>
    <style>
        #content button {
            background: #E59500;
            border: 0;
            height: 36px;
            margin-left: 0;
            width: 137px;
            color: #fff;
            cursor: pointer;
        }
    </style>
@endsection
