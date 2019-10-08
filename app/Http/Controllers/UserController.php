<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Bus;
use App\User;
use Illuminate\Http\Request;
use PDF;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    /**
     * @var \App\User
     */
    private $user;
    /**
     * @var Bus
     */
    private $bus;
    /**
     * @var Bus
     */
    private $booking;

    /**
     * Create a new controller instance.
     *
     * @param \App\User $user
     * @param Bus $bus
     */

    public function __construct(User $user, Bus $bus , Booking $booking)
    {
        $this->middleware('auth');

        $this->user = $user;
        $this->bus = $bus;
        $this->booking = $booking;
    }

    public function index()
    {
        return view('user.welcome-content');
    }


    public function showBusList()
    {
        $bus_info = $this->bus->all();

        return view('user.user-bus-list')->with('bus_info',$bus_info);
    }

    public function getAvailableSeat($id)
    {
        $bus_info = $this->bus->where('id', $id)->get();
        $total_seat = $bus_info[0]->total_seat;
        $booked_seat =$this->booking->where('bus_id', $id)->count();
        $final =  $total_seat - $booked_seat;
        return view('user.user-bus-list')->with('final',$final);
    }

    public function showBusSeatDetail($id)
    {
        $bus_info = $this->bus->find($id);
        $booking_info = $this->booking->where('bus_id', $id)->where('status',1)->get();


        return view('user.booking-form')
            ->with('bus_info',   $bus_info)
            ->with('busy_seats', $booking_info->pluck('seat_no'));
    }

    public function bookingNow(Request $request)
    {

        if ($this->booking->status === 1) {
            session()->flash('msg', 'this seat already reserved');
        } else {

            $request->validate([
                'seat' => "required|array",
            ]);

            $records = [];
            $bus_id = $request->get('bus_id');
            $user_id = auth()->id();

            foreach ($request->get('seat', []) as $row){
                $records[] = [
                    'bus_id' => $bus_id,
                    'seat_no' => $row,
                    'user_id' => $user_id,
                    'status' => 1,
                    'confirm_at' => \Carbon\Carbon::now()
                ];
            }

            if(count($records)){
                $this->booking->insert($records);
                return Redirect()->route('booking-form', [$bus_id])->with('message', ['type' => 'success', 'text' => 'you booked successfully']);
            }
            else {
                session()->flash('msg', 'please select seat');
                return Redirect()->back();
            }
        }
    }

    public function booking_validation($request)
    {
        $rules = [
            'seat_no' => 'required|numeric'
        ];

        return $this->validate($request, $rules);
    }

    public function addBus(Request $request)
    {
        $this->bus_validation($request);
        $bus_name 	= $request->get('bus_name');
        $total_seats = $request->get('total_seats');
        $bus_model = $request->get('bus_model');

        $insertionData = [
            'bus_name' 		=> $bus_name,
            'total_seats' 	=> $total_seats,
            'bus_model' 	=> $bus_model,
            'created_at' 	=> \Carbon\Carbon::now(),
            'updated_at' 	=> \Carbon\Carbon::now()
        ];
        $this->bus->insert($insertionData);

        return redirect()->route('addBus')->with('message', ['type' => 'success', 'text' => 'Bus Added Successful']);

    }

    public function bus_validation($request)
    {
        $rules = [
            'bus_name' 		=> 'required|unique:buses',
            'total_seats' 	=> 'required|numeric'
        ];

        return $this->validate($request, $rules);
    }

    public function showAddBusForm()
    {
        return view('user.user-add-bus');
    }


    public function pdfview(Request $request)
    {
        $bookings = $this->booking->whereHas('user')->whereHas('bus')->paginate(15);

        view()->share('bookings',$bookings);


        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
        }


        return view('pdfview');
    }

    public function pdfviewbus(Request $request)
    {
        $buses = $this->bus->whereHas('booking')->paginate(15);

        view()->share('buses',$buses);


        if($request->has('download')){
            $pdf = PDF::loadView('pdfviewbus');
            return $pdf->download('pdfviewbus.pdf');
        }


        return view('pdfviewbus');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $bus = $this->bus->find($id);

        return view('user.user-edit-bus')->with('bus', $bus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $bus = $this->bus->find($id);

        if (!empty($bus)) {

            $request->validate([
                'bus_name' 		=> 'required',
                'total_seats' 	=> 'required|numeric'            ]);

            $bus->update($request->all());

            $redirect = Redirect()->route('show-bus-list');

            return $redirect->with('message', ['type' => 'success', 'text' => 'Successfully Updated']);
        }
    }

    public function destroy($id)
    {
        $bus = $this->bus->find($id);

        if (!empty($bus)) {
            $bus->delete();
            return redirect()->route('show-bus-list')->with('message', ['type' => 'success', 'text' => 'Successfully Removed']);
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExportView()
    {
        return view('import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new UsersImport,request()->file('file'));

        return back();
    }

}
