<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
            'room_id',
            'category_id',
            'subcategory_id',
            'title',
            'description'
    ];

    function getAllImages() {
        return (DB::table('images')
                ->leftJoin('rooms', 'images.room_id', '=', 'rooms.id' )
                ->leftJoin('subcategories', 'images.subcategory_id', '=', 'subcategories.id')
                ->leftJoin('categories', 'images.category_id', '=', 'categories.id')
                ->select('images.*', 'rooms.name as room', 'categories.title as category', 'subcategories.name as subcategory')
                ->get()
        );

    }
}
