@push('meta')
    <meta name="description" content="Adoption resources and adoption agency directory">
    <meta name="keywords" content="adoption agencies, adoption center, foster care">
@endpush

@push('title')
    <title>Adoption Agencies | Adoption Center | Adoption Resources</title>
@endpush

@extends('layouts.app')

@section('content')
    <div id="content" class="grey-bg">
        <div id="section" class="abt_wic">
            <div>
                <h1>Adoption Center</h1>
                <p>Find adoption agencies in your area to help with adoption process. </p>
            </div>
            <div id="figure">
                <img src="{{ asset('/images/adoption.jpg') }}" alt="Adoption" />
                <span></span>
            </div>
            <span class="background"></span>
        </div>
    </div>
    <div id="content" class="white-bg">
        <div id="section">
            <strong>
                <p>Please use the links below to find Adoption Centers in your area</p>
            </strong>
            <div id="figure" class="us_map">
                <img src="{{ asset('/images/usa-map.jpg') }}" class="map" border="0" usemap="#usmap"
                    alt="Map of Petshelters in the United States">
            </div>
            <map name="usmap" id="usmap">
                <area shape="poly" coords="94,76,127,85,118,118,157,181,147,200,126,195,101,166,90,118,88,94"
                    href="/california-adoption" title="California Adoption Center">
                <area shape="poly" coords="70,137,111,207,63,188,10,215,25,139,42,129" href="/alaska-adoption"
                    title="Alaska Adoption Center">
                <area shape="poly" coords="151,92,95,76,111,31,119,41,140,45,161,48" href="/oregon-adoption"
                    title="Oregon Adoption Center">
                <area shape="poly" coords="130,5,168,15,160,47,121,39,112,28,112,7" href="/washington-adoption"
                    title="Washington Adoption Center">
                <area shape="poly" coords="154,173,161,162,176,97,150,93,128,87,120,117" href="/nevada-adoption"
                    title="Nevada Adoption Center">
                <area shape="poly" coords="199,100,204,73,189,71,183,48,176,19,169,17,154,91" href="/idaho-adoption"
                    title="Idaho Adoption Center">
                <area shape="poly" coords="177,99,198,102,197,113,214,116,207,160,165,152" href="/utah-adoption"
                    title="Utah Adoption Center">
                <area shape="poly" coords="69,221,141,260,168,290,145,304,125,265,87,245,63,232" href="/hawaii-adoption"
                    title="Hawaii Adoption Center">
                <area shape="poly" coords="165,155,206,162,196,222,180,221,150,201,161,182,158,174"
                    href="/arizona-adoption" title="Arizona Adoption Center">
                <area shape="poly" coords="180,19,191,69,203,71,205,65,260,74,264,32" href="/arizona-adoption"
                    title="Montana Adoption Center">
                <area shape="poly" coords="207,70,200,111,255,118,259,77" href="/wyoming-adoption"
                    title="Wyoming Adoption Center">
                <area shape="poly" coords="216,117,273,123,269,165,210,159" href="/colorado-adoption"
                    title="Colorado Adoption Center">
                <area shape="poly" coords="210,163,201,222,220,218,255,221,259,168" href="/new_mexico-adoption"
                    title="New Mexico Adoption Center">
                <area shape="poly" coords="267,34,265,63,319,66,316,35" href="/north_dakota-adoption"
                    title="North Dakota Adoption Center">
                <area shape="poly" coords="264,66,261,97,320,103,320,71" href="/south_dakota-adoption"
                    title="South Dakota Adoption Center">
                <area shape="poly" coords="262,101,260,118,276,120,276,131,328,134,319,107" href="/nebraska-adoption"
                    title="Nebraska Adoption Center">
                <area shape="poly" coords="275,135,273,165,336,168,331,137" href="/kansas-adoption"
                    title="Kansas Adoption Center">
                <area shape="poly" coords="263,168,262,173,288,175,289,194,320,205,338,207,335,170"
                    href="/oklahoma-adoption" title="Oklahoma Adoption Center">
                <area shape="poly"
                    coords="262,175,287,177,287,196,322,208,341,210,347,238,343,252,320,265,309,279,311,292,288,276,265,248,252,255,237,238,224,222,258,224"
                    href="/texas-adoption" title="Texas Adoption Center">
                <area shape="poly" coords="347,251,351,237,345,216,368,215,370,223,365,235,382,237,390,256"
                    href="/louisiana-adoption" title="Louisiana Adoption Center">
                <area shape="poly" coords="319,35,323,72,323,95,364,95,352,82,355,64,358,54,373,45,336,34"
                    href="/minnesota-adoption" title="Minnesota Adoption Center">
                <area shape="poly" coords="323,97,363,97,373,111,364,127,329,128,324,110" href="/iowa-adoption"
                    title="Iowa Adoption Center">
                <area shape="poly" coords="337,132,361,131,385,168,381,178,376,175,339,175,336,143"
                    href="/missouri-adoption" title="Missouri Adoption Center">
                <area shape="poly" coords="338,177,379,179,375,192,368,205,368,213,344,214,340,204"
                    href="/arkansas-adoption" title="Arkansas Adoption Center">
                <area shape="poly" coords="372,59,387,50,419,61,433,83,438,95,432,108,404,111,404,82,395,71"
                    href="/michigan-adoption" title="Michigan Adoption Center">
                <area shape="poly" coords="357,61,355,81,367,95,373,106,392,105,391,98,396,76,381,66,370,61"
                    href="/wisconsin-adoption" title="Wisconsin Adoption Center">
                <area shape="poly" coords="374,108,393,108,396,116,398,147,394,157,392,165,385,166,365,131"
                    href="/illinois-adoption" title="Illinois Adoption Center">
                <area shape="poly" coords="398,116,403,113,418,112,422,143,412,153,396,156,401,147"
                    href="/indiana-adoption" title="Indiana Adoption Center">
                <area shape="poly" coords="420,112,431,110,438,113,452,105,456,120,444,144,423,140"
                    href="/ohio-adoption" title="Ohio Adoption Center">
                <area shape="poly" coords="385,173,440,166,448,157,441,145,425,143,415,156,396,159"
                    href="/kentucky-adoption" title="Kentucky Adoption Center">
                <area shape="poly" coords="379,190,431,186,453,166,384,175" href="/tennessee-adoption"
                    title="Tennessee Adoption Center">
                <area shape="poly" coords="376,193,396,191,398,240,387,243,385,236,368,234,374,223,371,207"
                    href="/mississippi-adoption" title="Mississippi Adoption Center">
                <area shape="poly" coords="399,192,419,190,429,232,406,234,406,241,400,241" href="/alabama-adoption"
                    title="Alabama Adoption Center">
                <area shape="poly"
                    coords="407,235,429,233,432,236,464,233,485,274,483,292,463,273,455,251,444,242,429,245,416,240,408,240"
                    href="/florida-adoption" title="Florida Adoption Center">
                <area shape="poly" coords="422,189,442,187,467,216,462,231,433,235" href="/georgia-adoption"
                    title="Georgia Adoption Center">
                <area shape="poly" coords="455,166,504,157,511,169,488,191,476,182,465,183,460,178,442,184,435,185"
                    href="/north_carolina-adoption" title="North Carolina Adoption Center">
                <area shape="poly" coords="447,189,469,214,485,193,473,184,466,185,459,182,450,184"
                    href="/south_carolina-adoption" title="South Carolina Adoption Center">
                <area shape="poly"
                    coords="448,158,444,165,503,155,496,142,488,139,488,134,480,132,473,142,465,154,455,158"
                    href="/virginia-adoption" title="Virginia Adoption Center">
                <area shape="poly" coords="504,141,502,149,518,159,529,157,530,149"
                    href="/district_of_columbia-adoption" title="Washington DC Adoption Center">
                <area shape="poly" coords="455,105,459,127,500,121,505,116,502,102,496,97"
                    href="/pennsylvania-adoption" title="Pennsylvania Adoption Center">
                <area shape="poly" coords="462,101,498,95,512,104,504,62,493,63,487,80,479,86,466,88"
                    href="/new_york-adoption" title="New York Adoption Center">
                <area shape="poly" coords="507,61,519,57,520,62,518,65,518,82,512,83" href="/vermont-adoption"
                    title="Vermont Adoption Center">
                <area shape="poly" coords="523,81,531,77,521,53,522,61,520,66,520,74" href="/new_hampshire-adoption"
                    title="New Hampshire Adoption Center">
                <area shape="poly" coords="524,54,532,73,554,49,543,27,537,24,530,26,527,34" href="/maine-adoption"
                    title="Maine Adoption Center">
                <area shape="poly" coords="513,84,537,77,555,78,555,85,534,92,529,87,513,90"
                    href="/massachusetts-adoption" title="Massachusetts Adoption Center">
                <area shape="poly" coords="526,89,528,96,546,107,554,106,553,95,535,93,529,89"
                    href="/rhode_island-adoption" title="Rhode Island Adoption Center">
                <area shape="poly" coords="512,93,524,90,526,97,543,108,532,111,521,99,516,102"
                    href="/connecticut-adoption" title="Connecticut Adoption Center">
                <area shape="poly" coords="534,135,534,146,507,140,490,137,482,127,498,126,502,135,507,137"
                    href="/maryland-adoption" title="Maryland Adoption Center">
                <area shape="poly"
                    coords="504,103,511,107,514,113,532,114,532,121,520,121,513,121,510,126,502,123,508,116,505,110"
                    href="/new_jersey-adoption" title="New Jersey Adoption Center">
                <area shape="poly" coords="503,135,532,133,531,123,509,129,503,129,500,123,498,129"
                    href="/delaware-adoption" title="Delaware Adoption Center">
                <area shape="poly" coords="445,146,455,127,460,131,478,127,481,130,472,142,465,151,451,157"
                    href="/west_virginia-adoption" title="West Virginia Adoption Center">
            </map>
            <div class="states">
                <ul>
                    <?php
                /** @var \Application\Domain\Entity\State $state */
                foreach ($states as $state) : ?>
                    <li><a href="/<?php echo $state->statefile; ?>-adoption"><?php echo $state->state_name; ?></a></li>
                    <?php endforeach;?>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="resources">
                <h3 class="no_head_pad">Adoption Resources</h3>
                <ul>
                    <?php
                /** @var \Application\Domain\Entity\Resource $resource */
                foreach ($resources as $resource) : ?>
                    <li><a href="/resource/<?php echo $resource->pagename; ?>">
                            <?php echo $resource->header; ?></a><br />
                        <?php echo $resource->description; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <span class="background"></span>
        </div>
    </div>
    <div id="content" class="grey-bg">
        <div id="section">
            <h2>Latest Update to Adoption Database</h2>
            <ul class="adoption-data">
                <?php
            /** @var \Application\Domain\Entity\Agency $agency */
            foreach ($agencies as $agency): ?>
                <li>
                    <a href="/agency-<?php echo $agency->id; ?>.html"><?php echo $agency->name; ?> </a><br />
                    <?php echo $agency->city . ', ' . $agency->state . ' ' . $agency->zip; ?> | <?php echo $agency->phone; ?><br />
                    <?php echo $agency->details; ?>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
@endsection
