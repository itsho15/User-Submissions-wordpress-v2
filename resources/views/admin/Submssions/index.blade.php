@extends('admin.layouts.default')

@section('heading')
    <h1>All {{ $type }}</h1>

@endsection

@section('content')
@include('admin.messages')
<form action="<?php echo esc_url(admin_url("submmtion/destroy/all")); ?>" method="post" id="formdata" >
    <input type="hidden" id="idsDel" name="items" value="">
    <input type="hidden" name="_token" value="{{ wpLumen()->csrf() }}"/>
</form>
<table id="table_id" class="display">
    <thead>
        <tr>
            <th scope="col"><input type="checkbox" id="checkAll"/></th>

             @if($type == 'event')

                <th scope="col">organizer</th>
                <th scope="col">start date</th>
                <th scope="col">duration</th>

            @elseif($type == 'journal')

                <th scope="col">author</th>
                <th scope="col">organization</th>
                <th scope="col">issued_date</th>

            @elseif($type == 'training')

                <th scope="col">organizer</th>
                <th scope="col">title</th>
                <th scope="col">provider</th>
                <th scope="col">fee</th>

            @elseif($type == 'reports')

                <th scope="col">organization</th>
                <th scope="col">title</th>
                <th scope="col">author</th>
                <th scope="col">year of release</th>

            @endif
             <th scope="col">Submmtion by</th>
             <th scope="col">Approved or rejected by</th>
             <th scope="col">status</th>
             <th scope="col">Edit</th>
             <th scope="col">Approve</th>
             <th scope="col">Delete</th>
        </tr>
    </thead>

    <tbody>

        @foreach($submissions as $submission)
            <tr>
                <td><input type="checkbox" name="item[]" class="item_checkbox" value="{{ $submission->id  }}" /></td>

                @if($type == 'event')
                    <td> {{ $submission->event_organizer }}</td>

                    <td> {{ $submission->event_start_date }} </td>
                    <td> {{ $submission->event_duration }} </td>

                @elseif($type == 'journal')
                    <td> {{ $submission->journal_author }}</td>
                    <td> {{ $submission->journal_organization }} </td>
                    <td> {{ $submission->journal_issued_date }} </td>

                @elseif($type == 'training')

                    <td> {{ $submission->training_organizer }}</td>
                    <td> {{ $submission->training_title }} </td>
                    <td> {{ $submission->training_provider }} </td>
                    <td> {{ $submission->training_fee }} </td>


                @elseif($type == 'reports')
                    <td> {{ $submission->report_organization }} </td>
                    <td> {{ $submission->report_title }} </td>
                    <td> {{ $submission->report_author }}</td>
                    <td> {{ $submission->yearofrelease }} </td>

                @endif
                @php
                    $author_obj = get_user_by('id', $submission->approved_by);
                @endphp
                <td> <a href="{{ get_edit_user_link( $submission->user->ID )   }} "> {{ $submission->user->user_nicename }} </a></td>
                @if($submission->approved_by !=null)
                <td> <a href="{{ get_edit_user_link( $submission->approved_by )   }} "> {{  $author_obj->user_nicename }} </a></td>
                @else
                    <td> no Data</td>
                @endif
                <td>

                    @if ($submission->Approval === NULL)

                      <p style="color: #fff;background: orange;padding: 10px; border-radius: 10%;text-align: center;font-weight: bold;">pending</p>
                     @elseif ($submission->Approval === 0)
                     <p style="color:#fff;background: red;padding: 10px; border-radius: 10%;text-align: center;font-weight: bold;">disaproved</p>
                    @elseif ($submission->Approval === 1)
                    <p style="color:#fff;background: green;padding: 10px; border-radius: 10%;text-align: center;font-weight: bold;">approved</p>
                    
                     @elseif ($submission->Approval === 2)
                    <p style="color:#fff;background: red;padding: 10px; border-radius: 10%;text-align: center;font-weight: bold;">appended</p>

                   

                    @endif
                </td>

            <td><button type="button" class="btn btn-primary Edit_data" data-toggle="modal" data-target="edit_{{ $submission->id }}">Review</button>
            </td>
            <td><button type="button" class="btn btn-primary approve_data" data-toggle="modal" data-target="approve_{{ $submission->id }}">approve/disapproved</button>
            </td>

            <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_admin{{ $submission->id }}">delete</button></td>


            </tr>
            @include('admin.modalEdit')

    @endforeach

    </tbody>

<form  id="deletedoc" method="post" action="{{ esc_url(admin_url("document/destroy/") ) }}" >
<input type="hidden" name="docId" />
</form>

</table>


    <!-- multi delete -->
<div id="mutlipleDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <div class="modal-body">

        <div class="alert alert-danger">
            <div class="empty_record hidden">
            <h4>Please Check Some Records to Delete Them </h4>
            </div>
            <div class="not_empty_record hidden">
            <h4>are you sure you want to delete submssion with id <span class="record_count"></span> ? </h4>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="empty_record hidden">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
        <div class="not_empty_record hidden">
        <button type="button" class="btn btn-default" data-dismiss="modal">no</button>
        <input type="submit"  value="yes"  class="btn btn-danger del_all" onclick="jQuery('#form_data').submit();" />
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

jQuery(document).ready(function($) {

    $('#table_id').DataTable({
            'dom': 'Blfrtip',
            'buttons'  : [
                { extend: 'print', className: 'button print' },
                { extend: 'csv', className: 'button csv' },
                { extend: 'excel', className: 'button excel' },
                { extend: 'pdf', className: 'button pdf' },
                { extend: 'copy', className: 'button copy' },
                {'text' : '<span class="dashicons dashicons-no"></span> ', 'className' : 'button delete delBtn',},
            ],
            "processing": true,
            "responsive": true
    });



});

</script>
@endsection