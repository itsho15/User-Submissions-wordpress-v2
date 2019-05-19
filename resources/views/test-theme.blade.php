{{--Customize your layout to match your theme.--}}
@php
get_header();
@endphp

<div class="container">
	<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-body">

            {!! Form::open(['url'=>url('times')]) !!}
            <input type="hidden" name="_token" value="{{ wpLumen()->csrf() }}"/>

            <div class="row">

                <div class="col-md-6">
                    <label class="m-t-40">Start</label>
                    <input  name="start" id="from" value="{{ $helper->request()->old('start')  }}" type="date" class="form-control" placeholder="Saturday 24 June 2017 - 21:44">
                </div>

                <div class="col-md-6">
                    <label class="m-t-40">end time</label>
                    <input class="form-control" name ="end" value="{{ $helper->request()->old('end') }}" type="date" placeholder="Check time">
                </div>


                <div class="col-md-12">
                  <div class="form-group">
                    {!! Form::label('note',trans('admin.note')) !!}
                    {!! Form::textarea('note',$helper->request()->old('note'),['class'=>'form-control']) !!}
                  </div>

                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    {!! Form::label('classname',trans('admin.chooseColorForTime')) !!}
                    <select class="form-control" name="classname">
                      <option value="bg-primary" class="bg-primary" selected> {{ trans('admin.primary') }} </option>
                      <option value="bg-success" class="bg-success"> {{ trans('admin.success') }} </option>
                      <option value="bg-danger" class="bg-danger">  {{ trans('admin.danger') }} </option>
                      <option value="bg-warning" class="bg-warning"> {{ trans('admin.warning') }} </option>
                      <option value="bg-info" class="bg-info">  {{ trans('admin.info') }} </option>
                      <option value="bg-dark" class="bg-dark">  {{ trans('admin.dark') }} </option>
                    </select>
                  </div>

                </div>
            </div>



             {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}

          </div>
      </div>

  </div>
</div>
</div>

@php
get_footer();
@endphp

