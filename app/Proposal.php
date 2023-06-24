<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Messages');
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public function local_government_area()
    {
        return $this->belongsTo(LocalGovernmentAreas::class,'local_government_area_id');
    }
}