<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Application List
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
                            @can('create', App\Models\Application::class)
                            <a
                                href="{{ route('applications.create') }}"
                                class="button button-primary"
                            >
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
                                    Student ID
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Amount
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Reason
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Status
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Approved at
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @foreach($applications as $application)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $application->student_id ?? 'Student ID' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $application->amount ?? 'Amount' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $application->reason ?? 'Reason' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $application->status ?? 'Status' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $application->approved_at ?? '' }}
                                </td>
                        
                                <td
                                    class="px-2 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-left
                                        "
                                    >
                                        @if($application->status=='pending')
                                            @can('update', $applications)
                                            <a
                                                href="{{ route('applications.edit', $application) }}"
                                                class="mr-1"
                                            >
                                                <button
                                                    type="button"
                                                    class="button"
                                                >
                                                    <i
                                                        class="icon ion-md-create text-blue-600"
                                                    ></i>
                                                </button>
                                            </a>
                                            @endcan  
                                        @endif
                                        @can('view', $application)
                                        <a
                                            href="{{ route('applications.show', $application) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan 
                                        @can('delete', $application)
                                        <form
                                            action="{{ route('applications.destroy', $application) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                            class="mr-1"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i class="icon ion-md-trash text-red-600"></i>
                                            </button>
                                        </form>
                                        @endcan 
                                        @if($application->status=='pending')
                                            @can('approve', $application)
                                            <form
                                                action="{{ route('applications.approve', $application) }}"
                                                method="POST"
                                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                                class="mr-1"
                                            >
                                                @csrf @method('PUT')
                                                <button
                                                    type="submit"
                                                    class="button"
                                                >
                                                    <i
                                                        class="
                                                            icon
                                                            ion-md-checkmark
                                                            text-green-600
                                                        "
                                                    ></i>
                                                </button>
                                            </form>
                                            @endcan
                                            @can('reject', $application)
                                            <form
                                                action="{{ route('applications.reject', $application) }}"
                                                method="POST"
                                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                                class="mr-1"
                                            >
                                                @csrf @method('PUT')
                                                <button
                                                    type="submit"
                                                    class="button"
                                                >
                                                    <i
                                                        class="
                                                            icon
                                                            ion-md-close
                                                            text-red-600
                                                        "
                                                    ></i>
                                                </button>
                                            </form>
                                            @endcan
                                        @endif
                                        @if($application->status=='approved')
                                        @can('payment', $applications)
                                            <a
                                                href="{{ route('applications.createFee', $application) }}"
                                                class="mr-1"
                                                method="PUT"
                                            >
                                                <button
                                                    type="button"
                                                    class="button"
                                                >
                                                    <i
                                                        class="icon ion-md-cash text-green-600"
                                                    ></i>
                                                </button>
                                            </a>
                                            @endcan  
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <div class="mt-10 px-4">
                                        {!! $applications->render() !!}
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
