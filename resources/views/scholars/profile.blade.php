@extends('layouts.scholars')
@section('body')
    <div class="container mx-auto p-4 space-y-8">
        <div class="page-card p-6 overflow-visible space-y-4">
            <div class="flex">
                <div class="flex items-center">
                    <img src="{{ route('scholars.profile.avatar')}}" class="w-24 h-24 object-cover mr-4 border rounded shadow">
                    <h3 class="text-2xl font-bold"> {{$scholar->name}}</h3>
                </div>
                <div class="ml-auto space-y-1">
                    <div class="flex">
                        <h4 class="font-semibold"> Gender </h4>
                        <p class="ml-2"> {{ $scholar->gender }}</p>
                    </div>
                    <div class="flex items-center mb-1">
                        <feather-icon name="at-sign" class="h-current mr-2"></feather-icon>
                        <a href="mailto:{{ $scholar->email}}">{{ $scholar->email }}</a>
                    </div>
                    <div class="flex items-center mb-1">
                        <feather-icon name="phone" class="h-current mr-2"></feather-icon>
                        <a href="tel:{{ $scholar->phone_no }}">{{ $scholar->phone_no }}</a>
                    </div>
                    <div class="flex">
                        <feather-icon name="home" class="h-current mr-2"></feather-icon>
                        <address>
                            {{ $scholar->address }}
                        </address>
                    </div>
                </div>
                <div class="ml-auto self-start">
                    <a href=" {{ route('scholars.profile.edit') }} " class="btn btn-magenta">Edit</a>
                </div>
            </div>

            <div class="flex space-x-6">
                <div class="w-64 pr-4 relative -ml-8 my-6">
                    <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                        Admission
                    </h3>
                    <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                        <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                    </svg>
                </div>
                <div class="mt-4 flex-1">
                    <ul class="border rounded-lg overflow-hidden mb-4">
                        <li class="px-4 py-3 border-b last:border-b-0">
                            <div class="flex mt-2">
                                <p class="font-bold"> Category</p>
                                <p class="ml-4 text-gray-800">{{ $scholar->category ?? 'not set' }}</p>
                            </div>
                        </li>
                        <li class="px-4 py-3 border-b last:border-b-0">
                            <div class="mt-2 flex">
                                <h4 class="font-bold"> Date of enrollment </h4>
                                <p class="ml-4 text-gray-800"> {{ $scholar->enrollment_date }}</p>
                            </div>
                        </li>
                        <li class="px-4 py-3 border-b last:border-b-0">
                            <div class="flex mt-2">
                                <p class="font-bold"> Admission via</p>
                                <p class="ml-4 text-gray-800"> {{ $scholar->admission_mode ?? '-'}}</p>
                            </div>
                        </li>
                        <li class="px-4 py-3 border-b last:border-b-0">
                            <div class="mt-2 flex">
                                <p class="font-bold"> Funding </p>
                                <p class="ml-4 text-gray-800">
                                    {{ optional($scholar->admission_mode)->getFunding() ?? '-'}}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex space-x-6">
                <div class="w-64 pr-4 relative -ml-8 my-6">
                    <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                        Education
                    </h3>
                    <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                        <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                    </svg>
                </div>
                <div class="flex-1 mt-4">
                    <ul class="border rounded-lg overflow-hidden mb-4 divide-y">
                        @forelse(collect($scholar->education_details)->chunk(2) as $educationRow)
                            <li class="flex justify-between divide-x">
                                @foreach($educationRow as $education)
                                <div class="py-4 px-6 flex-1">
                                    <div class="flex mb-1">
                                        <feather-icon name="book" class="h-current"></feather-icon>
                                        <p class="truncate">
                                            <span class="ml-2 font-bold">{{ $education->degree }}</span>
                                            <span class="ml-1 font-normal">({{ $education->subject }})</span>
                                        </p>
                                    </div>
                                    <p class="ml-6 text-gray-700 mb-1"> {{ $education->institute }} </p>
                                    <p class="ml-6 text-gray-700"> {{ $education->year }} </p>
                                </div>
                                @endforeach
                            </li>
                        @empty
                            <li class="px-4 py-3 border-b last:border-b-0 text-center text-gray-700 font-bold">No education details added!</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="flex space-x-6">
                <div class="w-64 pr-4 relative z-10 -ml-8 mt-4 mb-2">
                    <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                        Broad Area of Research
                    </h3>
                    <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                        <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                    </svg>
                </div>
                <div class="mt-4 flex-1 px-4 py-3 border rounded-lg">
                    <p class="ml-2 font-bold"> {{ $scholar->research_area }}</p>
                </div>
            </div>

            <div class="flex space-x-6">
                <div class="w-64 pr-4 relative -ml-8 my-6">
                    <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                        Supervisor
                    </h3>
                    <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                        <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                    </svg>
                </div>
                <ul class="flex-col-reverse flex mt-4 flex-1 border rounded-lg overflow-hidden">
                    @php
                        $prevDate = $scholar->registerOn
                    @endphp
                    @foreach ($scholar->old_supervisors as $old_supervisor)
                    <li class="border-b first:border-b-0 px-5 p-2">
                        <div class="flex justify-between items-center">
                            <div class="w-1/2">
                                <p class="font-bold"> {{ $old_supervisor['name'] }} </p>
                                <div class="flex mt-1 items-center text-gray-700">
                                    <feather-icon name="at-sign" class="h-current">Email</feather-icon>
                                    <p class="ml-1 italic"> {{ $old_supervisor['email'] }} </p>
                                </div>
                            </div>
                            <p class="w-1/2 mr-4 font-bold"> {{ $prevDate }} - {{ $old_supervisor['date']}}</p>
                            @php
                                $prevDate = $old_supervisor['date']
                            @endphp
                        <div>
                    </li>
                    @endforeach
                    <li class="border-b first:border-b-0 px-5 p-2">
                        <div class="flex justify-between items-center">
                            <div class="w-1/2">
                                <p class="font-bold"> {{ $scholar->supervisor->name }} </p>
                                <div class="flex mt-1 items-center text-gray-700">
                                    <feather-icon name="at-sign" class="h-current">Email</feather-icon>
                                    <p class="ml-1 italic"> {{ $scholar->supervisor->email }} </p>
                                </div>
                            </div>
                            <p class="w-1/2 mr-4 font-bold"> {{ $prevDate }} - Present</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="flex space-x-6">
                <div class="w-64 pr-4 relative -ml-8 my-6">
                    <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                        Cosupervisor
                    </h3>
                    <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                        <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                    </svg>
                </div>


                <ul class="self-start flex-col-reverse flex mt-4 flex-1 border rounded-lg overflow-hidden">
                    @php
                        $prevDate = $scholar->registerOn
                    @endphp
                    @foreach ($scholar->old_cosupervisors as $old_cosupervisor)
                    <li class="border-b first:border-b-0 px-5 p-2">
                        <div class="flex justify-between items-center">
                            <div class="w-1/2">
                                @if ($old_cosupervisor['name'])
                                <p class="font-bold"> {{ $old_cosupervisor['name'] }} </p>
                                <p class="text-gray-700 mt-1"> {{ $old_cosupervisor['designation'] }} </p>
                                <p class="text-gray-700 mt-1"> {{ $old_cosupervisor['affiliation'] }} </p>
                                <div class="flex mt-1 items-center text-gray-700">
                                    <feather-icon name="at-sign" class="h-current">Email</feather-icon>
                                    <p class="ml-1 italic"> {{ $old_cosupervisor['email'] }} </p>
                                </div>
                                @else
                                <p class="font-bold"> Cosupervisor Not Assigned </p>
                                @endif
                            </div>
                            <p class="w-1/2 mr-4 font-bold"> {{ $prevDate }} - {{ $old_cosupervisor['date']}}</p>
                            @php
                                $prevDate = $old_cosupervisor['date']
                            @endphp
                        <div>
                    </li>
                    @endforeach
                    <li class="border-b first:border-b-0 px-5 p-2">
                        <div class="flex justify-between items-center">
                            <div class="w-1/2">
                                @if ($scholar->cosupervisor)
                                <p class="font-bold"> {{ $scholar->cosupervisor->name }} </p>
                                <p class="text-gray-700 mt-1"> {{ $scholar->cosupervisor->designation }} </p>
                                <p class="text-gray-700 mt-1"> {{ $scholar->cosupervisor->affiliation }} </p>
                                <div class="flex mt-1 items-center text-gray-700">
                                    <feather-icon name="at-sign" class="h-current">Email</feather-icon>
                                    <p class="ml-1 italic"> {{ $scholar->cosupervisor->email }} </p>
                                </div>
                                @else
                                <p class="font-bold"> Cosupervisor Not Assigned </p>
                                @endif
                            </div>
                            <p class="w-1/2 mr-4 font-bold"> {{ $prevDate }} - Present</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Advisory Commitee--}}
        <div class="page-card p-6 flex overflow-visible space-x-6">
            <div class="w-64 pr-4 relative -ml-8 my-6">
                <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                    Advisory Committee
                </h3>
                <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                    <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                </svg>
                <div class="flex justify-center mt-4">
                    @can('scholars.advisory_committee.manage', $scholar)
                    @include('research.scholars.modals.edit_advisory_committee', [
                        'modalName' => 'edit-advisory-committee-modal',
                        'faculty' => $faculty,
                        'scholar' => $scholar
                    ])
                    <button class="btn btn-magenta is-sm shadow-inner ml-auto mr-2" @click.prevent="$modal.show('edit-advisory-committee-modal', {
                        actionUrl: '{{ route('research.scholars.advisory_committee.update', $scholar) }}',
                        actionName: 'Update'
                    })">
                        Edit
                    </button>
                    <button class="btn btn-magenta is-sm shadow-inner" @click.prevent="$modal.show('edit-advisory-committee-modal', {
                        actionUrl: '{{ route('research.scholars.advisory_committee.replace', $scholar) }}',
                        actionName: 'Replace'
                    })">
                        Replace
                    </button>
                    @endcan
                </div>
            </div>
            <div class="flex-1">
                @include('research.scholars.partials.advisory_committee',[
                    'advisoryCommittee' => $scholar->advisory_committee
                ])
                @foreach ($scholar->old_advisory_committees as $oldCommittee)
                <details class="mt-1">
                    <summary class="p-2 bg-gray-200 rounded">
                        {{ $oldCommittee['from_date']->format('d F Y') }} - {{ $oldCommittee['to_date']->format('d F Y') }}
                    </summary>
                    <div class="ml-2 pl-4 py-2 border-l">
                        @include('research.scholars.partials.advisory_committee',[
                        'advisoryCommittee' => $oldCommittee['committee']
                        ])
                    </div>
                </details>
                @endforeach
            </div>
        </div>

        {{-- Courseworks --}}
        <div class="page-card p-6 flex overflow-visible space-x-6">
            <div class="w-64 pr-4 relative z-10 -ml-8 my-2">
                <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                    Pre-PhD Coursework
                </h3>
                <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                    <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                </svg>
            </div>
            <div class="flex-1">
                <ul class="border rounded-lg overflow-hidden mb-4">
                    @foreach ($scholar->courseworks as $course)
                        <li class="px-4 py-3 border-b last:border-b-0">
                            <div class="flex items-center">
                                <div class="w-24">
                                    <span class="px-3 py-1 text-sm font-bold bg-magenta-200 text-magenta-800 rounded-full mr-4">{{ $course->type }}</span>
                                </div>
                                <h5 class="font-bold flex-1">
                                    {{ $course->name }}
                                    <span class="text-sm text-gray-500 font-bold"> ({{ $course->code }}) </span>
                                </h5>
                                @if ($course->pivot->completed_on)
                                    <div class="flex items-center pl-4">

                                        <a target="_blank"
                                        href="{{ route('research.scholars.courseworks.marksheet', [ $scholar, $course->pivot])}}"
                                        class="btn inline-flex items-center ml-2">

                                        <feather-icon name="paperclip" class="h-current mr-2"></feather-icon>
                                            Marksheet
                                        </a>
                                        <div class="w-5 h-5 inline-flex items-center justify-center bg-green-500 text-white font-extrabold leading-none rounded-full mr-2">&checkmark;</div>
                                        <div>
                                            Completed on {{ $course->pivot->completed_on->format('d M, Y') }}
                                        </div>
                                    </div>
                                @elsecan('scholars.coursework.complete', $scholar)
                                    <button class="btn btn-magenta bg-green-500 hover:bg-green-600 text-white text-sm rounded-lg"
                                        @click="$modal.show('mark-coursework-completed', {
                                            'scholar': {{ $scholar }},
                                            'course': {{ $course }}
                                        })">
                                        Mark Completed
                                    </button>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
                @can('scholars.coursework.store', $scholar)
                <button class="w-full btn btn-magenta rounded-lg py-3" @click="$modal.show('add-coursework-modal')">
                    + Add Coursework
                </button>
                <v-modal name="add-coursework-modal" height="auto">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Add Coursework</h3>
                        <form action="{{ route('research.scholars.courseworks.store', $scholar) }}"
                            method="POST" class="flex">
                            @csrf_token
                            <select id="course_ids" name="course_ids[]" class="w-full form-input rounded-r-none">
                                @foreach ($courses as $course)
                                    <option value="{{$course->id}}">
                                        [{{ $course->code }}] {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-5 btn btn-magenta text-sm rounded-l-none">Add</button>
                        </form>
                    </div>
                </v-modal>
                @endcan
                @can('scholars.coursework.complete', $scholar)
                <v-modal name="mark-coursework-completed" height="auto">
                    <template v-slot="{ data }">
                        <form :action="route('research.scholars.courseworks.complete', [data('scholar'), data('course')])"
                        method="POST" class="p-6" enctype="multipart/form-data">
                        @csrf_token @method("PATCH")
                        <h2 class="text-lg font-bold mb-8">Mark Course Work Complete</h2>
                            <div class="flex mb-2">
                                <div class="flex-1 mr-2 items-baseline">
                                    <label for="completed_on" class="form-label mb-1 w-full">
                                        Date of Completion
                                        <span class="text-red-600 font-bold">*</span>
                                    </label>
                                    <input type="date" name="completed_on"
                                    class="form-input w-full" id="completed_on">
                                </div>
                                <div class="flex-1 mb-2 items-baseline">
                                    <label for="marksheet" class="form-label mb-1 w-full">
                                        Upload Marksheet
                                        <span class="text-red-600 font-bold">*</span>
                                    </label>
                                    <input id="marksheet" type="file" name="marksheet"
                                        class="form-input w-full" accept="application/pdf,image/*">
                                </div>
                            </div>
                            <button class="bg-green-500 hover:bg-green-600 text-white text-sm py-2 rounded font-bold btn">
                                Mark Completed
                            </button>
                        </form>
                    </template>
                </v-modal>
                @endcan
            </div>
        </div>

        {{-- Publications --}}
        <div class="page-card p-6 overflow-visible space-y-6">
            @include('research.scholars.publications.journals.index', [
                'journals' => $scholar->journals
            ])

            @include('research.scholars.publications.conferences.index', [
                'conferences' => $scholar->conferences
            ])
        </div>

        {{-- Presentations --}}
        <div class="page-card p-6 flex overflow-visible space-x-6">
            <div class="w-64 pr-4 relative z-10 -ml-8 my-2">
                <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                    Presentations
                </h3>
                <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                    <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                </svg>
                @if(auth()->guard('scholars')->check() && auth()->guard('scholars')->id() === $scholar->id)
                <div class="mt-3 text-right">
                    <a class="btn btn-magenta" href="{{ route('scholars.presentation.create') }}">
                        New
                    </a>
                </div>
                @endif
            </div>
            <div class="flex-1">
            @include('research.scholars.presentations.index', [
                'presentations' => $scholar->presentations,
                'eventTypes' => $eventTypes,
            ])
            </div>
        </div>

        {{-- Leaves --}}
        <div class="page-card p-6 flex overflow-visible space-x-6">
            <div class="w-64 pr-4 relative z-10 -ml-8 my-2">
                <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                    Leaves
                </h3>
                <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                    <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                </svg>
                @can('scholars.leaves.apply', $scholar)
                <div class="mt-3 text-right">
                    <button class="btn btn-magenta is-sm"
                        @click="$modal.show('apply-for-leave-modal')">
                        Apply For Leaves
                    </button>
                    <v-modal name="apply-for-leave-modal" height="auto">
                        <template v-slot="{ data }">
                            <form action="{{ route('scholars.leaves.store') }}" method="POST" class="p-6" enctype="multipart/form-data">
                                <h3 class="text-lg font-bold mb-4">Add Leave</h3>
                                @csrf_token
                                <input v-if="data('extensionId')" type="hidden" name="extended_leave_id" :value="data('extensionId')">
                                <div class="flex mb-2">
                                    <div class="flex-1 mr-2">
                                        <label for="from_date" class="w-full form-label mb-1">
                                            From Date
                                            <span class="text-red-600 font-bold">*</span>
                                        </label>
                                        <div v-if="data('extension_from_date')" class="w-full form-input cursor-not-allowed bg-gray-400 hover:bg-gray-400">
                                            <span v-text="data('extension_from_date', '')"></span>
                                            <input type="hidden" name="from" :value="data('extension_from_date', '')">
                                        </div>
                                        <input v-else id="from_date" type="date" name="from"
                                            placeholder="From Date"
                                            class="w-full form-input">
                                    </div>
                                    <div class="flex-1 ml-2">
                                        <label for="to_date" class="w-full form-label mb-1">
                                            To Date
                                            <span class="text-red-600 font-bold">*</span>
                                        </label>
                                        <input type="date" name="to" id="to_date" placeholder="To Date" class="w-full form-input"
                                            :min="data('extension_from_date', '')">
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="reason" class="w-full form-label mb-1">
                                        Reason <span class="text-red-600 font-bold">*</span>
                                    </label>
                                    <select id="leave_reasons" name="reason" class="w-full form-select" onchange="
                                        if(reason.value === 'Other') {
                                            reason_text.style = 'display: block;';
                                        } else {
                                            reason_text.style = 'display: none;';
                                        }">
                                        <option value="Maternity/Child Care Leave">Maternity/Child Care Leave</option>
                                        <option value="Medical">Medical</option>
                                        <option value="Duty Leave">Duty Leave</option>
                                        <option value="Deregistration">Deregistration</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <input type="text" name="reason_text" class="w-full form-input mt-2 hidden" placeholder="Please specify...">
                                </div>
                                <div class="mb-2">
                                    <label for="application" class="w-full form-label mb-1">
                                        Attach Application
                                        <span class="text-red-600 font-bold">*</span>
                                    </label>
                                    <input id="application" type="file" name="application" class="w-full form-input mt-2" accept="application/pdf,image/*">
                                </div>
                                <button type="submit" class="px-5 btn btn-magenta text-sm">Add</button>
                            </form>
                        </template>
                    </v-modal>
                </div>
                @endcan
            </div>
            <div class="flex-1">
                <form id="patch-form" method="POST" class="w-0">
                    @csrf_token @method("PATCH")
                </form>
                <ul class="w-full border rounded-lg overflow-hidden mb-4">
                    @forelse ($scholar->leaves as $leave)
                    <li class="px-4 py-3 border-b last:border-b-0">
                        <div class="flex items-center">
                            <h5 class="font-bold flex-1">
                                {{ $leave->reason }}
                                <div class="text-sm text-gray-500 font-bold">
                                    ({{ $leave->from->format('Y-m-d') }} - {{$leave->to->format('Y-m-d')}})
                                </div>
                            </h5>
                            <a target="_blank" href="{{ route('scholars.leaves.application', $leave) }}"
                                class="btn inline-flex items-center ml-2">
                                <feather-icon name="paperclip" class="h-current mr-2"></feather-icon>
                                Application
                            </a>
                            @if ($leave->isApproved() || $leave->isRejected())
                                <a target="_blank" href="{{ route('scholars.leaves.response_letter', $leave) }}" class="btn inline-flex items-center ml-2">
                                    <feather-icon name="paperclip" class="h-current mr-2"></feather-icon>
                                    Response
                                </a>
                            @endif
                            <div class="flex items-center px-4">
                                <feather-icon name="{{ $leave->status->getContextIcon() }}"
                                    class="h-current {{ $leave->status->getContextCSS() }} mr-2" stroke-width="2.5"></feather-icon>
                                <div class="capitalize">
                                    {{ $leave->status }}
                                </div>
                            </div>
                            @can('recommend', $leave)
                                <button type="submit" form="patch-form"
                                    class="px-4 py-2 mr-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded font-bold"
                                    formaction="{{ route('research.scholars.leaves.recommend', [$scholar, $leave]) }}">
                                    Recommend
                                </button>
                            @endcan
                            @can('respond', $leave)
                                <button
                                    class="btn btn-magenta bg-green-500 hover:bg-green-600 text-white text-sm rounded-lg"
                                    @click="$modal.show('respond-to-leave', {
                                        'leave': {{ $leave }},
                                        'scholar': {{ $scholar }},
                                    })"> Respond
                                </button>
                            @endcan
                            @can('extend', $leave)
                                <button class="btn btn-magenta text-sm is-sm ml-4"
                                    @click="$modal.show('apply-for-leave-modal', {
                                        'extensionId': {{$leave->id}},
                                        'extension_from_date': '{{ $leave->nextExtensionFrom()->format('Y-m-d') }}'
                                    })">
                                    Extend
                                </button>
                            @endcan
                        </div>
                        {{-- inception --}}
                        <div class="ml-3 border-l-4">
                            @foreach($leave->extensions as $extensionLeave)
                            <div class="flex items-center ml-6 mt-4">
                                <h5 class="font-bold flex-1">
                                    {{ $extensionLeave->reason }}
                                    <div class="text-sm text-gray-500 font-bold">
                                        (extension till {{$extensionLeave->to->format('Y-m-d')}})
                                    </div>
                                </h5>
                                <a target="_blank" href="{{ route('research.scholars.leaves.application', [$scholar, $leave]) }}" class="btn inline-flex items-center ml-2">
                                    <feather-icon name="paperclip" class="h-current mr-2"></feather-icon>
                                    Application
                                </a>
                                @if ($extensionLeave->isApproved() || $extensionLeave->isRejected())
                                    <a target="_blank" href="{{ route('research.scholars.leaves.response_letter', [$scholar, $leave]) }}" class="btn inline-flex items-center ml-2">
                                        <feather-icon name="paperclip" class="h-current mr-2"></feather-icon>
                                        Response
                                    </a>
                                @endif
                                <div class="flex items-center px-4">
                                    <feather-icon name="{{ $extensionLeave->status->getContextIcon() }}"
                                        class="h-current {{ $extensionLeave->status->getContextCSS() }} mr-2" stroke-width="2.5">
                                    </feather-icon>
                                    <div class="capitalize">
                                        {{ $extensionLeave->status }}
                                    </div>
                                </div>
                                @can('recommend', $extensionLeave)
                                <button type="submit" form="patch-form"
                                    class="px-4 py-2 mr-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded font-bold"
                                    formaction="{{ route('research.scholars.leaves.recommend', [$scholar, $extensionLeave]) }}">
                                    Recommend
                                </button>
                                @endcan
                                @can('respond', $extensionLeave)
                                <button
                                    class="btn btn-magenta bg-green-500 hover:bg-green-600 text-white text-sm rounded-lg"
                                    @click="$modal.show('respond-to-leave', {
                                        'leave': {{ $extensionLeave }},
                                        'scholar': {{ $scholar }},
                                    })"> Respond
                                </button>
                                @endcan
                            </div>
                            @endforeach
                        </div>
                    </li>
                    @empty
                    <li class="px-4 py-3 border-b last:border-b-0 text-center text-gray-700 font-bold">No Leaves</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Meetings --}}
        <div class="page-card p-6 flex overflow-visible space-x-6">
            <div class="w-64 pr-4 relative z-10 -ml-8 my-2">
                <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                    Advisory Meetings
                </h3>
                <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                    <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                </svg>
            </div>
            <div class="flex-1">
                <ul class="border rounded-lg overflow-hidden mb-4">
                    @forelse ($scholar->advisoryMeetings as $meeting)
                    <li class="px-4 py-3 border-b last:border-b-0">
                        <div class="flex items-center">
                            <h5 class="font-bold flex-1">
                                {{ $meeting->date->format('D M d, Y') }}
                            </h5>
                            <a href="{{ route('research.scholars.advisory_meetings.minutes_of_meeting', $meeting) }}"
                                class="inline-flex items-center underline px-4 py-2 text-gray-900 rounded font-bold">
                                <feather-icon name="paperclip" class="h-4 mr-2"></feather-icon>
                                Minutes of Meeting
                            </a>
                        </div>
                    </li>
                    @empty
                    <li class="px-4 py-3 border-b last:border-b-0 text-center text-gray-700 font-bold">No Meetings yet.</li>
                    @endforelse
                </ul>
                @can('scholars.advisory_meetings.store', $scholar)
                <button class="mt-2 w-full btn btn-magenta rounded-lg py-3" @click="$modal.show('add-advisory-meetings-modal')">
                    + Add Meetings
                </button>
                <v-modal name="add-advisory-meetings-modal" height="auto">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Add Advisory Meetings</h3>
                        <form action="{{ route('research.scholars.advisory_meetings.store', $scholar) }}" method="POST"
                            class="flex" enctype="multipart/form-data">
                            @csrf_token
                            <input id="date" name="date" type="date" class="form-input rounded-r-none">
                            <input type="file" name="minutes_of_meeting" id="minutes_of_meeting" class="w-full flex-1 form-input rounded-none" accept="document/*">
                            <button type="submit" class="px-5 btn btn-magenta text-sm rounded-l-none">Add</button>
                        </form>
                    </div>
                </v-modal>
                @endcan
            </div>
        </div>



        {{--Progress Reports--}}
        @php($recommendationColors = [
            App\Types\ProgressReportRecommendation::CANCELLATION => 'bg-red-300 text-red-900',
            App\Types\ProgressReportRecommendation::WARNING => 'bg-yellow-300 text-yellow-900',
            App\Types\ProgressReportRecommendation::CONTINUE => 'bg-green-300 text-green-900',
        ])
        <div class="page-card p-6 flex overflow-visible space-x-6">
            <div class="w-64 pr-4 relative z-10 -ml-8 my-2">
                <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                    Progress Reports
                </h3>
                <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                    <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                </svg>
            </div>
            <div class="flex-1">
                <ul class="border rounded-lg overflow-hidden mb-4 divide-y">
                    @forelse ($scholar->progressReports() as $progressReport)
                        <li class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="flex items-center space-x-4 mr-4">
                                    <p class="font-bold w-32">{{ $progressReport->date->format('d F Y') }}</p>
                                    <a href="{{ route('research.scholars.progress_reports.attachment', [$scholar, $progressReport]) }}"
                                        class="inline-flex items-center underline px-3 py-1 bg-gray-100 text-gray-900 rounded font-bold">
                                        <feather-icon name="paperclip" class="h-4 mr-2">Attachment</feather-icon>
                                        Attachment
                                    </a>
                                </div>
                                <span class="px-3 py-1 text-sm font-bold rounded-full ml-auto flex-shrink-0
                                    {{ $recommendationColors[$progressReport->description] }}">
                                    {{ $progressReport->description }}
                                </span>
                            </div>
                        </li>
                    @empty
                        <li class="px-4 py-3 text-center text-gray-700 font-bold">No Progress Reports yet.</li>
                    @endforelse
                </ul>
                @can('scholars.progress_reports.store', $scholar)
                <button class="mt-2 w-full btn btn-magenta rounded-lg py-3" @click="$modal.show('add-progress-reports-modal')">
                    + Add Progress Reports
                </button>
                <v-modal name="add-progress-reports-modal" height="auto">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Add Progress Report</h3>
                        <form action="{{ route('research.scholars.progress_reports.store', $scholar) }}" method="POST"
                            class="px-6" enctype="multipart/form-data">
                            @csrf_token
                            <div class="mb-2 flex items-center">
                                <div class="w-1/2 mr-1">
                                    <label for="date" class="mb-1 w-full form-label">Date
                                        <span class="text-red-600">*</span>
                                    </label>
                                    <input type="date" name="date" id="date" class="w-full form-input" required>
                                </div>
                                <div class="w-1/2 ml-1">
                                    <label for="description" class="mb-1 w-full form-label">Recommendation
                                        <span class="text-red-600">*</span>
                                    </label>
                                    <select class="w-full form-input block" name="description" required>
                                        <option class="text-gray-600" selected disabled value="">Select Recommendation</option>
                                        @foreach (App\Types\ProgressReportRecommendation::values() as $recommendation)
                                            <option value="{{ $recommendation }}" class="text-gray-600"> {{ $recommendation }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="progress_report" class="w-full form-label mb-1">Upload Progress Report
                                    <span class="text-red-600">*</span>
                                </label>
                                <input type="file" name="progress_report" id="progress_report" class="w-full mb-1" accept="document/*" required>
                            </div>
                            <button type="submit" class="px-5 btn btn-magenta text-sm rounded-l-none">Add</button>
                        </form>
                    </div>
                </v-modal>
                @endcan
            </div>
        </div>

        {{--Other Documents--}}
        <div class="page-card p-6 flex overflow-visible space-x-6">
            <div class="w-64 pr-4 relative z-10 -ml-8 my-2">
                <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                    Other Documents
                </h3>
                <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                    <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                </svg>
            </div>
            <div class="flex-1">
                <ul class="border rounded-lg overflow-hidden mb-4 divide-y">
                    @forelse ($scholar->otherDocuments() as $otherDocument)
                        <li class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <p class="font-bold mr-2">{{ $otherDocument->date->format('d F Y') }}</p>
                                    <p class="text-gray-700">{{ $otherDocument->description }}</p>
                                </div>
                                <a href="{{ route('research.scholars.documents.attachment', [$scholar, $otherDocument]) }}"
                                    class="inline-flex items-center underline px-3 py-1 bg-gray-100 text-gray-900 rounded font-bold">
                                <feather-icon name="paperclip" class="h-4 mr-2"></feather-icon>
                                    Attachment
                                </a>
                            </div>
                        </li>
                    @empty
                        <li class="px-4 py-3 text-center text-gray-700 font-bold">No Documents</li>
                    @endforelse
                </ul>
                @can('scholars.other_documents.store', $scholar)
                <button class="mt-2 w-full btn btn-magenta rounded-lg py-3" @click="$modal.show('add-other-documents-modal')">
                    + Add Documents
                </button>
                <v-modal name="add-other-documents-modal" height="auto">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Add Documents</h3>
                        <form action="{{ route('research.scholars.documents.store', $scholar) }}" method="POST"
                            class="px-6" enctype="multipart/form-data">
                            @csrf_token
                            <div class="mb-2">
                                <label for="description" class="mb-1 w-full form-label">Description
                                    <span class="text-red-600">*</span>
                                </label>
                                <textarea id="description" name="description" type="" class="w-full form-input" placeholder="Enter Description" required>
                                </textarea>
                            </div>
                            <div class="flex mb-2 items-center">
                                <div class="w-1/2 mr-1">
                                    <label for="date" class="mb-1 w-full form-label">Date
                                        <span class="text-red-600">*</span>
                                    </label>
                                    <input type="date" name="date" id="date" class="w-full form-input" required>
                                </div>
                                <div class="w-1/2 ml-1">
                                    <label for="document" class="w-full form-label mb-1">Upload Document
                                        <span class="text-red-600">*</span>
                                    </label>
                                    <input type="file" name="document" id="document" class="w-full mb-1 items-center" accept="document/*" required>
                                </div>
                            </div>
                            <button type="submit" class="px-5 btn btn-magenta text-sm rounded-l-none">Add</button>
                        </form>
                    </div>
                </v-modal>
                @endcan
            </div>
        </div>

    </div>
@endsection
