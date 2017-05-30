<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Uuids;

class TicketPurchased extends Model
{
    //
    use Uuids;
    public $incrementing = FALSE;
    protected $guarded = ['id'];

    public function ticket(){
        return $this->belongsTo('App\Models\Eventickets', 'ticket_id', 'id');
    }
}
