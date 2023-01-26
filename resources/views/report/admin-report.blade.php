<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Report Index
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{asset('public')}}/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <script src="https://cdn.tailwindcss.com"></script>
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
                            @can('create', App\Models\Report::class)
                            <a
                                href="{{ route('reports.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div> 
                    </div>
                </div> 
                    <div class="flex">
                        <div class="w-1/2">
                        {!! $chart->container() !!}
                        {!! $chart->script() !!}
                        </div>
                    </div>
                    
<!--Report Table-->
                <div class="block w-full overflow-auto scrolling-touch">
                <button type="submit" class="button button-primary" onclick="window.print();">Export to PDF</button><br><br>
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            Total Application made : {{$totalApplication}}
                            <tr class="px-4 py-3 text-left">
                                <th class="px-4 py-3 text-left">
                                    Report ID
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Total Amount
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Total Donation
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Description
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Created At
                                </th>
                            </tr>
                        </thead>
                        
                        <tbody class="text-gray-600">
                            
                            
                        @foreach($reports as $report)
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $report->id?? 'Report ID' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $report->totalAmount?? 'Total Amount' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $report->totalDonation?? 'Total Donation' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $report-> description?? 'Description' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $report->created_at ?? 'Created At' }}
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
                                        @can('update', $report)
                                            
                                            <a
                                                href="{{ route('reports.edit', $report) }}"
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
                                        
                                        @can('view', $report)
                                        <a
                                            href="{{ route('reports.show', $report) }}"
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
                                        @can('delete', $report)
                                        <form
                                            action="{{ route('reports.destroy', $report) }}"
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
                                        
                                        
                                    </div>
                                </td>
                            </tr>
                            
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <div class="mt-10 px-4">
                                        {!! $reports->render() !!}
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
