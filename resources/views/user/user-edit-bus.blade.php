@extends('user.user-layout')
@section('user-add-bus')
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            @if ( count($errors) > 0 )
                                @foreach ( $errors->all() as $error )
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                            @endif

                                <form action="{{route('bus-update',$bus->id)}}" class="form-horizontal" method="post">
                                    @method('PUT')
                                    @csrf
                                <div class="col-md-12 col-lg-12">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>Bus Name:</td>
                                            <td><input type="text" name="bus_name" value="{{ old('bus_name', ($bus->bus_name ?? '')) }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Total Seat:</td>
                                            <td><input type="text" name="total_seats" value="{{ old('total_seats', ($bus->total_seats ?? '')) }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Bus Model:</td>
                                            <td><input type="text" name="bus_model" value="{{ old('bus_model', ($bus->bus_model ?? '')) }}"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="submit" name="submit" value="Update"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
            <a href="{{route('show-bus-list')}}" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
          </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection