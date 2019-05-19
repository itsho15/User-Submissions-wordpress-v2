<!-- Model Edit -->
<div id="edit_{{ $submission->id }}" class="modal fade " role="dialog">

    <div class="modal-dialog modal-lg">
        <form  method="POST" id="updatesub_{{ $submission->type  }}" action="<?php echo esc_url(url("submmtion/update") . '/' . $submission->id); ?>" enctype="multipart/form-data">

    <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $submission->type }} </h4>
            </div>

            <div class="modal-body">

                <div class="form-group">
                                <label for="report_report">Cover Image:</label>
                                <input type="file" class="form-control" id="uploadDoc" name="image_cover" accept=".jpg,.jpeg,.png"/>
                                
                   @if($submission->image_cover)
                    <img src="{{ $submission->image_cover}}" alt="event image" class="img-responsive" style="margin: 15px 0 0 0;">
                    @else
                     <img src="{{ plugin_dir_url( __DIR__ ) . 'images/default.jpg'}}" alt="event image" class="img-responsive" style="margin: 15px 0 0 0;">
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="uploadDoc">Add New document if you need And Save Changes </label>
                    <input type="file" class="form-control" id="uploadDoc" name="uploadDoc[]"  multiple />
                    <ul class="list-group">


                        <h3>The Documents Of This Event</h3>


                        @php
                         //wp_nonce_field(plugin_basename(__FILE__), 'event_report_abstract');

                        // this will get the data from documents table refreances with submission_id

                        $documents = \App\Models\Documents::where('submission_id', $submission->id)->get();

                        @endphp

                            @foreach ($documents as $key => $doc)
                            @php
                                 $filterdName = pathinfo($doc->name);
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a  target="_blank" href='{{ $doc->name }}'>{{ $filterdName['filename'].'.'.$filterdName['extension'] }}</a>

                            <span class="pull-right badge-primary badge-pill">
                                <button type="submit" class="bk-danger delDoc" data-id="{{ $doc->id }}"> <span class="dashicons dashicons-trash"></span></button>
                            </span>
                            </li>
                            @endforeach



                    </ul>
                </div>

                @if($submission->type == 'event')

                    <div class="form-group">
                        <label for="event_organizer">Event organizer </label>

                        <input type="text" class="form-control" id="event_organizer"  name="event_organizer" value="{{ $submission->event_organizer }}">
                    </div>

                    <div class="form-group">
                        <label for="event_sponsor">Event sponsor:</label>
                        <input type="text" class="form-control" id="event_sponsor"  name="event_sponsor" value="{{ $submission->event_sponsor }}">
                    </div>

                    <div class="form-group">
                        <label for="event_title">Event title</label>
                        <input type="text" class="form-control" id="event_title"  name="event_title" value="{{ $submission->event_title }}">
                    </div>

                    <div class="form-group">
                        <label for="event_start_date">Event start date</label>
                        <input type="date" class="form-control" id="event_start_date"  name="event_start_date" value="{{ $submission->event_start_date }}">
                    </div>

                    <div class="form-group">
                        <label for="event_duration">Event duration</label>
                        <input type="text" class="form-control" id="event_duration"  name="event_duration" value="{{ $submission->event_duration }}">
                    </div>

                    <div class="form-group">
                        <label for="event_summary_type">Summary of event/campaign type</label>

                        <small id="Summary" class="form-text text-muted"> Please briefly describe what your event/campaign is all about. (commercial ad, competition, seminar, donation…etc)</small>
                        <textarea class="form-control" id="event_summary_type" aria-describedby="Summary" name="event_summary_type"> {{ $submission->event_summary_type }} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="event_audience_target">Target audience</label>

                        <small id="Summary" class="form-text text-muted">Please describe which demographic you mainly want to attract (e.g. Qatari youth, All school children, Qatari residents in Al-Khor…etc)</small>
                        <textarea class="form-control" id="event_audience_target" aria-describedby="Summary" name="event_audience_target"> {{ $submission->event_audience_target }} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="event_website">URL/website address</label>
                        <input type="url" class="form-control" id="event_website"  name="event_website" value="{{ $submission->event_website }}">
                    </div>

                    <div class="form-group">
                        <h3 for="event_related_report"> related report </h3>

                        <div class="form-group report_available ">

                            <div class="form-group">
                                <label for="event_report_author"> Report Author</label>
                                <input type="text" class="form-control" id="event_report_author"  name="event_report_author" value="{{ $submission->event_report_author }}">
                            </div>

                            <div class="form-group">
                                <label for="event_report_organization">Organization:</label>
                                <input type="text" class="form-control" id="event_report_organization"  name="event_report_organization" value="{{ $submission->event_report_organization }}">
                            </div>

                            <div class="form-group">
                                <label for="event_report_title">Title of Report</label>
                                <input type="text" class="form-control" id="event_report_title"  name="event_report_title" value="{{ $submission->event_report_title }}">
                            </div>

                            <div class="form-group">
                                <label for="event_keywords">Keywords</label>
                                <textarea class="form-control" id="event_keywords" name="event_keywords">{{ $submission->event_keywords }}</textarea>
                            </div>


                        </div>
                    </div>
                    <input type="submit" class="btn btn-warning updateSub" value="Save Changes" data-act="event">

                @elseif($submission->type == 'journal')

                  <div class="form-group">
                        <label for="organization">Submitting organization </label>

                        <input type="text" class="form-control" id="organization"  name="journal_organization" value="{{ $submission->journal_organization }}">
                    </div>

                    <div class="form-group">
                        <label for="Author">First Author</label>
                        <input type="text" class="form-control" id="Author"  name="journal_author" value="{{ $submission->journal_author }}">
                    </div>

                    <div class="form-group">
                        <label for="journal_authors">Other authors</label>
                        <textarea name="journal_authors" id="journal_authors"  class="form-control"> {{ $submission->journal_authors }} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="date_ass">Date Issued</label>
                        <input type="date" class="form-control" id="date_ass"  name="journal_issued_date" value="{{ $submission->journal_issued_date }}">
                    </div>

                    <div class="form-group">
                        <label for="Title">Title</label>
                        <input type="text" class="form-control" id="Title"  name="journal_title" value="{{ $submission->journal_title }}">
                    </div>

                    <div class="form-group">
                        <label for="Abstract">Abstract</label>
                        <input type="text" class="form-control" id="Abstract"  name="journal_abstract" value="{{ $submission->journal_abstract }}">
                    </div>

                    <div class="form-group">
                        <label for="Conference">Journal/Conference Name</label>
                        <input type="text" class="form-control" id="Conference"  name="journal_name" value="{{ $submission->journal_name }}">
                    </div>

                    <div class="form-group">
                        <label for="url_website">URL/website address</label>
                        <input type="url" class="form-control" id="url_website"  name="journal_website" value="{{ $submission->journal_website }}">
                    </div>

                    <div class="form-group">
                        <label for="journal_keywords">Keywords</label>
                        <textarea class="form-control" id="journal_keywords" name="journal_keywords" > {{ $submission->journal_keywords }} </textarea>
                    </div>
                    <input type="submit" class="btn btn-warning updateSub" value="Save Changes" data-act="journal">

                @elseif($submission->type == 'training')

                <div class="form-group">
                    <label for="training_organizer">Training organizer: </label>

                    <input type="text" class="form-control" id="training_organizer"  name="training_organizer" value="{{ $submission->training_organizer }}" >
                </div>

                <div class="form-group">
                    <label for="training_title">Training title:</label>
                    <input type="text" class="form-control" id="training_title"  name="training_title" value="{{ $submission->training_title }}" >
                </div>

                <div class="form-group">
                    <label for="training_provider">Training Provider:</label>
                    <input type="text" class="form-control" id="training_provider"  name="training_provider" value="{{ $submission->training_provider }}" >
                </div>

                <div class="form-group">
                    <label for="date_ass">Date Issued:</label>
                    <input type="date" class="form-control" id="date_ass"  name="training_issued_date" value="{{ $submission->training_issued_date }}" >
                </div>

                <div class="form-group">
                    <label for="Title">Registration fee:</label>
                    <small id="fee" class="form-text text-muted"> 1. Free   2. Amount in QR</small>
                    <input type="text" class="form-control" id="Title"  name="training_fee" value="{{ $submission->training_fee }}" >
                </div>

                <div class="form-group">
                    <label for="Abstract">Attendance type: </label>

                    <small id="fee" class="form-text text-muted"> 1. By invitation only 2. Open to public</small>

                    <select class="form-control" name="training_type">
                      <option value="public"  <?php if ($submission->training_type == "public") {echo "selected";}?> > 2. Open to public</option>
                      <option value="invitation" <?php if ($submission->training_type == "invitation") {echo "selected";}?> >1. By invitation only</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="training_duration">Duration:</label>
                    <input type="text" class="form-control" id="training_duration"  name="training_duration" value="{{ $submission->training_duration }}" >
                </div>

                <div class="form-group">
                    <label for="training_website">URL/website address:</label>
                    <input type="url" class="form-control" id="training_website"  name="training_website" value="{{ $submission->training_website }}" >
                </div>

                <div class="form-group">
                    <label for="training_description">Training description:</label>
                    <textarea class="form-control" id="training_description" name="training_description">{{ $submission->training_description }}</textarea>
                </div>



                <div class="form-group">
                    <label for="training_keywords">Keywords:</label>
                    <textarea class="form-control" id="training_keywords" name="training_keywords">{{ $submission->training_keywords }}</textarea>
                </div>

                <input type="submit" class="btn btn-warning updateSub" value="Save Changes" data-act="training">

                @elseif($submission->type == 'reports')

                    <div class="form-group">
                        <label for="organization">Submitting Organization Name:</label>

                        <input type="text" class="form-control" id="organization" name="report_organization" value="{{ $submission->report_organization }}">
                    </div>

                    <div class="form-group">
                        <label for="report_title">Title of Report:</label>
                        <input type="text" class="form-control" id="report_title" name="report_title" value="{{ $submission->report_title }}">
                    </div>

                    <div class="form-group">
                        <label for="yearofrelease">Year of release:</label>
                        <input type="date" class="form-control" id="yearofrelease" name="yearofrelease" value="{{ $submission->yearofrelease }}">
                    </div>

                    <div class="form-group">
                        <label for="report_authors">Report authors</label>
                        <textarea name="report_authors" id="report_authors" class="form-control">{{ $submission->report_authors }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="Abstract">Report Abstract/Summary:</label>
                        <input type="text" class="form-control" id="Abstract" name="report_abstract" value="{{ $submission->report_abstract }}">
                    </div>

                    <div class="form-group">
                        <label for="event_related_report">Is the report linked to a Qatar National Action Plan: </label>
                        @if($submission->stateplan !='' && $submission->yearterm !='')
                        <p>yes</p>
                        @else
                        <p>no</p>
                        @endif
                        <div class="form-group ">


                            <div class="form-group">
                                <label for="stateplan"> state the Action Plan number: </label>
                                <input type="text" class="form-control" id="stateplan" name="stateplan" value="{{ $submission->stateplan }}">
                            </div>

                            <div class="form-group">
                                <label for="yearterm">Year term:</label>
                                <input type="text" class="form-control" id="yearterm" name="yearterm" value="{{ $submission->yearterm }}">
                            </div>


                        </div>
                    </div>

                    <div class="form-group">
                        <label for="report_keywords">Keywords:</label>
                        <textarea class="form-control" id="report_keywords" name="report_keywords">{{ $submission->report_keywords }} </textarea>
                    </div>

                    <input type="submit" class="btn btn-warning updateSub" value="Save Changes" data-act="reports">
                @endif


            </div>
        </div>
        </form>
    </div>
</div>
 <!-- End Model Edit-->

<!-- Delete Model -->
<div id="del_<?php echo $submission->id ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are You Sure You Want Delete This Submission ?</h4>
      </div>
      <div class="modal-footer">
      	<form name="Submission_edit_update" id="submitForm" method="POST"  action="<?php echo esc_url(url("submmtion/destroy") . '/' . $submission->id); ?>">
      	<input type="hidden" name="id" value="<?php echo $submission->id; ?> ">
		  <button type="submit"  name= "del_sub" class="btn btn-danger">yes</button>
          <button type="button" class="btn btn-info" data-dismiss="modal">no</button>
        </form>
      </div>

    </div>

  </div>
</div>
