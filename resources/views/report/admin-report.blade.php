<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Report Index
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{asset('public')}}/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
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
<!-- To create the chart for the index page-->

<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
    <div id="container"></div>
    var totalApplication=; //to be edited
    Highcharts.chart('container', {
    data: {
        table: 'totalApplication'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Live births in Norway'
    },
    subtitle: {
        text:
            'Source: <a href="https://www.ssb.no/en/statbank/table/04231" target="_blank">SSB</a>'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Amount'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    }
});


</script> -->
<!-- Create Chart -->
<div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Area Chart Example
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Bar Chart Example
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
	var _ydata=JSON.parse('{!! json_encode($months) !!}');
	var _xdata=JSON.parse('{!! json_encode($monthCount) !!}');
</script>
<script src="{{asset('public')}}/assets/demo/chart-area-demo.js"></script>
<script src="{{asset('public')}}/assets/demo/chart-bar-demo.js"></script>


<!--Report Table-->
                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
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
                                    {{ $application-> totalApplication?? 'Total Amount' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $report-> updated_at?? 'Total Donation' }}
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
