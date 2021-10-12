<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = new Rooms();

        return response()->json($rooms->withCategories());
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'exists:App\Models\Category,id',
            'subcategory_id' => 'exists:App\Models\Subcategory,id',
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $room = Rooms::create($request->post());

        return response()->json([
            'message'=>'Room Created Successfully!!',
            'room'=>$room
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function show(Rooms $rooms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function edit(Rooms $rooms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rooms $rooms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rooms $rooms)
    {
        //
    }

    public function getByCategoryAndSubcategory(Request $request)
    {
        $rooms = new Rooms();

        return response()->json($rooms->getByCategoryAndSubcategory($request->category_id, $request->subcategory_id));
    }
}
