@push('title')
    <title>Update {{ $agency->name }}</title>
@endpush

@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script>
    <script src="{{ asset('js/tiny_mce/tiny_mce_activate.js') }}"></script>

    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                <a href="/">Home</a> &gt;&gt;
                <a href="/agency-<?php echo $agency->id; ?>.html">Agency Detail</a> &gt;&gt;
                Update Agency Information
            </p>
        </div>
        <div>
            <span class="col-7">
                <?php if (isset($message)) :?>
                <p><?php echo $message; ?></p>
                <?php endif;?>

                @if ($message == '')
                    <form method="post">
                        @csrf
                        <dl class="zend_form">
                            <dt id="agency-label">&nbsp;</dt>
                            <dd id="agency-element">
                                <fieldset id="fieldset-agency">
                                    <legend>Agency Location Information</legend>
                                    <dl>
                                        <dt id="name-label"><label for="name">Name:</label></dt>
                                        <dd id="name-element">
                                            @if (isset($request->name))
                                                <input type="text" id="name" name="name" value="{{ $request->name }}">
                                            @else
                                                @if (!empty(old('name')))
                                                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                                                @else
                                                    <input type="text" id="name" name="name" value="{{ $agency->name }}">
                                                @endif
                                            @endif
                                            @error('name')
                                                <ul>
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </dd>
                                        <dt id="address-label"><label for="address">Address:</label></dt>
                                        <dd id="address-element">
                                            @if (isset($request->address))
                                                <input type="text" id="address" name="address" value="{{ $request->address }}">
                                            @else
                                                @if (!empty(old('address')))
                                                    <input type="text" id="address" name="address" value="{{ old('address') }}">
                                                @else
                                                    <input type="text" id="address" name="address" value="{{ $agency->address }}">
                                                @endif
                                            @endif
                                            @error('address')
                                                <ul>
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </dd>
                                        <dt id="city-label"><label for="city">City:</label></dt>
                                        <dd id="city-element">
                                            @if (isset($request->city))
                                                <input type="text" id="city" name="city" value="{{ $request->city }}">
                                            @else
                                                @if (!empty(old('city')))
                                                    <input type="text" id="city" name="city" value="{{ old('city') }}">
                                                @else
                                                    <input type="text" id="city" name="city" value="{{ $agency->city }}">
                                                @endif
                                            @endif
                                            @error('city')
                                                <ul>
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </dd>
                                        <dt id="county-label"><label for="county">County:</label></dt>
                                        <dd id="county-element">
                                            @if (isset($request->county))
                                                <input type="text" id="county" name="county" value="{{ $request->county }}">
                                            @else
                                                @if (!empty(old('county')))
                                                    <input type="text" id="county" name="county" value="{{ old('county') }}">
                                                @else
                                                    <input type="text" id="county" name="county" value="{{ $agency->county }}">
                                                @endif
                                            @endif
                                            @error('county')
                                                <ul>
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </dd>
                                        <dt id="state-label"><label for="state">State:</label></dt>
                                        <dd id="state-element">
                                            <select id="state" name="state">
                                                <option value="">-Select-</option>
                                                @foreach ($states as $state)
                                                    @if (isset($request->state))
                                                        @if ($state->state_code == $request->state)
                                                            <option value='{{ $state->state_code }}' selected>
                                                                {{ $state->state_name }}</option>
                                                        @else
                                                            <option value='{{ $state->state_code }}'>
                                                                {{ $state->state_name }}</option>
                                                        @endif
                                                    @else
                                                        @if (!empty(old('state')))
                                                            @if ($state->state_code == old('state'))
                                                                <option value='{{ $state->state_code }}' selected>{{ $state->state_name }}</option>
                                                            @else
                                                                <option value='{{ $state->state_code }}'>{{ $state->state_name }}</option>
                                                            @endif
                                                        @else
                                                            @if ($state->state_code == $agency->state)
                                                                <option value='{{ $state->state_code }}' selected>{{ $state->state_name }}</option>
                                                            @else
                                                                <option value='{{ $state->state_code }}'>{{ $state->state_name }}</option>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </dd>
                                        <dt id="zip-label"><label for="zip">Zip Code:</label></dt>
                                        <dd id="zip-element">
                                            @if (isset($request->zip))
                                                <input type="text" id="zip" name="zip" value="{{ $request->zip }}">
                                            @else
                                                @if (!empty(old('zip')))
                                                    <input type="text" id="zip" name="zip" value="{{ old('zip') }}">
                                                @else
                                                    <input type="text" id="zip" name="zip" value="{{ $agency->zip }}">
                                                @endif
                                            @endif
                                            @error('zip')
                                                <ul>
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </dd>
                                    </dl>
                                </fieldset>
                            </dd>
                            <dt id="contact-label">&nbsp;</dt>
                            <dd id="contact-element">
                                <fieldset id="fieldset-contact">
                                    <legend>Agency Information</legend>
                                    <dl>
                                        <dt id="phone-label"><label for="phone">Phone:</label></dt>
                                        <dd id="phone-element">
                                            @if (isset($request->phone))
                                                <input type="text" id="phone" name="phone" value="{{ $request->phone }}">
                                            @else
                                                @if (!empty(old('phone')))
                                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
                                                @else
                                                    <input type="text" id="phone" name="phone" value="{{ $agency->phone }}">
                                                @endif
                                            @endif
                                            @error('phone')
                                                <ul>
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </dd>
                                        <dt id="contact-label"><label for="contact">Contact Name:</label></dt>
                                        <dd id="contact-element">
                                            @if (isset($request->contact))
                                                <input type="text" id="contact" name="contact" value="{{ $request->contact }}">
                                            @else
                                                @if (!empty(old('contact')))
                                                    <input type="text" id="contact" name="contact" value="{{ old('contact') }}">
                                                @else
                                                    <input type="text" id="contact" name="contact" value="{{ $agency->contact }}">
                                                @endif
                                            @endif
                                            @error('contact')
                                                <ul>
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </dd>
                                        <dt id="email-label"><label for="email">Contact Email:</label></dt>
                                        <dd id="email-element">
                                            @if (isset($request->email))
                                                <input type="email" id="email" name="email" value="{{ $request->email }}">
                                            @else
                                                @if (!empty(old('email')))
                                                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                                                @else
                                                    <input type="email" id="email" name="email" value="{{ $agency->email }}">
                                                @endif
                                            @endif
                                            @error('email')
                                                <ul>
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </dd>
                                        <dt id="website-label"><label for="website">Website:</label></dt>
                                        <dd id="website-element">
                                            @if (isset($request->website))
                                                <input type="text" id="website" name="website" value="{{ $request->website }}">
                                            @else
                                                @if (!empty(old('website')))
                                                    <input type="text" id="website" name="website" value="{{ old('website') }}">
                                                @else
                                                    <input type="text" id="website" name="website" value="{{ $agency->website }}">
                                                @endif
                                            @endif
                                            @error('website')
                                                <ul>
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </dd>
                                        <dt id="details-label"><label for="details">Details:</label></dt>
                                        <dd id="details-element">
                                            @if (isset($request->details))
                                                <textarea id="details" name="details" cols="15" rows="5">{{ $request->details }}</textarea>
                                            @else
                                                @if (!empty(old('details')))
                                                    <textarea id="details" name="details" cols="15" rows="5">{{ old('details') }}</textarea>
                                                @else
                                                    <textarea id="details" name="details" cols="15" rows="5">{{ $agency->details }}</textarea>
                                                @endif
                                            @endif
                                            @error('details')
                                                <ul>
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            @enderror
                                        </dd>
                                    </dl>
                                </fieldset>
                            </dd>
                            <dt id="challenge-label">&nbsp;</dt>
                            <dd id="challenge-element">
                                <input type="hidden" name="challenge" value="g-recaptcha-response">
                                <script type="text/javascript" src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>
                                <div class="g-recaptcha" data-sitekey="{{ env('DATA_SITEKEY') }}" data-theme="light"
                                    data-type="image" data-size="normal">
                                </div>
                                @error('recaptcha-token')
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                @enderror
                            </dd>
                            <dt id="addNew-element">&nbsp;</dt>
                            <dd id="addNew-element">
                                <input type="submit" name="submit" value="Submit">
                            </dd>
                        </dl>
                    </form>
                @endif

                <div class="clear"></div>
            </span>
            <span class="col-4">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px"
                    data-ad-client="ca-pub-8651736830870146" data-ad-slot="3476733769"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </span>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
@endsection
