<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'phone', 'website', 'logo'
      ];

    //protected $guarded = ['id'];

    public function employes()
    {
        return $this->hasMany(\App\Models\Employe::class);
    }

    public function scopeFilter($query, array $attrs = [])
    {
        foreach ($attrs as $key => $value) {
            if ($value) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }
    }
}
