@extends('user.user-layout')
@section('section')


    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-2 align-self-center pull-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('show-bus-list')}}">Home</a></li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-md-6 toppad pull-right">
                <p class="text-info">Today is: {{ date('d-m-Y', time()) }}</p>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10  ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bus List</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12 col-lg-12">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <th>Bus ID</th>
                                        <th>Bus Name</th>
                                        <th>Bus Total Seat</th>
                                        <th style="text-align: start">Action</th>
                                    </tr>
                                    @if ( count($bus_info) > 0 )
                                        @foreach ( $bus_info as $data )
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->bus_name }}</td>
                                                <td>{{ $data->total_seats }}</td>
                                                <td>
                                                    <a  class="btn btn-primary" href="{{ url('show-bus-seat-detail') . '/' . $data->id }}">Show Seat(s)</a>
                                                    <a  class="btn btn-link" href="{{ route('bus-edit', $data->id) }}">Edit Bus</a>

                                                    <form style="display: inline-block;" method="POST"
                                                          action="{{route('bus-delete', $data->id)}}">

                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger" type="submit">Delete bus</button>

                                                    </form>


                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
            <a href="{{ route('addBus') }}" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Add Bus</a>
          </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection