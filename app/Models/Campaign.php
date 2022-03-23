<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    /**
     *  Properties Allowed To Be Inserted / Updated
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'total_budget',
        'daily_budget',
        'creative_upload',
    ];

    /**
     *  Append Campaign Image Properties As An Array
     *
     * @var array
     */
    protected $casts = [
        'creative_upload' => 'array',
    ];

    /**
     * Getter And Setter For Casted Image Properties
     *
     * @param  string  $data
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function creativeUpload(): Attribute
    {
        return new Attribute(
            get: fn ($data) => json_decode($data, true),
            set: fn ($data) => json_encode($data),
        );
    }
}