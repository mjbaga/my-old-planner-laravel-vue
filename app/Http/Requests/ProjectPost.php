<?php

namespace App\Http\Requests;

use App\Project;
use Illuminate\Foundation\Http\FormRequest;

class ProjectPost extends FormRequest
{
    public function __construct() {
        parent::__construct();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'engagement_code' => 'required|unique:projects,engagement_code|numeric',
            'project_name' => 'required',
            'abbreviation' => 'required|max:10'
        ];
    }

}
