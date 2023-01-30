<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New Application
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="block w-full overflow-auto scrolling-touch">
                    <form action="{{ route('applications.store') }}" method="POST">
                    @csrf
                        <div class="mt-4">
                            <x-jet-label for="amount" value="{{ __('Amount') }}" />
                            <x-jet-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="reason" value="{{ __('Reason') }}" />
                                <select name="reason" class ="mt-1 block w-full border-grey-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option value="tuition">Tuition</option>
                                    <option value="hostel">Hostel</option>
                                    <option value="convocation">Convocation</option>
                                    <option value="course">Course</option>
                                    <option value="muet">Muet</option>
                                </select>
                            <x-jet-input-error for="reason" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-jet-button class="ml-4">
                                {{ __('Apply') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
