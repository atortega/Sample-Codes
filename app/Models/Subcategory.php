<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name','description'];

    function withCategories() {
        return (DB::table('subcategories')
            ->select('subcategories.*', 'categories.title')
            ->leftJoin('categories', 'subcategories.category_id', '=', 'categories.id')
            ->orderBy('subcategories.name', 'asc')
            ->get());
    }

    function getByCategory($category_id) {
        return (DB::table('subcategories')
            ->select('subcategories.*', 'categories.title')
            ->leftJoin('categories', 'subcategories.category_id', '=', 'categories.id')
            ->where('subcategories.category_id', '=', $category_id)
            ->orderBy('subcategories.name', 'asc')
            ->get());
    }
}
