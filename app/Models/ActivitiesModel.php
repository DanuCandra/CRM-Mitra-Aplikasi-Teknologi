<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesModel extends Model
{
    use HasFactory;
    protected $table = 'activities';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function prospect()
    {
        return $this->belongsTo(ProspectModel::class, 'prospect_id', 'id');
    }
}
