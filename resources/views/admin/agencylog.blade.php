@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div>
            <a href="/">Home</a> &gt;&gt; <a href="/admin">Admin Home</a> &gt;&gt; Agency Update Compare
            <h1><a target="_blank" href="/agency-<?php echo optional(optional($agencyLog)->agency)->id; ?>.html"><?php echo optional(optional($agencyLog)->agency)->name; ?></a></h1>
            <table class="table">
                <tr>
                    <th>Field Name</th>
                    <th>Old</th>
                    <th>New</th>
                </tr>
                <?php
                foreach ($agencyLog->getEditableFields() as $field => $title):
                    if ($agencyLog->$field == $agencyLog->agency->$field) continue;
                ?>
                <tr class="d0">
                    <td style="width: 20%"><?php echo $title; ?></td>
                    <td style="width: 40%">
                        <?php echo $agencyLog->agency->$field; ?>
                    </td>
                    <td style="width: 40%">
                        <?php echo $agencyLog->$field; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td>
                        <form method="post" action="/admin/agency-log/delete">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $agencyLog->id; ?> " />
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                    <td>
                        <form method="post" action="/admin/agency-log/disapprove">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $agencyLog->id; ?> " />
                            <input type="submit" value="Not Approve" />
                        </form>
                    </td>
                    <td>
                        <form method="post" action="/admin/agency-log/approve">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $agencyLog->id; ?> " />
                            <input type="submit" value="Approve" />
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
