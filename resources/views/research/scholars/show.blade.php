@extends('layouts.research')
@section('body')
    <div class="container mx-auto p-4">
        <div class="bg-white p-6 h-full rounded shadow-md mb-8">
            <div class="flex items-center mb-4">
                <img src="{{ route('staff.scholars.avatar', $scholar)}}" class="w-24 h-24 object-cover mr-4 border rounded shadow">
                <h3 class="text-2xl font-bold"> {{$scholar->name}}</h3>
            </div>

            <address>
                {{ $scholar->address}}
            </address>

            <p class="flex items-center">
                <feather-icon name="at-sign" class="h-current mr-2"></feather-icon>
                <a href="mailto:{{ $scholar->email}}">{{ $scholar->email }}</a>
            </p>

            <p class="flex items-center">
                <feather-icon name="phone" class="h-current mr-2"></feather-icon>
                <a href="tel:{{ $scholar->phone_no }}">{{ $scholar->phone_no }}</a>
            </p>

            <div class="mt-4 mb-12">
                <h3 class="font-bold"> Admission Details</h3>
                <div class="flex">
                    <p class="font-semibold"> Category:</p>
                    <p class="ml-2"> {{$categories[$scholar->category] ?? 'not set'}}</p>
                </div>
                <div class="flex">
                    <p class="font-semibold"> Admission via:</p>
                    <p class="ml-2"> {{ $admission_criterias[$scholar->admission_via]['mode'] ?? 'not set'}}</p>
                </div>
            </div>

            {{-- Courseworks --}}
            <div class="mb-16 flex">
                <div class="w-64 pr-4 relative z-10 -ml-8 my-2">
                    <h3 class="relative z-20 pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                        Pre-PhD Coursework
                    </h3>
                    <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                        <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                    </svg>
                </div>
                <div class="flex-1 pl-4">
                    <ul class="border rounded-lg overflow-hidden mb-4">
                        @foreach ($scholar->courseworks as $course)
                            <li class="px-4 py-3 border-b last:border-b-0">
                                <div class="flex items-center">
                                    <div class="w-24">
                                        <span class="px-3 py-1 text-sm font-bold bg-magenta-200 text-magenta-800 rounded-full mr-4">{{ $course->type == 'C' ? 'Core' : 'Elective' }}</span>
                                    </div>
                                    <h5 class="font-bold flex-1">
                                        {{ $course->name }}
                                        <span class="text-sm text-gray-500 font-bold"> ({{ $course->code }}) </span>
                                    </h5>
                                    @if ($course->pivot->completed_at)
                                        <div class="flex items-center pl-4">
                                            <div class="w-5 h-5 inline-flex items-center justify-center bg-green-500 text-white font-extrabold leading-none rounded-full mr-2">&checkmark;</div>
                                            <div>
                                                Completed on {{ $course->pivot->completed_at->format('M d, Y') }}
                                            </div>
                                        </div>
                                    @elsecan('scholars.coursework.complete', $scholar)
                                    <form action="{{ route('research.scholars.courseworks.complete', [$scholar, $course]) }}"
                                        method="POST" class="pl-4 leading-none">
                                        @csrf_token @method("PATCH")
                                        <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm rounded font-bold">
                                            Mark Completed
                                        </button>
                                    </form>
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
                                        <option value="{{$course->id}}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="px-5 btn btn-magenta text-sm rounded-l-none">Add</button>
                            </form>
                        </div>
                    </v-modal>
                    @endcan
                </div>
            </div>

            {{-- Leaves --}}
            <div class="mb-16 flex">
                <div class="w-64 pr-4 relative z-10 -ml-8 my-2">
                    <h3 class="relative z-20 pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                        Leaves
                    </h3>
                    <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                        <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                    </svg>
                </div>
                <div class="flex-1 pl-4">
                    <ul class="w-full border rounded-lg overflow-hidden mb-4">
                        @forelse ($scholar->leaves as $leave)
                        <li class="px-4 py-3 border-b last:border-b-0">
                            <div class="flex items-center">
                                <h5 class="font-bold flex-1">
                                    {{ $leave->reason }}
                                    <span class="text-sm text-gray-500 font-bold">
                                        ({{ $leave->from->format('Y-m-d') }} - {{$leave->to->format('Y-m-d')}})
                                    </span>
                                </h5>
                                <div class="flex items-center px-4">
                                    <div class="
                                        w-5 h-5 inline-flex items-center justify-center
                                        {{ $leave->status === App\LeaveStatus::APPROVED ? 'bg-green-500' : (
                                            $leave->status === App\LeaveStatus::REJECTED ? 'bg-red-600' : 'bg-gray-700'
                                        )}}
                                        text-white font-extrabold leading-none rounded-full mr-2
                                    ">
                                        @if($leave->status == App\LeaveStatus::APPROVED)
                                        &checkmark;
                                        @elseif($leave->status == App\LeaveStatus::REJECTED)
                                        &times;
                                        @else
                                        &HorizontalLine;
                                        @endif
                                    </div>
                                    <div class="capitalize">
                                        {{ $leave->status }}
                                    </div>
                                </div>
                                @if($leave->status === App\LeaveStatus::APPLIED)
                                <button type="submit" class="px-4 py-2 mr-1 bg-green-500 hover:bg-green-600 text-white text-sm rounded font-bold"
                                    form="approve-leave-{{ $leave->id }}-form">
                                    Approve
                                </button>
                                <button type="submit" class="px-4 py-2 ml-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded font-bold"
                                    form="reject-leave-{{ $leave->id }}-form">
                                    Reject
                                </button>
                                <form id="approve-leave-{{ $leave->id }}-form"
                                    action="{{ route('research.scholars.leaves.update', [$scholar, $leave]) }}"
                                    method="POST" class="w-0">
                                    @csrf_token @method("PATCH")
                                    <input type="hidden" name="status" value="{{ App\LeaveStatus::APPROVED }}">
                                </form>
                                <form id="reject-leave-{{ $leave->id }}-form"
                                    action="{{ route('research.scholars.leaves.update', [$scholar, $leave]) }}"
                                    method="POST" class="w-0">
                                    @csrf_token @method("PATCH")
                                    <input type="hidden" name="status" value="{{ App\LeaveStatus::REJECTED }}">
                                </form>
                                @endif
                            </div>
                            @foreach($leave->extensions as $extensionLeave)
                                <div class="flex items-center ml-6 mt-4">
                                    <h5 class="font-bold flex-1">
                                        {{ $extensionLeave->reason }}
                                        <span class="text-sm text-gray-500 font-bold">
                                            (extension till {{$extensionLeave->to->format('Y-m-d')}})
                                        </span>
                                    </h5>
                                    <div class="flex items-center px-4">
                                        <div class="
                                                w-5 h-5 inline-flex items-center justify-center
                                                {{ $extensionLeave->status === App\LeaveStatus::APPROVED ? 'bg-green-500' : (
                                                    $extensionLeave->status === App\LeaveStatus::REJECTED ? 'bg-red-600' : 'bg-gray-700'
                                                )}}
                                                text-white font-extrabold leading-none rounded-full mr-2
                                            ">
                                            @if($extensionLeave->status == App\LeaveStatus::APPROVED)
                                            &checkmark;
                                            @elseif($extensionLeave->status == App\LeaveStatus::REJECTED)
                                            &times;
                                            @else
                                            &HorizontalLine;
                                            @endif
                                        </div>
                                        <div class="capitalize">
                                            {{ $extensionLeave->status }}
                                        </div>
                                    </div>
                                    @if($extensionLeave->status === App\LeaveStatus::APPLIED)
                                    <button type="submit" class="px-4 py-2 mr-1 bg-green-500 hover:bg-green-600 text-white text-sm rounded font-bold"
                                        form="approve-leave-{{ $extensionLeave->id }}-form">
                                        Approve
                                    </button>
                                    <button type="submit" class="px-4 py-2 ml-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded font-bold"
                                        form="reject-leave-{{ $extensionLeave->id }}-form">
                                        Reject
                                    </button>
                                    <form id="approve-leave-{{ $extensionLeave->id }}-form"
                                        action="{{ route('research.scholars.leaves.update', [$scholar, $extensionLeave]) }}" method="POST" class="w-0">
                                        @csrf_token @method("PATCH")
                                        <input type="hidden" name="status" value="{{ App\LeaveStatus::APPROVED }}">
                                    </form>
                                    <form id="reject-leave-{{ $extensionLeave->id }}-form"
                                        action="{{ route('research.scholars.leaves.update', [$scholar, $extensionLeave]) }}" method="POST" class="w-0">
                                        @csrf_token @method("PATCH")
                                        <input type="hidden" name="status" value="{{ App\LeaveStatus::REJECTED }}">
                                    </form>
                                    @endif
                                </div>
                            @endforeach
                        </li>
                        @empty
                        <li class="px-4 py-3 border-b last:border-b-0 text-center text-gray-700 font-bold">No Leaves</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Meetings --}}
            <div class="mb-4 flex">
                <div class="w-64 pr-4 relative z-10 -ml-8 my-2">
                    <h3 class="relative z-20 pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
                        Advisory Meetings
                    </h3>
                    <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
                        <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
                    </svg>
                </div>
                <div class="flex-1 pl-4">
                    <ul class="border rounded-lg overflow-hidden mb-4">
                        @forelse ($scholar->advisoryMeetings as $meeting)
                        <li class="px-4 py-3 border-b last:border-b-0">
                            <div class="flex items-center">
                                <h5 class="font-bold flex-1">
                                    {{ $meeting->date->format('D M d, Y') }}
                                </h5>
                                <a href="{{ route('research.advisory_meetings.minutes_of_meeting', $meeting) }}"
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
        </div>
    </div>
@endsection
