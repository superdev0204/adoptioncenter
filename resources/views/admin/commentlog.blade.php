@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div>
            <a href="/admin">Admin</a> &gt;&gt; Reviews <br />
            <h1>New Reviews</h1>
            <table width="100%">
                <tr>
                    <th>Details</th>
                    <th>Comments</th>
                    <th align="center">Action</th>
                </tr>
                <?php $i = 0;
            /** @var \Application\Domain\Entity\Comment $comment */
            foreach ($comments as $comment): ?>
                <tr class="d<?php echo $i % 2;
                $i++; ?>">
                    <td width="25%">
                        <a target="_blank" href="/agency-<?php echo optional($comment->agency)->id; ?>.html"><?php echo $comment->name; ?></a><br />
                        <?php echo $comment->email; ?> <br />
                        <?php echo $comment->created; ?><br />
                        <?php echo $comment->ip_address; ?>
                    </td>
                    <td>
                        <?php if($comment->approved == 0): ?>
                        <?php echo $comment->comment; ?>
                        <?php else: ?>
                        <?php echo substr($comment->comment, 0, 200); ?>
                        <?php endif;?>
                    </td>
                    <td>
                        <?php if($comment->approved == 0): ?>
                        <form method="post" action="/admin/comment/approve">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $comment->id; ?>" />
                            <input type="submit" value="Approve" />
                        </form>
                        <?php endif;?>
                        <br />
                        <form method="post" action="/admin/comment/disapprove">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $comment->id; ?>" />
                            <input type="submit" value="Not Approve" />
                        </form>
                        <br /><br />
                        <form method="post" action="/admin/comment/delete">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $comment->id; ?>" />
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
                <?php endforeach;?>
            </table><br />
            <div class="clear"></div>
        </div>
    </div>
@endsection
