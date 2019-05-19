@extends('admin.layouts.default')
@section('heading')
<h1>All Available Shortcodes , how to use </h1>
@endsection
@section('content')

 <div class="wrap">
            <div id="icon-options-general" class="icon32"><br></div>

            <div class="section panel">

                <h4> Copy :  [EventSubmission filter_by="past" per_page=1][/EventSubmission] to any page or post </h4>
                    <p><b> this shortcode will get the past events or upcoming events as you want</b></p>
                    <ul>
                        <li>- filter_by att use to  filter which Submission you wanna get ( upcoming , past )</li>
                        <li>- per_page att use to  limit data per page for example you wanna get just 1 Submission upcoming in every page and then include the pagination
                              code will be.. [EventSubmission filter_by="upcoming"  per_page=1 ][/EventSubmission] </li>
                    </ul>

                  <hr>
                 <h4> Copy : [TrainingSubmission filter_by="past" per_page=3][/TrainingSubmission]  to any page or post</h4>

                    <p><b>same the EventSubmission settings but will return the TrainingSubmission</b></p>
                  <hr>
                 <h4>Copy :   [count_events_training type="journal"][/count_events_training] </h4>

                    <p><b>this will return the count of events or training approved from the admin  </b></p>

                    <ul>
                        <li>- attr type to select which type for check counts (journal,event,traning)</li>
                    </ul>
                 <hr>

                <h4> Copy :  [submssion_count_all][/submssion_count_all]  to any page or post</h4>

                    <p><b>this will return the count of events , training and journal  approved from the admin  </b></p>

                    <ul>
                        <h4> like this </h4>
                        <li>3 Journal article or conference pape submissions</li>
                        <li>5 Event or Campaign submissions</li>
                        <li>1 Training submissions</li>
                    </ul>
                 <hr>

                 <h4>Copy :  [LatestSubmssion type="event" limit=5][/LatestSubmssion]  to any page or post</h4>

                    <p><b>this will return last 5 events Submssion approved from the admin  </b></p>

                    <ul>
                        <li>- type att select ( event , journal,training )</li>
                        <li>- limit att use to limit output  </li>
                    </ul>
                 <hr>

            </div>
        </div>

@endsection