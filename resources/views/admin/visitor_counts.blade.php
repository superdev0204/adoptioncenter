@push('link')
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
@endpush

@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div>
            <a href="/admin">Admin</a> &gt;&gt; Visitor Counts <br />
            <h1>Visitor Counts</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page Url</th>
                        <th>Date</th>
                        <th>Visitor Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($visitor_counts as $visitor_count): ?>
                        <tr class="d<?php echo $i % 2;
                        $i++; ?>">
                            <td>{{ $visitor_count->id }}</td>
                            <td>{{ $visitor_count->page_url }}</td>
                            <td>{{ $visitor_count->date }}</td>
                            <td>{{ $visitor_count->visitor_count }}</td>
                            <td>
                                <a href="/admin/visitor_delete?vID={{ $visitor_count->id }}">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table><br />
            <div class="clear"></div>            
        </div>
        @if ($visitor_counts instanceof Illuminate\Pagination\LengthAwarePaginator)
            <div class="pagination">
                {{ $visitor_counts->links("pagination::bootstrap-4") }}
            </div>
        @endif
    </div>
@endsection
