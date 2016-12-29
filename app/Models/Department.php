<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Department
 * @package App\Models
 * @version December 28, 2016, 4:53 am UTC
 */
class Department extends Model
{
    use SoftDeletes;

    public $table = 'departments';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'phone',
        'manager_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'phone' => 'string',
        'manager_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'phone' => 'required|regex:/(01)[0-9]{9}/',
        'manager_id' => 'required'
    ];

    public function manager() {
        return $this->belongsTo(Employee::class, 'manager_id');
    }
    
}
