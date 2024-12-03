<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
    ];

    /**
     * Get the menus associated with the category.
     * (Optional: if there's a relationship with a Menu model)
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
