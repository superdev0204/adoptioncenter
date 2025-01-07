@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div>
            <a href="/admin">Admin</a> &gt;&gt; Search Form
            <div>
                <h2>Search for Food-Banks</h2>
            </div>
            <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
            <?php endif; ?>
            <form method="post">
                @csrf
                <dl class="zend_form">
                    <dt id="name-label"><label for="name">Name:</label></dt>
                    <dd id="name-element">
                        @if (isset($request->name))
                            <input id="name" name="name" type="text" value="{{ $request->name }}">
                        @else
                            <input id="name" name="name" type="text" value="">
                        @endif
                    </dd>
                    <dt id="phone-label"><label for="phone">Phone:</label></dt>
                    <dd id="phone-element">
                        @if (isset($request->phone))
                            <input id="phone" name="phone" type="text" value="{{ $request->phone }}">
                        @else
                            <input id="phone" name="phone" type="text" value="">
                        @endif
                    </dd>
                    <dt id="address-label"><label for="address">Address:</label></dt>
                    <dd id="address-element">
                        @if (isset($request->address))
                            <input id="address" name="address" type="text" value="{{ $request->address }}">
                        @else
                            <input id="address" name="address" type="text" value="">
                        @endif
                    </dd>
                    <dt id="zip-label"><label for="zip">In ZIP Code (i.e. 33781):</label></dt>
                    <dd id="zip-element">
                        @if (isset($request->zip))
                            <input id="zip" name="zip" type="text" value="{{ $request->zip }}">
                        @else
                            <input id="zip" name="zip" type="text" value="">
                        @endif
                    </dd>
                    <dt id="city-label"><label for="city">City (i.e Orlando):</label></dt>
                    <dd id="city-element">
                        @if (isset($request->city))
                            <input id="city" name="city" type="text" value="{{ $request->city }}">
                        @else
                            <input id="city" name="city" type="text" value="">
                        @endif
                    </dd>
                    <dt id="state-label"><label for="state">State:</label></dt>
                    <dd id="state-element">
                        <select id="state" name="state">
                            <option value="">-Select-</option>
                            @foreach ($states as $state)
                                @if (isset($request->state))
                                    @if ($state->state_code == $request->state)
                                        <option value='{{ $state->state_code }}' selected>
                                            {{ $state->state_name }}
                                        </option>
                                    @else
                                        <option value='{{ $state->state_code }}'>{{ $state->state_name }}</option>
                                    @endif
                                @else
                                    <option value='{{ $state->state_code }}'>{{ $state->state_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </dd>
                    <dt id="email-label"><label for="email">Email address:</label></dt>
                    <dd id="email-element">
                        @if (isset($request->email))
                            <input id="email" name="email" type="email" value="{{ $request->email }}">
                        @else
                            <input id="email" name="email" type="email" value="">
                        @endif
                    </dd>
                    <dt id="id-label"><label for="id">Foodbank ID:</label></dt>
                    <dd id="id-element">
                        @if (isset($request->id))
                            <input id="id" name="id" type="text" value="{{ $request->id }}">
                        @else
                            <input id="id" name="id" type="text" value="">
                        @endif
                    </dd>
                    <dt id="search-label">&nbsp;</dt>
                    <dd id="search-element">
                        <input type="submit" name="search" id="search" value="Search">
                    </dd>
                </dl>
            </form>

            <?php if (isset($agencies)):?>
            <table width="100%">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php $i = 0; 
                /** @var \Application\Domain\Entity\Facility $foodbank */
                foreach ($agencies as $agency): ?>
                <tr class="d<?php echo $i % 2;
                $i++; ?>">
                    <td width="40%">
                        <a target="_blank" href="/agency-<?php echo $agency->id; ?>.html"><?php echo $agency->name; ?></a><br />
                        <?php echo $agency->phone; ?>
                    </td>
                    <td width="35%">
                        <?php echo $agency->address; ?> <br />
                        <?php echo $agency->city . ', ' . $agency->state . ' ' . $agency->zip; ?>
                    </td>
                    <td>
                        <form method="get" action="/admin/agency/edit">
                            <input type="hidden" name="id" value="<?php echo $agency->id; ?>" />
                            <input type="submit" value=" Update " />
                        </form>
                    </td>
                    <td>
                        <?php if ($agency->approved >= 0) : ?>
                        <form method="post" action="/admin/agency/delete">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $agency->id; ?>" />
                            <input type="submit" name="delete" value="Delete " />
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach;?>
            </table><br />
            <?php endif; ?>
        </div>
    </div>
@endsection
