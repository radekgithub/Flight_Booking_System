<?php

namespace App\Http\Controllers;

use App\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tourist;

class TouristsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tourists = Tourist::orderBy('surname', 'asc')->paginate(10);

        return view('tourists.index')->with('tourists', $tourists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tourists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tourist = new Tourist;
        $tourist->name = $request->input('name');
        $tourist->surname = $request->input('surname');
        $tourist->sex = $request->input('sex');
        $tourist->country = $request->input('country');
        $tourist->notes = $request->input('notes');
        $tourist->date_of_birth = $request->input('date_of_birth');
        $tourist->save();

        return redirect()->action('TouristsController@show', ['id' => $tourist->id])->with('success', 'Tourist added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tourist = Tourist::find($id);

        return view('tourists.show')->with('tourist', $tourist);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tourist = Tourist::find($id);

        $booked = [];
        foreach ($tourist->flight as $f) {
            $booked[] = $f->id;
        }

        $flights = Flight::withCount('tourist')
            ->having('seats', '>', DB::raw('tourist_count'))
            ->get();

        return view('tourists.book')
            ->with('tourist', $tourist)
            ->with('booked', $booked)
            ->with('flights', $flights);
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
        $tourist = Tourist::find($id);
        $tourist->flight()->attach($request->input('flight_id'));

        return redirect()->action('TouristsController@show', ['id' => $id])->with('success', 'Flight booked');
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
        $tourist = Tourist::find($id);
        $tourist->flight()->detach($request->input('flight_id'));

        return redirect()->action('TouristsController@show', ['id' => $id])->with('success', 'Booking cancelled');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tourist = Tourist::find($id);
        $tourist->flight()->detach();
        $tourist->delete();

        return redirect('tourists')->with('success', 'Tourist Removed');
    }
}
