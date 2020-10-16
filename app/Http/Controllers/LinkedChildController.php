<?php

namespace App\Http\Controllers;

use App\Models\Child;
//use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LinkedChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return redirect()->action([HomeController::class, 'index']);
    }


    public function linkChild(Request $request){
        //Verify child's linking parameters
        $child = DB::table('children')->select('id')->where([
            ['code', '=', $request->input('code')],
            ['first_name', '=', $request->input('first_name')],
            ['last_name', '=', $request->input('last_name')],
            ['dob', '=', $request->input('dob')],
        ])->first();

        if(!is_null($child)){
            $current_user = Auth::user();
            $linking_child_id = $child->id;
            $child_linked = DB::table('children_users')->insertOrIgnore(
                ['user_id' => $current_user->id, 'child_id' => $linking_child_id]
            );

            $child_linking_result = array();

            if(!$child_linked){
                $child_linking_result =[
                    'success' => false,
                    'msg' => 'The child is already linked to your account.'
                ] ;
            }else{
                $linked_child = Child::with('adults', 'group')->where('id', $linking_child_id)->get();
                $child_linking_result = [
                        'success' => true, 'msg' => 'The child was linked successfully.',
                        'child' => $linked_child
                ];
            }
        }else{
            $child_linking_result = [
                'success' => false,
                'msg' => 'Could not find a child with the specified parameters.'
            ];
        }

        return $child_linking_result;

        //return redirect()->back()->with('child_linked', $child_linked_result);
        //return response()->json(Child::get(), 200);
        //return response()->json([$request->all()]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Link child to user the current user account
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Verify child's linking parameters
        $child = DB::table('children')->select('id')->where([
            ['code', '=', $request->input('code')],
            ['first_name', '=', $request->input('first_name')],
            ['last_name', '=', $request->input('last_name')],
            ['dob', '=', $request->input('dob')],
        ])->first();

        if(!is_null($child)){
            $current_user = Auth::user();
            $linking_child_id = $child->id;
            $child_linked = DB::table('children_users')->insertOrIgnore(
                ['user_id' => $current_user->id, 'child_id' => $linking_child_id]
            );

            $child_linking_result = array();

            if(!$child_linked){
                $child_linking_result =[
                    'success' => false,
                    'msg' => 'The child is already linked to your account.'
                ] ;
            }else{
                $linked_child = Child::with('adults', 'group')->where('id', $linking_child_id)->get();
                $child_linking_result = [
                        'success' => true, 'msg' => 'The child was linked successfully.',
                        'child' => $linked_child
                ];
            }
        }else{
            $child_linking_result = [
                'success' => false,
                'msg' => 'Could not find a child with the specified parameters.'
            ];
        }

        //return $child_linking_result;

        return redirect()->back()->with('child_linked', $child_linking_result);
        //return response()->json(Child::get(), 200);
        //return response()->json([$request->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
