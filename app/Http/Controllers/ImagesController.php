<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;
use App\Classes\Images as Pictures;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = new Images();

        return response()->json($images->getAllImages());
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
            'room_id' => 'exists:App\Models\Rooms,id',
            'files' => 'required',
            'files.*' => 'mimes:jpeg,jpg,png,gif|max:4096'
        ]);
        
        if ($request->hasfile('files')) {
            $return = [];
            foreach ($request->file('files') as $file)
            {
                $name = $file->getClientOriginalName();
                $path = '/uploads/' . $request->category_id . '/' . $request->subcategory_id . '/' . $request->room_id;
                $pic = new Pictures();
                $pic->checkAndCreatePath($path);
                $fullpath = $pic->storeUploadedPic($file, $name, $path);
                $pic->createAllThumbs($file, $path);

                $return[] = $fullpath;
               
            }
            return response()->json($return);
        }
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
