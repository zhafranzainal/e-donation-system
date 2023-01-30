<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Donation
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form action="{{ route('donations.update') }}"method="POST">
                                @csrf
                                <div class="mt-4">
                                    <x-jet-label for="amount" value="{{ __('amount') }}" />
                                    <x-jet-input id="amount" class="block mt-1 w-full" type="text"
                                        name="amount" />
                                </div>

                                <button type="submit" class="button button-primary">
                                    <i class="icon ion-md-save"></i>
                                </button>
                        </div>
                        </form>
                    </div>
                </div>
        </div>

        <div class="block w-full overflow-auto scrolling-touch">
            <table class="w-full max-w-full mb-4 bg-transparent">
                <thead class="text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">
                            @lang('crud.roles.inputs.name')
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <div class="mt-10 px-4">
                                {{-- {!! $roles->render() !!} --}}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        </x-partials.card>
    </div>
    </div>
</x-app-layout>
