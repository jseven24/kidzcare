<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $children = Child::with('group:id,name')->paginate();
        //dd($children);
        return view('children.index')
            ->with('children', $children);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->action([ChildController::class, 'index']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $child = Child::create($request->input());
        $child->picture = $request->file('picture')->store('public');

        //$child->picture = Storage::putFile('public', $request->file('picture'));
        $child->save();
        $child->adults()->attach($request->input('adult_id'));
        //return redirect()->action([ChildController::class, 'index']);
        return redirect()->action([AdultController::class, 'edit'],
                                    ['adult' => $request->input('adult_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Http\Response
     */
    public function show(Child $child)
    {
        //dd($child->adults);
        $account_holder = $child->adults->where('adult_role_id', 1)->first();
        //dd($child);
        //$siblings = Child::with('adults')->get();
        //$siblings = Child::getSiblings($child->id, $account_holder_id);
       // $siblings = Child::where('id','!=', $child->id)->whereHas('adults', function($query) {
        //    $query->where('id', 1);
        //})
        //->get();
        //$siblings = DB::table('children_adults')->select('child_id')->where('adult_id', $account_holder_id)->get();
        //$siblings = Child::with(['getSiblings' => function($query){ $query->wherePivot('adult_id', 1); }])->get();
        //dd($account_holder_id);
        /*$siblings = DB::table('children_adults')
            ->join('children', 'children_adults.child_id', '=', 'children.id')
            ->select('children.*', 'children_adults.adult_id')
            ->where('children_adults.adult_id', $account_holder_id)
            ->get();
            dd($siblings);*/
        //$age = $child->getAge($child->dob);
        //$child = $child::with('group:id,name')->get();
        return view('children.show')
            ->with('child', $child)
            ->with('account_holder', $account_holder);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Http\Response
     */
    public function edit(Child $child)
    {
        $groups = DB::table('groups')->get()->pluck('name', 'id')->prepend('Select a group');
        return view('children.edit')
            ->with('child', $child)
            ->with('groups', $groups);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Child $child)
    {
        $child->fill($request->input());
        if($request->hasFile('picture')){
            $oldImage = Storage::disk('public')->delete('{{ $child->picture }}');
            $child->picture = $request->file('picture')->store('public');
        }
        //$child->picture = $request->file('picture')->store('public');
        $child->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Http\Response
     */
    public function destroy(Child $child)
    {
        //
    }
}
