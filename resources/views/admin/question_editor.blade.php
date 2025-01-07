@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div>
            <a href="{{ url('/') }}">Home</a> &gt;&gt; <a href="/admin">Admin</a> &gt;&gt; Question Editor <br />

            <form method="POST" action="/admin/question_update">
                @csrf
                <table width="100%">
                    <tr>
                        <td>
                            @if (isset($question))
                                <div class="form-group">
                                    <label for="userName">Name:</label>
                                    <input type="text" id="userName" name="userName" value="{{ $question->question_by }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="userEmail">Email:</label>
                                    <input type="email" id="userEmail" name="userEmail" value="{{ $question->question_email }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="question_id" id="question_id" value="{{ $question->id }}"
                                        required>
                                    <label for="question">Question:</label>
                                    <textarea name="question" id="question" cols="15" rows="5">{{ $question->question }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-content-submit-btn">Update</button>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="question">Question:</label>
                                    <textarea name="question" id="question" cols="15" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-content-submit-btn">Submit Question</button>
                                </div>
                            @endif
                        </td>
                    </tr>
                </table>
            </form><br />
        </div>
    </div>
@endsection
