<?php

namespace App\Http\Controllers;

use App\Flight;
use App\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flights = Flight::orderBy('id', 'ASC')->paginate(3);

        return view('flights.index')->with('flights', $flights);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flight = new Flight;
        $flight->departure = $request->input('departure');
        $flight->arrival = $request->input('arrival');
        $flight->seats = $request->input('seats');
        $flight->price = $request->input('price');
        $flight->save();

        return redirect('/flights')->with('success', 'Flight Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // lazy loading
        $flight = Flight::findOrFail($id);
        $flight->load(['tourist' => function($q) {
            $q->orderBy('surname', 'asc');
        }]);

        /* eager loading
        $flight = Flight::with(['tourist' => function($q) {
            $q->orderBy('surname', 'asc');
        }])->findOrFail($id);
        */

        return view('flights.show')->with('flight', $flight);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flight = Flight::find($id);

        $booked = [];
        foreach ($flight->tourist as $t) {
            $booked[] = $t->id;
        }

        $tourists = DB::table('tourists')->whereNotIn('id', $booked)->orderBy('surname', 'ASC')->get();

        return view('flights.book')->with('tourists', $tourists)->with('flight', $flight);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $flight = Flight::find($id);

        $flight->tourist()->attach($request->input('tourist_id'));

        return redirect()->action('FlightsController@show', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelBooking(Request $request, $id)
    {
        $flight = Flight::find($id);
        $flight->tourist()->detach($request->input('tourist_id'));

        return redirect()->action('FlightsController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = Flight::find($id);

        $flight->tourist()->detach();
        $flight->delete();

//        flash('Component detached', 'Success');

        return redirect('flights')->with('success', 'Flight Removed');
    }
}
