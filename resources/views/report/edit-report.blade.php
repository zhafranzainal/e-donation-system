<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Report
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="block w-full overflow-auto scrolling-touch">
                    <form action="{{ route('reports.update', $reports) }}" method="POST" >
                    @csrf
                    @method('PUT')
                        <div class="mt-4">
                            <x-jet-label for="totalAmount" value="{{ __('Total Amount') }}" />
                            <x-jet-input id="totalAmount" class="block mt-1 w-full" type="number" name="totalAmount" :value="old('totalAmount')" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="totalDonation" value="{{ __('Total Donation') }}" />
                            <x-jet-input id="totalDonation" class="block mt-1 w-full" type="number" name="totalDonation" :value="old('totalAmount')" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <textarea id="description" class="form-input rounded-md shadow-sm mt-1 block w-full" name="description" required>{{ old('description') }}</textarea>
                            <x-jet-input-error for="description" class="mt-2" />
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
