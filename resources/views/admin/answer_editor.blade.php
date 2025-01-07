@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div>
            <a href="{{ url('/') }}">Home</a> &gt;&gt; <a href="/admin">Admin</a> &gt;&gt; Answer Editor <br />

            <form method="POST" action="/admin/answer_update">
                @csrf
                <table width="100%">
                    <tr>
                        <td>
                            @if (isset($answer))
                                <div class="form-group">
                                    <label for="userName">Name:</label>
                                    <input type="text" id="userName" name="userName" value="{{ $answer->answer_by }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="userEmail">Email:</label>
                                    <input type="email" id="userEmail" name="userEmail" value="{{ $answer->answer_email }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="answer_id" id="answer_id" value="{{ $answer->id }}"
                                        required>
                                    <label for="answer">Answer:</label>
                                    <textarea name="answer" id="answer" cols="15" rows="5">{{ $answer->answer }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-content-submit-btn">Update</button>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="answer">Answer:</label>
                                    <textarea name="answer" id="answer" cols="15" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-content-submit-btn">Update</button>
                                </div>
                            @endif
                        </td>
                    </tr>
                </table>
            </form><br />
        </div>
    </div>
@endsection
