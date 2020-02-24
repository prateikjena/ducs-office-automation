<?php

namespace App\Http\Requests\Staff;

use App\CourseProgrammeRevision;
use App\Programme;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProgrammeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Programme::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $types = implode(',', array_keys(config('options.programmes.types')));

        return [
            'code' => ['required', 'min:3', 'max:60', 'unique:programmes,code'],
            'wef' => ['required', 'date'],
            'name' => ['required', 'min:3', 'max:190'],
            'type' => ['required', 'in:' . $types],
            'duration' => ['required', 'integer'],
            'semester_courses' => ['required', 'array', 'size:' . ($this->duration * 2)],
            'semester_courses.*' => ['required', 'array', 'min:1'],
            'semester_courses.*.*' => ['numeric', 'distinct', 'exists:courses,id',
                Rule::unique(CourseProgrammeRevision::class, 'course_id'),
            ],
        ];
    }
}