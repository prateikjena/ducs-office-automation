<?php

namespace App\Http\Requests\Staff;

use App\Models\Cosupervisor;
use App\Models\ExternalAuthority;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreScholarRequest extends FormRequest
{
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:scholars',
            'term_duration' => 'required| integer| gt: 0',
            'supervisor_id' => ['required', Rule::exists(User::class, 'id')->where('is_supervisor', true)],
            'cosupervisor_id' => [
                'nullable',
                'different:supervisor_id',
                Rule::exists(User::class, 'id')
                    ->where(function ($query) {
                        return $query->where('is_cosupervisor', 1)
                            ->orWhere('is_supervisor', 1);
                    }),
            ],
        ];
    }
}
