@push('title')
    <title>Search for Adoption Agencies or Adoption Centers</title>
@endpush

@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div class="section">
            <p class="padding-bottom-0">
                <a href="/">Home</a> &gt;&gt; <a href="/search">Search Form</a>
            </p>
        </div>
        <div>
            <span class="col-7">
                <h1>Search for Adoption Centers</h1>

                <p><?php echo $message; ?></p>

                <form method="post" action="/search">
                    @csrf
                    <dl class="zend_form">
                        <dd id="requiredfields-element">
                            <fieldset id="fieldset-requiredfields">
                                <legend>Required Fields (Enter ZIP Code or City/State)</legend>
                                <dl>
                                    <dt id="location-label"><label for="location">Location:</label></dt>
                                    <dd id="location-element">
                                        @if (isset($request->location))
                                            <input type="text" id="location" name="location" value="{{ $request->location }}">
                                        @else
                                            <input type="text" id="location" name="location" value="{{ old('location') }}">
                                        @endif
                                        @error('location')
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </dd>
                                </dl>
                            </fieldset>
                        </dd>
                        <dt id="optionalfields-label">&nbsp;</dt>
                        <dd id="optionalfields-element">
                            <fieldset id="fieldset-optionalfields">
                                <legend>Optional Fields</legend>
                                <dl>
                                    <dt id="name-label"><label for="name">Clinic Name:</label></dt>
                                    <dd id="name-element">
                                        @if (isset($request->name))
                                            <input type="text" id="name" name="name" value="{{ $request->name }}">
                                        @else
                                            <input type="text" id="name" name="name" value="{{ old('name') }}">
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
                                            <input type="text" id="address" name="address" value="{{ old('address') }}">
                                        @endif
                                        @error('address')
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </dd>
                                    <dt id="phone-label"><label for="phone">Phone:</label></dt>
                                    <dd id="phone-element">
                                        @if (isset($request->phone))
                                            <input type="text" id="phone" name="phone" value="{{ $request->phone }}">
                                        @else
                                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
                                        @endif
                                        @error('phone')
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </dd>
                                </dl>
                            </fieldset>
                        </dd>
                        <dt id="search-label">&nbsp;</dt>
                        <dd id="search-element">
                            <input type="submit" name="submit" value="Search">
                        </dd>
                    </dl>

                    <div class="clear"></div>

                    <span class="col-4">
                        <script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px"
                            data-ad-client="ca-pub-8651736830870146" data-ad-slot="3476733769"
                            data-adsbygoogle-status="done" data-ad-status="unfilled">
                            <div id="aswift_0_host"
                                style="border: none; height: 600px; width: 160px; margin: 0px; padding: 0px; position: relative; visibility: visible; background-color: transparent; display: inline-block;">
                                <iframe id="aswift_0" name="aswift_0"
                                    style="left:0;position:absolute;top:0;border:0;width:160px;height:600px;"
                                    sandbox="allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation"
                                    width="160" height="600" frameborder="0" marginwidth="0" marginheight="0"
                                    vspace="0" hspace="0" allowtransparency="true" scrolling="no"
                                    src="https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-8651736830870146&amp;output=html&amp;h=600&amp;slotname=3476733769&amp;adk=3955416225&amp;adf=2569697050&amp;pi=t.ma~as.3476733769&amp;w=160&amp;abgtt=5&amp;lmt=1715156507&amp;format=160x600&amp;url=https%3A%2F%2Fadoptioncenter.us%2Fsearch&amp;wgl=1&amp;uach=WyJXaW5kb3dzIiwiOC4wLjAiLCJ4ODYiLCIiLCIxMjQuMC42MzY3LjExOSIsbnVsbCwwLG51bGwsIjY0IixbWyJDaHJvbWl1bSIsIjEyNC4wLjYzNjcuMTE5Il0sWyJHb29nbGUgQ2hyb21lIiwiMTI0LjAuNjM2Ny4xMTkiXSxbIk5vdC1BLkJyYW5kIiwiOTkuMC4wLjAiXV0sMF0.&amp;dt=1715156507895&amp;bpp=2&amp;bdt=37&amp;idt=50&amp;shv=r20240506&amp;mjsv=m202405020101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D7a3695bfa6103bf2%3AT%3D1715156287%3ART%3D1715156287%3AS%3DALNI_Mbkw3vszOOaZYsO4AhvzW4qQNH_Hw&amp;gpic=UID%3D00000e131e41f5a9%3AT%3D1715156287%3ART%3D1715156287%3AS%3DALNI_MYJOrUfESOHrHT0Lmn2l_CYbABXmQ&amp;eo_id_str=ID%3Dd5c8e9d375002b76%3AT%3D1715156287%3ART%3D1715156287%3AS%3DAA-Afjaj1kEDj6qtAsseG5qW6Hbz&amp;correlator=890443547048&amp;frm=20&amp;pv=2&amp;ga_vid=1209842577.1715151512&amp;ga_sid=1715156508&amp;ga_hid=1620180665&amp;ga_fc=1&amp;u_tz=-480&amp;u_his=7&amp;u_h=1080&amp;u_w=1920&amp;u_ah=1040&amp;u_aw=1920&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=477&amp;ady=841&amp;biw=1903&amp;bih=953&amp;scr_x=0&amp;scr_y=0&amp;eid=44759875%2C44759926%2C44759837%2C31083304%2C95331983%2C95329830%2C31082249%2C95331043&amp;oid=2&amp;pvsid=3444937767665616&amp;tmod=1412225504&amp;uas=0&amp;nvt=1&amp;ref=https%3A%2F%2Fadoptioncenter.us%2F&amp;fc=896&amp;brdim=0%2C0%2C0%2C0%2C1920%2C0%2C1920%2C1040%2C1920%2C953&amp;vis=1&amp;rsz=%7C%7CleE%7C&amp;abl=CS&amp;pfx=0&amp;fu=0&amp;bc=31&amp;bz=1&amp;psd=W251bGwsbnVsbCxudWxsLDNd&amp;ifi=1&amp;uci=a!1&amp;fsb=1&amp;dtd=59"
                                    data-google-container-id="a!1" tabindex="0" title="Advertisement"
                                    aria-label="Advertisement" data-load-complete="true"
                                    data-google-query-id="COL8lfPP_YUDFbNgHgIdLqMBSQ"></iframe></div>
                        </ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </span>
                    <div class="clear"></div>
                </form>
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
