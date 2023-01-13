<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Application
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="block w-full overflow-auto scrolling-touch">
                    <form>
                        <div>
                            <x-jet-label for="student_id" value="{{ __('Student ID') }}" />
                            <x-jet-input id="student_id" type="text" class="mt-1 block w-half" wire:model.defer="state.student_id" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="amount" value="{{ __('Amount') }}" />
                            <x-jet-input id="amount" type="text" class="mt-1 block w-half" autocomplete="amount" />
                            <x-jet-input-error for="amount" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="reason" value="{{ __('Reason') }}" />
                            <select name="reason">
                                <option value="tuition">Tuition</option>
                                <option value="hostel">Hostel</option>
                                <option value="convocation">Convocation</option>
                                <option value="course">Course</option>
                                <option value="muet">Muet</option>
                            </select>
                            <x-jet-input-error for="reason" class="mt-2" />
                        </div>
                    </form>

                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
