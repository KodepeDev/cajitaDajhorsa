<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasUuids;

    protected $fillable = [
        'company_num',
        'ruc',
        'name',
        'status',
        'user_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    // owner user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function information(): HasOne
    {
        return $this->hasOne(CompanyInformation::class);
    }


    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->company_num = substr($model->ruc, -1);
        });
        self::updating(function($model){
            $model->company_num = substr($model->ruc, -1);
        });
    }
}
