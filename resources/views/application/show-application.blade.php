<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Application
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="block w-full overflow-auto scrolling-touch">
                        
                        <div class="mt-4">
                            <x-jet-label for="student_id" value="{{ __('Student ID') }}" />
                            <x-jet-input id="amount" class="block mt-1 w-full" type="number" name="student_id" value="{{old('student_id', $applications->student_id)}}" disabled />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="id" value="{{ __('Application ID') }}" />
                            <x-jet-input id="amount" class="block mt-1 w-full" type="number" name="id" value="{{old('id', $applications->id)}}" disabled />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="amount" value="{{ __('Amount') }}" />
                            <x-jet-input id="amount" class="block mt-1 w-full" type="number" name="amount" value="{{old('amount', $applications->amount)}}" disabled />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="reason" value="{{ __('Reason') }}" />
                            <x-jet-input id="amount" class="block mt-1 w-full" type="text" name="reason" value="{{old('reason', $applications->reason)}}" disabled />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="status" value="{{ __('Application Status') }}" />
                            <x-jet-input id="amount" class="block mt-1 w-full" type="text" name="status" value="{{old('status', $applications->status)}}" disabled />
                        </div>
                        

                        <div class="flex items-center justify-end mt-4">

                        </div>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
