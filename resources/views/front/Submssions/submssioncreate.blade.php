<?php

get_header();
?>

<style type="text/css">
    .callback {
        display: none;

    }

</style>

@if(is_user_logged_in())
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="submission-forms">
                    @include('admin.messages')
                    <h3>Upload your Research</h3>

                    <form name="submission_details" method="POST" action="" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ wpLumen()->csrf() }}"/>
                        <div class="form-group">
                            <label for="topic">Submission type:</label>
                            <select class="form-control" name="type">
                                  <option value="journal">Journal article/Conference paper</option>
                                  <option value="event">Event/Campaign</option>
                                  <option value="training">Training</option>
                                  <option value="reports">Reports</option>
                             </select>
                        </div>

                        <div class="form-group journal">

                            <div class="form-group">
                                <label for="organization">Submitting organization:</label>

                                <input type="text" class="form-control" id="organization" name="journal_organization" value="{{ $helper->request()->old('journal_organization') }}">
                            </div>

                            <div class="form-group">
                                <label for="Author">First Author:</label>
                                <input type="text" class="form-control" id="Author" name="journal_author" value="{{ $helper->request()->Input('journal_author') }}">
                            </div>

                            <div class="form-group">
                                <label for="journal_authors">Other authors:</label>
                                <textarea name="journal_authors" id="journal_authors" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="date_input">Date Issued:</label>
                                <input type="date" id="date_input" name="journal_issued_date" />
                            </div>

                            <div class="form-group">
                                <label for="journal_title">Title:</label>
                                <input type="text" class="form-control" id="journal_title" name="journal_title">
                            </div>

                            <div class="form-group">
                                <label for="Abstract">Abstract:</label>
                                <input type="text" class="form-control" id="Abstract" name="journal_abstract">
                            </div>

                            <div class="form-group">
                                <label for="Conference">Journal/Conference Name:</label>
                                <input type="text" class="form-control" id="Conference" name="journal_name">
                            </div>

                            <div class="form-group">
                                <label for="url_website">URL/website address:</label>
                                <input type="url" class="form-control" id="url_website" name="journal_website">
                            </div>


                            <div class="form-group">
                                <label for="journal_keywords">Keywords:</label>
                                <textarea class="form-control" id="journal_keywords" name="journal_keywords"> </textarea>
                            </div>

                        </div>

                        <div class="form-group event callback">

                            <div class="form-group">
                                <label for="event_organizer">Event organizer:</label>

                                <input type="text" class="form-control" id="event_organizer" name="event_organizer">
                            </div>

                            <div class="form-group">
                                <label for="event_sponsor">Event sponsor:</label>
                                <input type="text" class="form-control" id="event_sponsor" name="event_sponsor">
                            </div>

                            <div class="form-group">
                                <label for="event_title">Event title:</label>
                                <input type="text" class="form-control" id="event_title" name="event_title">
                            </div>

                            <div class="form-group">
                                <label for="event_start_date">Event start date:</label>
                                <input type="date" class="form-control" id="event_start_date" name="event_start_date">
                            </div>

                            <div class="form-group">
                                <label for="event_duration">Event duration:</label>
                                <input type="text" class="form-control" id="event_duration" name="event_duration">
                            </div>

                            <div class="form-group">
                                <label for="event_summary_type">Summary of event/campaign type:</label>

                                <p><small id="Summary" class="form-text text-muted"> Please briefly describe what your event/campaign is all about. (commercial ad, competition, seminar, donation…etc)</small></p>
                                <textarea class="form-control" id="event_summary_type" aria-describedby="Summary" name="event_summary_type"> </textarea>
                            </div>

                            <div class="form-group">
                                <label for="event_audience_target">Target audience:</label>

                                <p><small id="Summary" class="form-text text-muted">Please describe which demographic you mainly want to attract (e.g. Qatari youth, All school children, Qatari residents in Al-Khor…etc)</small></p>
                                <textarea class="form-control" id="event_audience_target" aria-describedby="Summary" name="event_audience_target"> </textarea>
                            </div>

                            <div class="form-group">
                                <label for="event_website">URL/website address:</label>
                                <input type="url" class="form-control" id="event_website" name="event_website">
                            </div>

                            <div class="form-group">
                                <label for="event_related_report">Any event/campaign related report available</label>

                                <input type="hidden" name="event_related_report">

                                <input type="radio" name="yes" value="1">Yes<br>

                                <input type="radio" name="no" value="0">No<br>

                                <div class="form-group report_available callback">

                                    <div class="form-group">
                                        <label for="event_report_author"> Report Author:</label>
                                        <input type="text" class="form-control" id="event_report_author" name="event_report_author">
                                    </div>

                                    <div class="form-group">
                                        <label for="event_report_organization">Organization:</label>
                                        <input type="text" class="form-control" id="event_report_organization" name="event_report_organization">
                                    </div>

                                    <div class="form-group">
                                        <label for="event_report_title">Title of Report</label>
                                        <input type="text" class="form-control" id="event_report_title" name="event_report_title">
                                    </div>

                                    <div class="form-group">
                                        <label for="event_report_abstract">Report Abstract</label>
                                        <input type="text" class="form-control" id="event_report_abstract" name="event_report_abstract">
                                    </div>

                                </div>
                            </div>

                             <div class="form-group">
                                        <label for="event_keywords">Keywords</label>
                                        <textarea class="form-control" id="event_keywords" name="event_keywords"> </textarea>
                             </div>

                        </div>

                        <div class="form-group training callback">

                            <div class="form-group">
                                <label for="training_organizer">Training organizer: </label>

                                <input type="text" class="form-control" id="training_organizer" name="training_organizer">
                            </div>

                            <div class="form-group">
                                <label for="training_title">Training title:</label>
                                <input type="text" class="form-control" id="training_title" name="training_title">
                            </div>

                            <div class="form-group">
                                <label for="training_provider">Training Provider:</label>
                                <input type="text" class="form-control" id="training_provider" name="training_provider">
                            </div>

                            <div class="form-group">
                                <label for="date_ass">Date Issued:</label>

                                <input type="date" class="form-control" id="date_ass" name="training_issued_date">
                            </div>

                            <div class="form-group">
                                <label for="Title">Registration fee:</label>
                                <small id="fee" class="form-text text-muted"> 1. Free   2. Amount in QR</small>
                                <input type="text" class="form-control" id="Title" name="training_fee">
                            </div>

                            <div class="form-group">
                                <label for="Abstract">Attendance type: </label>

                                <small id="fee" class="form-text text-muted"> 1. By invitation only 2. Open to public</small>

                                <select class="form-control" name="training_type">
                                      <option value="">.....</option>
                                      <option value="public"> 1. By invitation only </option>
                                      <option value="invitation">2. Open to public</option>
                                 </select>
                            </div>

                            <div class="form-group">
                                <label for="training_duration">Duration:</label>
                                <input type="text" class="form-control" id="training_duration" name="training_duration">
                            </div>

                            <div class="form-group">
                                <label for="training_website">URL/website address:</label>
                                <input type="url" class="form-control" id="training_website" name="training_website">
                            </div>

                            <div class="form-group">
                                <label for="training_description">Training description:</label>
                                <textarea class="form-control" id="training_description" name="training_description"> </textarea>
                            </div>

                            <div class="form-group">
                                <label for="training_keywords">Keywords:</label>
                                <textarea class="form-control" id="training_keywords" name="training_keywords"> </textarea>
                            </div>

                        </div>

                        <div class="form-group reports callback">

                            <div class="form-group">
                                <label for="organization">Submitting Organization Name:</label>

                                <input type="text" class="form-control" id="organization" name="report_organization">
                            </div>

                            <div class="form-group">
                                <label for="report_title">Title of Report:</label>
                                <input type="text" class="form-control" id="report_title" name="report_title">
                            </div>

                            <div class="form-group">
                                <label for="yearofrelease">Year of release:</label>
                                <input type="date" class="form-control" id="yearofrelease" name="yearofrelease">
                            </div>

                            <div class="form-group">
                                <label for="report_authors">Report authors</label>
                                <textarea name="report_authors" id="report_authors" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Abstract">Report Abstract/Summary:</label>
                               
                                <textarea name="report_abstract" id="report_abstract" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="event_related_report">Is the report linked to a Qatar National Action Plan: </label>

                                <input type="radio" name="yes" value="1">Yes<br>

                                <input type="radio" name="no" value="0">No<br>

                                <div class="form-group report_available callback">


                                    <div class="form-group">
                                        <label for="stateplan"> state the Action Plan number: </label>
                                        <input type="text" class="form-control" id="stateplan" name="stateplan" placeholder="(…e.g. 1.1, 3.12…etc)">
                                    </div>

                                    <div class="form-group">
                                        <label for="yearterm">Year term:</label>
                                        <input type="text" class="form-control" id="yearterm" name="yearterm" placeholder="(2013 – 2017, 2018 – 2022…etc)">
                                    </div>


                                </div>
                            </div>


                            <div class="form-group">
                                <label for="report_keywords">Keywords:</label>
                                <textarea class="form-control" id="report_keywords" name="report_keywords"> </textarea>
                            </div>


                        </div>
                        
                        <div class="form-group">
                                <label for="report_report">Cover Image:</label>
                                <input type="file" class="form-control" id="uploadDoc" name="image_cover" accept=".jpg,.jpeg,.png"/>
                                <span class="allow-ext"> <strong> Cover Image Must be: </strong> ( 800px * 600px ) </span>
                        </div>
                        
                        <div class="form-group">
                                <label for="report_report">Upload document related to the report:</label>
                                <input type="file" class="form-control" id="uploadDoc" name="uploadDoc[]" multiple accept=".gif,.jpg,.jpeg,.png,.doc,.docx"/>
                                
                            <span class="allow-ext"> <strong> Files Allowed :</strong> ( jpeg , png , bmp , tiff , pdf, jpg, zip, rar) </span>

                        </div>

                        <button type="submit" name="report" class="btn btn-primary">Submit</button>

                    </form>
                </div>


            </div>
        </div>
    </div>

@else
	@php
    wp_redirect(url('my-account'));
	exit;
    @endphp
@endif


<?php get_footer();?>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('select[name="type"]').on('change', function() {

            if ($(this).val() == "journal") {
                $('.event').hide();
                $('.training').hide();
                $('.reports').hide();
                $('.journal').show();
            }

            if ($(this).val() == "event") {
                $('.journal').hide();
                $('.training').hide();
                $('.reports').hide();
                $('.event').show();
            }

            if ($(this).val() == "training") {
                $('.event').hide();
                $('.journal').hide();
                $('.reports').hide();
                $('.training').show();
            }

            if ($(this).val() == "reports") {
                $('.event').hide();
                $('.journal').hide();
                $('.training').hide();
                $('.reports').show();
            }

        });

        $('input[name="yes"]').on('click', function() {
            $(this).prop('checked', true);
            $('input[name="no"]').prop('checked', false);
            $('input[name="event_related_report"]').val(1);
            $('.report_available').show();
        });

        $('input[name="no"]').on('click', function() {
            $(this).prop('checked', true);
            $('input[name="yes"]').prop('checked', false);
            $('input[name="event_related_report"]').val(0);
            $('.report_available').hide();
        });


    });
</script>
