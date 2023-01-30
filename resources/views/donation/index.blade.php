<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Donation List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-8 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text name="search" value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}" autocomplete="off"></x-inputs.text>

                                    <div class="ml-1">
                                        <button type="submit" class="button button-primary">
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Donation::class)
                                <a href="{{ route('donations.create') }}" class="button button-primary">
                                    <i class="mr-1 icon ion-md-add"></i>
                                    @lang('crud.common.create')
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr class="px-4 py-3 text-left">
                                <th class="px-4 py-3 text-left">
                                    Donation ID
                                </th>
                                <th class="px-4 py-3 text-left">
                                    User ID
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Amount
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Status
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Operation
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @foreach ($donations as $donation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">
                                        {{ $donation->id ?? 'Donation ID' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $donation->user_id ?? 'User ID' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $donation->amount ?? 'Amount' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $donation->status ?? 'Status' }}
                                    </td>
                                    <td class="px-2 py-3 text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions"
                                            class="
                                            relative
                                            inline-flex
                                            align-left
                                        ">
                                            @can('update', $donation)
                                                <a href="{{ route('donations.edit', $donation['id']) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('view', $donation)
                                                <a href="{{ route('donations.show', $donation) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('delete', $donation)
                                                <form action="{{ route('donations.destroy', $donation) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="button">
                                                        <i
                                                            class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </x-partials.card>
        </div>
    </div>

</x-app-layout>
