<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Employee
 * @package App\Models
 * @version December 28, 2016, 2:48 am UTC
 */
class Employee extends Model
{
    use SoftDeletes;

    public $table = 'employees';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'department_id',
        'job_title',
        'cellphone',
        'email',
        'photo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'department_id' => 'integer',
        'job_title' => 'string',
        'cellphone' => 'string|regex:/(01)[0-9]{9}/',
        'email' => 'string',
        'photo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'department_id' => 'numeric',
        'job_title' => 'required',
        'cellphone' => 'required',
        'email' => 'required',
        'photo' => 'mimes:jpeg,jpg,png | max:1000'
    ];
    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }
    
}
