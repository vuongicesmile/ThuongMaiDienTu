<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='categories';

//translate
    use Translatable;
    public $timestamps = false;
    public $translatedAttributes = ['category_id','locale','title', 'content'];
    protected $fillable = ['name','parent_id','slug'];
    //end translate

    public function __construct()
    {

    }
    public function categoryChilrent()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
    public function categorytranslations()
    {
        return $this->hasMany(CategoryTranslation::class,'category_id');
    }
}
