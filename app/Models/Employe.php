<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'first_name', 'last_name', 'company_id', 'email', 'phone'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function scopeFilter($query, array $attrs = [])
    {
        foreach ($attrs as $key => $value) {
            if ($value) {
                if($value === 'company_id'){
                    $query->where($key, $value);
                }else{
                    $query->where($key, 'like', '%' . $value . '%');
                }
            }
        }
    }

}
