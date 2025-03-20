<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealModel extends Model
{
    use HasFactory;
    protected $table = 'deals';
    protected $primaryKey = 'id';

    public function get_account_detail()
    {
        return $this->hasOne(AccountModel::class, 'id', 'account_id');
    }

    public function get_contact_detail()
    {
        return $this->hasOne(ContactModel::class, 'id', 'contact_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
