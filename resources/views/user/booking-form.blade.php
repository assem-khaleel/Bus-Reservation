@extends('user.user-layout')
@section('booking-form')

    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  toppad">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            @if ( count($errors) > 0 )
                                @foreach ( $errors->all() as $error )
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                            @endif

                            <form method="post" action="{{ route('booking-now') }}" id="seatForm">
                                {{ csrf_field() }}
                                <div class="col-md-12 col-lg-12">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <th>Bus Name:</th>
                                            <td>{{ $bus_info->bus_name }}</td>
                                        </tr>

                                        <tr>
                                            <th>Available Seat No:</th>
                                            <td>

                                                <h2> Choose seats by clicking the corresponding seat in the layout below:</h2>
                                                <div id="holder">
                                                    <ul  id="place">
                                                    </ul>
                                                </div>
                                                <div style="float:left;">
                                                    <ul id="seatDescription">
                                                        <li style="background:url('/images/Available-Seat.png') no-repeat scroll 0 0 transparent;">Available Seat</li>
                                                        <li style="background:url('/images/Booked-Seat.png') no-repeat scroll 0 0 transparent;">Booked Seat</li>
                                                        <li style="background:url('/images/Selected-Seat.png') no-repeat scroll 0 0 transparent;">Selected Seat</li>
                                                    </ul>
                                                </div>
                                                <div style="clear:both;width:100%">
                                                    <input type="button" id="btnShowNew" value="Show Selected Seats" />
                                                    <input type="button" id="btnShow" value="Show All" />
                                                </div>
                                            </td>
                                                    </tr>


                                        <input type="hidden" name="bus_id" value="{{$bus_info->id}}">

                                        <td><input type="button" id="bookNow" value="Booking Now"></td>
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
    <script>
        var settings = {
            rows: 3,
            cols: {{ intval($bus_info->total_seats/3) + ($bus_info->total_seats%3? 1: 0) }},
            rowCssPrefix: 'row-',
            colCssPrefix: 'col-',
            seatWidth: 35,
            seatHeight: 35,
            seatCss: 'seat',
            selectedSeatCss: 'selectedSeat',
            selectingSeatCss: 'selectingSeat'
        };

        var init = function (reservedSeat) {
            var str = [], seatNo, className;
            for (i = 0; i < settings.rows; i++) {
                for (j = 0; j < settings.cols; j++) {
                    seatNo = (i + j * settings.rows + 1);
                    className = settings.seatCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
                    if ($.isArray(reservedSeat) && $.inArray(String(seatNo), reservedSeat) != -1) {
                        className += ' ' + settings.selectedSeatCss;
                    }
                    str.push('<li class="' + className + '"' +
                        'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px">' +
                        '<a title="' + seatNo + '">' + seatNo + '</a>' +
                        '</li>');
                }
            }
            $('#place').html(str.join(''));
        };

        //case I: Show from starting
        //init();

        //Case II: If already booked
        var bookedSeats = @json($busy_seats);
        init(bookedSeats);


        $('.' + settings.seatCss).click(function () {
            if ($(this).hasClass(settings.selectedSeatCss)){
                alert('This seat is already reserved');
            }
            else{
                $(this).toggleClass(settings.selectingSeatCss);
            }
        });

        $('#btnShow').click(function () {
            var str = [];
            $.each($('#place li.' + settings.selectedSeatCss + ' a, #place li.'+ settings.selectingSeatCss + ' a'), function (index, value) {
                str.push($(this).attr('title'));
            });
            alert(str.join(','));
        })

        $('#btnShowNew').click(function () {
            var str = [], item;
            $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
                item = $(this).attr('title');
                str.push(item);
            });
            alert(str.join(','));
        });

        $('#bookNow').click(function(){
            var $form = $('#seatForm');

            $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
                item = $(this).attr('title');
                $form.append($("<input type='hidden' name='seat[]'>").val(item));
            });

            $form.submit();
        });

    </script>

@endsection