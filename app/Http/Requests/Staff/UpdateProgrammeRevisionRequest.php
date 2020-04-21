<?php

namespace App\Http\Requests\Staff;

use App\Models\Course;
use App\Models\CourseProgrammeRevision;
use App\Models\ProgrammeRevision;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProgrammeRevisionRequest extends FormRequest
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
        $programme = $this->route('programme');
        $revision = $this->route('revision');
        $revision_dates = $programme->revisions
            ->except($revision->id)
            ->pluck('revised_at')
            ->map->format('Y-m-d')
            ->toArray();

        return [
            'revised_at' => ['sometimes', 'required', 'date', Rule::notIn($revision_dates)],
            'semester_courses' => [
                'sometimes', 'required', 'array',
                'size:' . $programme->duration * 2,
            ],
            'semester_courses.*' => ['sometimes', 'required', 'array', 'min:1'],
            'semester_courses.*.*' => ['sometimes', 'numeric', 'distinct', 'exists:courses,id',
                Rule::unique(CourseProgrammeRevision::class, 'course_id')
                    ->whereNotIn(
                        'programme_revision_id',
                        $programme->revisions->pluck('id')->toArray()
                    ),
            ],
        ];
    }

    public function getSemesterCourses()
    {
        return collect($this->semester_courses)
            ->flatMap(static function ($courses, $semester) {
                return array_map(static function ($course) use ($semester) {
                    return ['id' => $course, 'pivot' => ['semester' => $semester]];
                }, $courses);
            })
            ->pluck('pivot', 'id')
            ->toArray();
    }
}
