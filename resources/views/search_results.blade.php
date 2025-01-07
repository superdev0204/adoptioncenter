@push('title')
    <title>Search for Adoption Centers</title>
@endpush

@extends('layouts.app')

@section('content')
<div id="content" class="grey-bg">
    <div class="section">
        <p class="padding-bottom-0">
            <a href="/">Home</a> &gt;&gt; <a href="/search">Search Form</a>
        </p>
        <span class="col-7">
            <h2>Search for Adoption Centers </h2><br />
            <p><?php echo $message ?></p>
    
            <table width="100%" class="widgetized">
                <?php
                $i=0;
                /** @var \Application\Domain\Entity\Agency $agency */
                foreach ($agencies as $agency): $i++; ?>
                    <tr>
                        <td valign="top">
                            <a href="/agency-<?php echo $agency->id ?>.html"><?php echo $agency->name; ?></a><br/>
                            <strong>Location:</strong> <?php echo ucwords(strtolower($agency->city)) . ", " . $agency->state . " - " . $agency->zip ?> <br />
                            <strong>Contact Phone</strong>: <?php echo $agency->phone ?><br/>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </span>
    </div>
</div> 
@endsection
