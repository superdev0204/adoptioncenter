@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div>
            <a href="/">Home</a> &gt;&gt; Admin <br />

            <h1>New Agency Listings</h1>
            <table width="100%">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th align="center">Action</th>
                </tr>
                <?php $i = 0; 
            /** @var \Application\Domain\Entity\Agency $agency */
            foreach ($agencies as $agency): ?>
                <tr class="d<?php echo $i % 2;
                $i++; ?>">
                    <td width="40%">
                        <a target="_blank" href="/agency-<?php echo $agency->id; ?>.html"><?php echo $agency->name; ?></a><br />
                        <?php echo $agency->phone; ?>
                    </td>
                    <td width="30%">
                        <?php echo $agency->address; ?> <br />
                        <?php echo $agency->city . ', ' . $agency->state . ' ' . $agency->zip; ?>
                    </td>
                    <td>
                        <form method="post" action="/admin/agency/approve">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $agency->id; ?>" />
                            <input type="submit" value="Approve" />
                        </form>
                        <form method="post" action="/admin/agency/disapprove">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $agency->id; ?>" />
                            <input type="submit" value="Not Approve" />
                        </form>
                        <form method="get" action="/admin/agency/edit">
                            <input type="hidden" name="id" value="<?php echo $agency->id; ?>" />
                            <input type="submit" value="Update" />
                        </form>
                        <form method="post" action="/admin/agency/delete">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $agency->id; ?>" />
                            <input type="submit" size="10" value="Delete" />
                        </form><br />
                    </td>
                </tr>
                <?php endforeach;?>
            </table><br />
            <div class="clear"></div>
            <h1>New updates</h1>
            <table width="100%">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                </tr>
                <?php $i = 0;
            /** @var \Application\Domain\Entity\AgencyLog $agencyLog */
            foreach ($agencyLogs as $agencyLog): ?>
                <tr class="d<?php echo $i % 2;
                $i++; ?>">
                    <td width="40%">
                        <a href="/admin/agency-log/show/id/<?php echo $agencyLog->id; ?>"><?php echo $agencyLog->name; ?></a>
                    </td>
                    <td>
                        <?php echo $agencyLog->address; ?>
                    </td>
                    <td>
                        <?php echo $agencyLog->phone; ?>
                    </td>
                </tr>
                <?php endforeach;?>
            </table><br />

            <a href="/admin/agency/search">Find Agencies</a> | 
            <a href="/admin/comment">Reviews Admin</a> | 
            <a href="/admin/question">Q/A Admin</a> | 
            <a href="/admin/visitor_counts">Visitor Counts</a>
            <div class="clear"></div>
        </div>
    </div>
@endsection
