<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'subcategory_id', 'name','description', 'featured_image', 'rate', 'rate_type'];

    function withCategories()
    {
        return (DB::table('rooms')
            ->select('rooms.*', 'categories.title as category', 'subcategories.name as subcategory')
            ->leftJoin('categories', 'categories.id', '=', 'rooms.category_id')
            ->leftJoin('subcategories', 'subcategories.id', '=', 'rooms.subcategory_id')
            ->orderBy('rooms.name', 'asc')
            ->get()
        );
    }

    function getByCategoryAndSubcategory($category_id, $subcategory_id)
    {
        return (DB::table('rooms')
            ->select('rooms.*', 'categories.title as category', 'subcategories.name as subcategory')
            ->leftJoin('categories', 'rooms.category_id', '=', 'categories.id')
            ->leftJoin('subcategories', 'rooms.subcategory_id', '=', 'subcategories.id')
            ->where('rooms.category_id', '=', $category_id)
            ->where('rooms.subcategory_id', '=', $subcategory_id)
            ->orderBy('rooms.name', 'asc')
            ->get()
        );
    }
}
