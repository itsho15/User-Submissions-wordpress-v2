@extends('admin.layouts.default')
@section('heading')
<h1>Export / Import</h1>
@endsection
@section('content')
@if(isset($_GET['success']))

    @php
    $class = 'updated notice-info';
    $message = __( $_GET['success']);

    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    @endphp
@endif

@if(isset($_GET['error']))

    @php
    $class = 'updated notice-warning';
    $message = __( $_GET['error']);

    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    @endphp
@endif

<div id="col-container">

        <div id="col-right">

            <div class="col-wrap">
                <h3>{{ esc_attr_e( 'Export/import Submittions', 'wp_admin_style' )}}</h3>
                <div class="inside">
                    <form enctype="multipart/form-data" method="POST" action="{{ esc_url(admin_url("exportsub") ) }}">

                        <div class="form-group">
                        <button type="submit" id="Export" name="exportSub" class="btn btn-warning ">Export Submittions</button>
                        </div>
                    </form>

                     <form enctype="multipart/form-data" method="POST" action="{{ esc_url(admin_url("importsub") ) }}">
                        <div class="form-group">
                            <label for="Import">Import Submittions</label>
                            <input type="file" class="form-control" id="Import" name="ImportFileSub"  />
                        </div>
                        <button type="submit" name="importSub" class="btn btn-primary ">Import</button>
                    </form>

                </div>

            </div>
            <!-- /col-wrap -->

        </div>
        <!-- /col-right -->

        <div id="col-left">

            <div class="col-wrap">
                <h3>{{ esc_attr_e( 'Export/import Documents', 'wp_admin_style' )}}</h3>
                <div class="inside">
                    <form enctype="multipart/form-data" method="POST" action="{{ esc_url(admin_url("exportdoc") ) }}">

                    <div class="form-group">
                    <button type="submit" id="Exportdoc" name="exportDoc" class="btn btn-info btn-small ">Export Documents</button>
                    </div>
                </form>

                <form enctype="multipart/form-data" method="POST" action="{{ esc_url(admin_url("importdoc") ) }}">
                   <div class="form-group">
                        <label for="Import">Import Documents</label>
                        <input type="file" class="form-control" id="Import" name="ImportFileDoc"  />
                    </div>
                    <button type="submit" name="importDoc" class="btn btn-primary ">Import </button>
                </form>
                </div>
            </div>
            <!-- /col-wrap -->

        </div>
        <!-- /col-left -->

    </div>
    <!-- /col-container -->

@endsection