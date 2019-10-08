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
                            href="{{route('report.bus')}}">Bus Report</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Bus Report</h4>
                    </div>
                    <div class="panel-body ">
                        <div class="table-responsive">
                            <a href="{{ URL::to('pdfviewbus') }}">Export PDF</a>

                            <table class="table table-user-information">
                                <thead>
                                <tr>
                                    <th style="text-align: center">Bus name</th>
                                    <th style="text-align: center">Total seatas</th>
                                    <th style="text-align: center">Bus model</th>
                                    {{--<th style="text-align: center">Booked seats</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($buses as $bus)

                                    <tr>
                                        <td style="text-align: center">{{$bus->bus_name}}</td>
                                        <td style="text-align: center">{{$bus->total_seats}}</td>
                                        <td style="text-align: center">{{$bus->bus_model}}</td>

                                        {{--@foreach($bus->booking as $booking)--}}

                                     {{--@php      dd($booking->seat_no)@endphp--}}
                                            {{--<td style="text-align: center">{{count($boked_seats)}}</td>--}}

                                        {{--@endforeach--}}

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {{$buses->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
