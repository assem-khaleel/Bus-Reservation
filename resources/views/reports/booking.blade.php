@extends('user.user-layout')
@section('report-booking')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-3 align-self-center pull-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('show-bus-list')}}">Home</a></li>
                <li class="breadcrumb-item"><a
                            href="{{route('report.booking')}}">Booking Report</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Booking Report</h4>
                    </div>
                    <div class="panel-body ">
                        <div class="table-responsive">
                            <a href="{{ URL::to('pdfview') }}">Export PDF</a>

                            <table class="table table-user-information">
                                <thead>
                                <tr>
                                    <th style="text-align: center">User name</th>
                                    <th style="text-align: center">User gender</th>
                                    <th style="text-align: center">Bus name</th>
                                    <th style="text-align: center">Seat #</th>
                                    <th style="text-align: center">Booking date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td style="text-align: center">{{$booking->user->name}}</td>
                                        <td style="text-align: center">{{$booking->user->gender ==0?"male":"female"}}</td>
                                        <td style="text-align: center">{{$booking->bus->bus_name}}</td>
                                        <td style="text-align: center">{{$booking->seat_no}}</td>
                                        <td style="text-align: center">{{$booking->confirm_at}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {{$bookings->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
