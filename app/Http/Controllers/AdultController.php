<?php

namespace App\Http\Controllers;

use App\Models\Adult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => [
                'index',
                'show'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adults = Adult::with(['account:id,balance', 'adultRole:id,name'])->paginate();
        $collection = collect([1, 2, 3]);
        //dd($adults);
        return view('adults.index')
            ->with('adults', $adults);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adult_roles = DB::table('adult_roles')->get()->pluck('name', 'id')->prepend('Select adult role');
        return view('adults.create')
            ->with('adult_roles', $adult_roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('adult_role_id') == 1){
            $account_id = DB::table('accounts')->insertGetID([
                'balance' => 0
            ]);

            $adult_id = DB::table('adults')->insertGetId([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email', false),
                'address' => $request->input('address', false),
                'adult_role_id' => $request->input('adult_role_id'),
                'account_id' => $account_id
            ]);

            $adult = Adult::where('id', $adult_id)->first();

        }else{
            $adult = Adult::create($request->input());
        }

        $groups = DB::table('groups')->get()->pluck('name', 'id')->prepend('Select a group');

        // Using facades
        /*$id = DB::table('bookings')->insertGetID([
            'room_id' => $request->input('room_id'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'is_reservation' => $request->input('is_reservation', false),
            'is_paid' => $request->input('is_paid', false),
            'notes' => $request->input('notes')
        ]);*/

        // Storing relationship
        //$booking->users()->attach($request->input('user_id'));

        /*DB::table('bookings_users')->insert([
            // with Facades
            //'booking_id' => $id,

            //with Model
            'booking_id' => $booking->id,
            'user_id' => $request->input('user_id')
        ]);*/
        return view('children.create')
            ->with('adult', $adult)
            ->with('groups', $groups);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adult  $adult
     * @return \Illuminate\Http\Response
     */
    public function show(Adult $adult)
    {
        return view('adults.show')
            ->with('adult', $adult);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adult  $adult
     * @return \Illuminate\Http\Response
     */
    public function edit(Adult $adult)
    {
        $adult_roles = DB::table('adult_roles')->get()->pluck('name', 'id')->prepend('Select adult role');
        $groups = DB::table('groups')->get()->pluck('name', 'id')->prepend('Select a group');
        return view('adults.edit')
            ->with('adult', $adult)
            ->with('adult_roles', $adult_roles)
            ->with('groups', $groups);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adult  $adult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adult $adult)
    {
        $adult->fill($request->input());
        $adult->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adult  $adult
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adult $adult)
    {
        //
    }
}
