<div class="container">
    @if(is_page())
    <h2 class="submssion-title">{{get_the_title()}}</h2>
    @endif
    <div class="row">
        @php
            $i =0;


        @endphp
        @foreach($submssions as $submssion)
            @php
            $image = "<a href=".url('submission/'.$submssion->id)."><img class='img-fluid' src='https://godigital.motc.gov.qa/media/com_eventbooking/images/thumbs/Nov26-3.jpg' alt='' /></a>";
            @endphp
         <div class="col-lg-4">

            @if($type == 'training')

                <div class="uc-seassions">
                    <h3><a href="{{ url('submission/'.$submssion->id) }}">{{ $submssion->training_title}}</a></h3>
                    <div class="uc-thumb">
                       @if($submssion->image_cover)
                             <a href="{{ url('submission/'.$submssion->id) }}"><img class='img-fluid' src="{{$submssion->image_cover}}" alt='' /></a>
                            @else
                             <a href="{{ url('submission/'.$submssion->id) }}"><img class='img-fluid' src="{{ plugin_dir_url( __DIR__ ) . 'images/default.jpg'}}" alt='' /></a>
                             
                            @endif
                        <span class="address">{{ $submssion->training_organizer}}</span>
                    </div>
                    <div class="uc-meta">
                        <span class="date">{{ $submssion->training_issued_date}}</span>
                        <!--<span class="time">15:30 -17:30</span>-->
                    </div>
                    <div class="uc-buttons">
                            <!--<a class="reg" href="#">Register</a>-->
                        <a class="details" href="{{ url('submission/'.$submssion->id) }}">Details</a>
                    </div>
                </div>

            @elseif($type == 'event')

                <div class="uc-seassions">
                    <h3><a href="{{ url('submission/'.$submssion->id) }}">{{ $submssion->event_title}}</a></h3>
                    <div class="uc-thumb">
                        
                        @if($submssion->image_cover)
                             <a href="{{ url('submission/'.$submssion->id) }}"><img class='img-fluid' src="{{$submssion->image_cover}}" alt='' /></a>
                            @else
                             <a href="{{ url('submission/'.$submssion->id) }}"><img class='img-fluid' src="{{ plugin_dir_url( __DIR__ ) . 'images/default.jpg'}}" alt='' /></a>
                             
                            @endif

                        <span class="address">{{ $submssion->event_organizer}}</span>
                    </div>
                    <div class="uc-meta">
                        <span class="date">{{ $submssion->event_start_date}}</span>
                        <!--<span class="time">15:30 -17:30</span>-->
                    </div>
                    <div class="uc-buttons">
                            <!--<a class="reg" href="#">Register</a>-->
                            <a class="details" href="{{ url('submission/'.$submssion->id) }}">Details</a>
                   </div>
                </div>

            @elseif($type == 'journal')

                <div class="uc-seassions">
                    <h3><a href="{{ url('submission/'.$submssion->id) }}">{{ $submssion->journal_title}}</a></h3>
                    <div class="uc-thumb">
                       @if($submssion->image_cover)
                             <a href="{{ url('submission/'.$submssion->id) }}"><img class='img-fluid' src="{{$submssion->image_cover}}" alt='' /></a>
                            @else
                             <a href="{{ url('submission/'.$submssion->id) }}"><img class='img-fluid' src="{{ plugin_dir_url( __DIR__ ) . 'images/default.jpg'}}" alt='' /></a>
                             
                            @endif
                        <span class="address">{{ $submssion->journal_organization}}</span>
                    </div>
                    <div class="uc-meta">
                        <span class="date">{{ $submssion->journal_issued_date}}</span>
                        <!--<span class="time">15:30 -17:30</span>-->
                    </div>
                    <div class="uc-buttons">
                            <!--<a class="reg" href="#">Register</a>-->
                            <a class="details" href="{{ url('submission/'.$submssion->id) }}">Details</a>
                    </div>
                </div>
            @elseif($type == 'reports')

                    <div class="uc-seassions">
                        <h3><a href="{{ url('submission/'.$submssion->id) }}">{{ $submssion->report_title}}</a></h3>
                        <div class="uc-thumb">
                          
                            @if($submssion->image_cover)
                             <a href="{{ url('submission/'.$submssion->id) }}"><img class='img-fluid' src="{{$submssion->image_cover}}" alt='' /></a>
                            @else
                             <a href="{{ url('submission/'.$submssion->id) }}"><img class='img-fluid' src="{{ plugin_dir_url( __DIR__ ) . 'images/default.jpg'}}" alt='' /></a>
                             
                            @endif
                            
                            <span class="address">{{ $submssion->report_organization}}</span>
                        </div>
                        <div class="uc-meta">
                            <span class="date">{{ $submssion->yearterm}}</span>
                           <!--<span class="time">15:30 -17:30</span>-->
                        </div>
                        <div class="uc-buttons">
                            <!--<a class="reg" href="#">Register</a>-->
                            <a class="details" href="{{ url('submission/'.$submssion->id) }}">Details</a>
                        </div>
                    </div>
            @endif

        </div>
        @php
            $i++;
            if ($i % 3 == 0) {echo '</div><div class="row">';}
        @endphp

        @endforeach


    </div>
</div>

<div class="tablenav bottom alignleft">
    {!! $submssions->links('pagination.bootstrap-4') !!}
</div>

