<?php

namespace App\Models\Forms;

use App\Models\Model;

class SiteFormQuestion extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'form_id', 'question', 'has_options'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'site_form_questions';

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'question' => 'required',
    ];
    
    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'question' => 'required',
    ];

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the form this question belongs to.
     */
    public function form() 
    {
        return $this->belongsTo('App\Models\Forms\SiteForm', 'form_id');
    }

    /**
     * Get the options related to this question.
     */
    public function questions() 
    {
        return $this->hasMany('App\Models\Forms\SiteFormOption', 'question_id');
    }

}
