@extends('user.user-layout')

@section('section')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-3 align-self-center pull-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('show-bus-list')}}">Home</a></li>
                <li class="breadcrumb-item"><a
                            href="{{route('profiles.myProfile')}}">User Profile</a>
                </li>
            </ol>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Page Body  -->
    <!-- ============================================================== -->
    <div class="row ">
        <div class="col-md-5 toppad  col-md-offset-3">
            <h3 >Profile</h3>
            <h3><a href="{{url('importExportView')}}">Export or Import</a></h3>


        </div>

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
                <div class="panel panel-info">
                    <div class="panel-heading">

                    <center class="m-t-30"><img class="img-circle" width="150" src="@if(!empty($user->image->path)){{asset('storage/'.$user->image->path)}}">@else {{asset('images/avatar.png')}}">@endif
                            <h4 class="panel-title">{{Auth::user()->name }}</h4>
                        </center>
                        </div>

                    <div>
                        <hr>
                    </div>
                    <div class="panel-body">


                        <table class="table table-user-information">
                            <form class="form-horizontal form-material"
                                  action="{{route('profiles.update',Auth::user()->id )}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-6">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" value="{{Auth::user()->name }}"
                                                name="name" required>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-6">Email</label>
                                    <div class="col-md-6">
                                        <input type="email" value="{{Auth::user()->email }}"
                                               name="email" required>
                                    </div>
                                </div>
                                <br>
                                @if(count( $errors->get('image') ) > 0)
                                    @foreach ($errors->get('image') as $error)
                                        <div class="pull-right"><code> {{ $error}} </code></div>
                                    @endforeach
                                @endif
                                <div class="form-group">
                                    <label class="col-md-6">Image Upload</label>
                                    <div class="col-md-6 " >
                                        <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select Image</span> <span class="fileinput-exists">Change Image</span>
                                            <input class="upload" type="file" name="image"> </span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow=""
                                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                0%
                                            </div>
                                        </div>
                                        <br />
                                        <div id="success">

                                        </div>
                                        <br />
                                    </div>
                                </div>
                                <br>
                                @if(count( $errors->get('passport') ) > 0)
                                    @foreach ($errors->get('passport') as $error)
                                        <div class="pull-right"><code> {{ $error}} </code></div>
                                    @endforeach
                                @endif
                                <div class="form-group">
                                    <label class="col-md-6">Passport Upload</label>
                                    <div class="col-md-6">
                                        <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select Passport</span> <span class="fileinput-exists">Change Passport Image</span>
                                            <input class="upload {{ $errors->has('passport') ? ' is-invalid' : '' }}" type="file" name="passport"> </span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow=""
                                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                0%
                                            </div>
                                        </div>
                                        <br />
                                        <div id="success">

                                        </div>
                                        <br />

                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-linkedin">Update Profile</button>
                                    </div>
                                </div>
                            </form>

                        </table>
                    </div>

                </div>

            </div>

        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->

    </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>


    <script>
        $(document).ready(function(){

            $('form').ajaxForm({
                beforeSend:function(){
                    $('#success').empty();
                },
                uploadProgress:function(event, position, total, percentComplete)
                {
                    $('.progress-bar').text(percentComplete + '%');
                    $('.progress-bar').css('width', percentComplete + '%');
                },
                success:function(data)
                {
                    if(data.errors)
                    {
                        $('.progress-bar').text('0%');
                        $('.progress-bar').css('width', '0%');
                        $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
                    }
                    if(data.success)
                    {
                        $('.progress-bar').text('Uploaded');
                        $('.progress-bar').css('width', '100%');
                        $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
                        $('#success').append(data.image);
                    }
                }
            });

        });
    </script>
@endsection
