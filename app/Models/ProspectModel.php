<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectModel extends Model
{
    use HasFactory;
    protected $table = 'prospects';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activities()
    {
        return $this->hasMany(ActivitiesModel::class, 'prospect_id', 'id');
    }
}
