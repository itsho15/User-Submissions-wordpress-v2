<?php
get_header();
?>
<div class="submission-table">
<h3>My Submissions</h3>

@include('admin.messages')

<a href="{{ url('upload/yourresearch') }}">Create New Submission</a>

	<input type="text" id="myInput" onkeyup="filterFunc()" placeholder="filter by type" title="Type in a type">

		<table id="myTable">

		  <tr class="header">
		    <th>id</th>
		    <th>type</th>
		    <th>files</th>
		    <th>status</th>
		    <th>actions</th>
		  </tr>


@foreach ($UserSubmissions as $submission)
	@php
	$UserDocuments = \App\Models\Documents::where('submission_id', $submission->id)->get();

	$documents = "";

	$actions = '<button type="button" class="btn btn-primary Edit_sub" data-toggle="modal" data-target="edit_' . $submission->id . '"><i class="fa fa-edit"></i>Edit</button>
	<button type="button" class="btn btn-danger del_sub" data-toggle="modal" data-target="del_' . $submission->id . '"><i class="fa fa-trash"></i>Delete</button>
			';
	@endphp

	@foreach ($UserDocuments as $doc)

		@php
		$filterdName = pathinfo($doc->name); //file name without extension

		$documents .= "<li> <a href='{$doc->name}'> {$filterdName['filename']}.{$filterdName['extension']}</a> </li>";
		@endphp
	@endforeach

	@if ($submission->Approval === NULL)
		@php $checkApproval = "Waiting Approvel From Admin"; @endphp
	@elseif ($submission->Approval === 0)
		@php $checkApproval = "rejected From admin , reason: $submission->reason_approve "; @endphp
	@elseif ($submission->Approval === 1)
		@php $checkApproval = "Submission Approved From Admin"; @endphp
	@endif


    @php
	echo "<tr>";
	echo "<td>{$submission->id}</td>";
	echo "<td>{$submission->type}</td>";
	echo "<td> Submissions files <ul> {$documents} </ul> </td>";
	echo "<td>{$checkApproval}</td>";
	echo "<td>{$actions}</td>";
	echo "</tr>";
	@endphp

	@include('front.Submssions.editsub')
@endforeach

 

</table>
  <div class="tablenav bottom alignleft">
    {!! $UserSubmissions->links('pagination.bootstrap-4') !!}
</div>

<form  id="deletedoc" method="post" action="{{ esc_url(url("document/destroy/") ) }}" >
<input type="hidden" name="docId" />
</form>

</div>


<?php get_footer();?>