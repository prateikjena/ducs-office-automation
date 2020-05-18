<div class="page-card p-6 overflow-visible flex space-x-6">
    <div class="w-64 pr-4 relative -ml-8 my-6">
        <h3 class="relative pl-8 pr-4 py-2 font-bold bg-magenta-700 text-white shadow">
            Examiner
        </h3>
        <svg class="absolute left-0 w-2 text-magenta-900" viewBox="0 0 10 10">
            <path fill="currentColor" d="M0 0 L10 0 L10 10 L0 0"></path>
        </svg>
        @can('applyForExaminer', $scholar)
        <div class="mt-3 text-right">
            <form action="{{ route('scholars.examiner.apply', $scholar) }}" method="POST">
                @method('PATCH') @csrf_token
                <button type="submt" class="btn btn-magenta is-sm">
                    Request
                </button>
            </form>
        </div>
        @endcan
    </div>
    <div class="flex-1 my-4 ">
        <div class="flex items-center px-4 py-3 border rounded-lg">
            @if ($scholar->examiner_status === null)
                <p class="px-4 text-center text-gray-700 flex ml-auto font-bold">Not Applied</p>
            @endif
            @if($scholar->examiner_applied_on)
                <div class="text-center">
                    <h3 class="font-bold">Applid On </h3>
                    <h3 class="text-gray-800 mt-1"> {{$scholar->examiner_applied_on->format('d F, Y')}}</h3>
                </div>
            @endif
            @if($scholar->examiner_recommended_on)
            <div class="ml-8 text-center">
                <h3 class="font-bold">Recommended On </h3>
                <h3 class="text-gray-800 mt-1"> {{$scholar->examiner_recommended_on->format('d F, Y')}}</h3>
            </div>
            @endif
            @if($scholar->examiner_approved_on)
                <div class="ml-8 text-center">
                    <h3 class="font-bold">Approved On </h3>
                    <h3 class="text-gray-800 mt-1"> {{$scholar->examiner_approved_on->format('d F, Y')}}</h3>
                </div>
            @endif
            <div class="flex ml-auto items-baseline">
                @if($scholar->examiner_status)
                <div class="flex">
                    <p class="px-3 py-1 text-center flex items-center font-lg font-bold border border-4 border-solid rounded-full
                        {{ $scholar->examiner_status->getContextCSS()}}">
                        {{ $scholar->examiner_status}}
                    </p>
                </div>
                @else

                @endif
                <div class="flex ml-2">
                    @can('recommendExaminer', $scholar)
                    <form action="{{ route('scholars.examiner.recommend', $scholar) }}" method="POST" 
                        class="px-4 py-2 mr-1 bg-blue-500 hover:bg-blue-600 text-white rounded font-bold">
                        @method('PATCH') @csrf_token
                        <button type="submit"> 
                            Recommend
                        </button>
                    </form>
                    @endcan
                    @can('approveExaminer', $scholar)    
                    <form action="{{ route('scholars.examiner.approve', $scholar) }}" method="POST" 
                        class="px-4 py-2 mr-1 bg-green-500 hover:bg-green-600 text-white rounded font-bold">
                        @method('PATCH') @csrf_token
                        <button type="submit"> 
                            Approve
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>               