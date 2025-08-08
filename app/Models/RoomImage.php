<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoomImage extends Pivot
{
    protected $table = 'room_image';

    protected $guarded = ['id'];
}
