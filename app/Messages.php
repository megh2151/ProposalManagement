<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Messages extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_id', 'to_id', 'proposal_id', 'message'
    ];


    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
    
}
