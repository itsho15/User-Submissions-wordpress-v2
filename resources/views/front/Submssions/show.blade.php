@php get_header(); @endphp
<div class="container">

        <div class="uc-seassions-page">
           
            <div class="page-head d-flex justify-content-between">
                 
                <h3 class="submssion-title">
                
                    @switch($submission->type)
                            @case('journal')
                                {{ $submission->journal_title }}
                                @break
                            @case('event')
                                {{ $submission->event_title }}
                                @break
                            @case('training')
                                {{ $submission->training_title }}
                                @break
                            @case('reports')
                                {{ $submission->report_title }}
                                @break
                            @default
                                 {{ 'no title' }}
                                @break
                    @endswitch

                </h3>

                <a onclick="window.print();" class="uc-print"><i class="fas fa-print"></i></a>
            </div>
            
             @if($submission->image_cover)
                    <img src="{{ $submission->image_cover}}" alt="event image" class="img-responsive" style="max-width:100%">
                    @else
                     <img src="{{ plugin_dir_url( __DIR__ ) . 'images/default.jpg'}}" alt="event image" class="img-responsive" style="max-width:100%;height:auto;">
             @endif

            <p>

                @switch($submission->type)
                    @case('journal')

                        @break
                    @case('event')
                        @if($submission->event_summary_type !='')
                            <h3 class="uc-properties">Summary of event/campaign type:</h3>
                            <p>{{ $submission->event_summary_type }}</p>
                        @endif

                        @break
                    @case('training')

                        @break
                    @case('reports')
                        @if($submission->report_abstract !='')
                            <h3 class="uc-properties">Report Abstract:</h3>
                            <p>{{ $submission->report_abstract }}</p>
                        @endif
                        @break
                    @default
                         {{ 'no title' }}
                        @break
                @endswitch
            </p>

            <div class="uc-speaker">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="uc-right">

                                @switch($submission->type)
                                    @case('journal')
                                        @if($submission->journal_abstract !='')
                                            <h3 class="uc-properties">Abstract:</h3>
                                            <p>{{ $submission->journal_abstract }}</p>
                                        @endif
                                        @break
                                    @case('event')
                                            @if($submission->event_audience_target !='')
                                                <h3 class="uc-properties">Target audience:</h3>
                                                <p>{{ $submission->event_audience_target }}</p>
                                            @endif
                                        @break
                                    @case('training')
                                        @if($submission->training_description !='')
                                             <h3 class="uc-properties">Training description:</h3>
                                             <p>{{ $submission->training_description }}</p>
                                        @endif
                                        @break
                                    @case('reports')
                                        @if($submission->training_description !='')
                                            <h3 class="uc-properties">Report Abstract:</h3>
                                             <p>{{ $submission->report_abstract }}</p>
                                        @endif
                                        @break
                                    @default
                                         {{ 'no title' }}
                                        @break
                                @endswitch

                        </div>
                    </div>
                </div>
            </div>

            <h3 class="uc-properties">{{ ucfirst( $submission->type) }} Properties</h3>

            <ul class="uc-table">
                @switch($submission->type)
                    @case('journal')
                       <li><span class="uc-p-left">Date Issued:</span> <span class="uc-p-right">{{ $submission->journal_issued_date }}</span></li>
                       <li><span class="uc-p-left">Journal author:</span> <span class="uc-p-right">{{ $submission->journal_author }}</span></li>
                       <li><span class="uc-p-left">Journal authors:</span> <span class="uc-p-right">{{  $submission->journal_authors }}</span></li>
                       <li><span class="uc-p-left">Journal organization:</span> <span class="uc-p-right">{{  $submission->journal_organization }}</span></li>
                       <li><span class="uc-p-left">Journal/Conference Name:</span> <span class="uc-p-right">{{  $submission->journal_name }}</span></li>
                       <li><span class="uc-p-left">URL/website address:</span> <span class="uc-p-right"><a href="{{  $submission->journal_website }}" target="_blank"> {{  $submission->journal_website }} </a></span></li>
                       <li><span class="uc-p-left">Journal keywords:</span> <span class="uc-p-right">{{  $submission->journal_keywords }}</span></li>
                        @break
                    @case('event')
                        <li><span class="uc-p-left">Event start date:</span> <span class="uc-p-right">{{ $submission->event_start_date }}</span></li>
                       <li><span class="uc-p-left">Event author:</span> <span class="uc-p-right">{{ $submission->event_report_author }}</span></li>
                       <li><span class="uc-p-left">Event organizer:</span> <span class="uc-p-right">{{  $submission->event_organizer }}</span></li>
                       <li><span class="uc-p-left">Event duration:</span> <span class="uc-p-right">{{  $submission->event_duration }}</span></li>
                       <li><span class="uc-p-left">Event sponsor:</span> <span class="uc-p-right">{{  $submission->event_sponsor }}</span></li>
                       <li><span class="uc-p-left">URL/website address:</span> <span class="uc-p-right"><a href="{{  $submission->event_website }}" target="_blank"> {{  $submission->event_website }} </a></span></li>
                       <li><span class="uc-p-left">Event keywords:</span> <span class="uc-p-right">{{  $submission->event_keywords }}</span></li>
                        @break
                    @case('training')
                       <li><span class="uc-p-left">Date Issued:</span> <span class="uc-p-right">{{ $submission->training_issued_date }}</span></li>
                       <li><span class="uc-p-left">Training organizer:</span> <span class="uc-p-right">{{ $submission->training_organizer }}</span></li>
                        <li><span class="uc-p-left">Training provider:</span> <span class="uc-p-right">{{ $submission->training_provider }}</span></li>
                       <li><span class="uc-p-left">Registration fee:</span> <span class="uc-p-right">{{  $submission->training_fee }}</span></li>
                       <li><span class="uc-p-left">Attendance type:</span> <span class="uc-p-right">{{  $submission->training_type }}</span></li>
                       <li><span class="uc-p-left">Duration:</span> <span class="uc-p-right">{{  $submission->training_duration }}</span></li>
                       <li><span class="uc-p-left">URL/website address:</span> <span class="uc-p-right"><a href="{{  $submission->training_website }}" target="_blank"> {{  $submission->training_website }} </a></span></li>
                       <li><span class="uc-p-left">keywords:</span> <span class="uc-p-right">{{  $submission->training_keywords }}</span></li>
                        @break
                    @case('reports')
                       <li><span class="uc-p-left">Report organization:</span> <span class="uc-p-right">{{  $submission->report_organization }}</span></li>
                        <li><span class="uc-p-left">Year of release:</span> <span class="uc-p-right">{{ $submission->yearofrelease }}</span></li>
                       <li><span class="uc-p-left">State plan:</span> <span class="uc-p-right">{{ $submission->stateplan }}</span></li>
                       <li><span class="uc-p-left">Report authors:</span> <span class="uc-p-right">{{  $submission->report_authors }}</span></li>
                       <li><span class="uc-p-left">Year term:</span> <span class="uc-p-right">{{  $submission->yearterm }}</span></li>
                       <li><span class="uc-p-left">Report keywords:</span> <span class="uc-p-right">{{  $submission->report_keywords }}</span></li>
                        @break
                    @default
                         {{ 'no title' }}
                        @break
                @endswitch

                <li><span class="uc-p-left">Attachment</span>
                    <span class="uc-p-right">

                    @foreach($submission->documents as $key => $doc)
                    @php
                                 $filterdName = pathinfo($doc->name);
                    @endphp
                    <a class="uc-pdf" href="{{ $doc->name }}" target="_blank">{{ $filterdName['filename'].'.'.$filterdName['extension'] }}</a>

                    @endforeach

                    </span>
                </li>
            </ul>
        </div>
</div>
@php get_footer(); @endphp