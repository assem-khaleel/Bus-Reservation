<style type="text/css">
    table td, table th{
        border:1px solid black;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">Booking Report</h4>
                </div>
                <div class="panel-body ">
                    <div class="table-responsive">
                        <a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a>

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


            </div>
        </div>
    </div>
</div>