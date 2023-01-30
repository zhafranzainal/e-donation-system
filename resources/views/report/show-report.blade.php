<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Report Details
        </h2>
    </x-slot>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div style="text-align:center">
        <button type="submit" class="button button-primary" onclick="window.print();">Export to PDF</button>
        </div>
        <br><br>
        
        <h1 class='text-5xl font bold'>    
            Report ID = {{$id}} <br><br>    
        </h1>  
        <div class ="flex">  
            <div class="w-1/2">
            {!! $donationChart->container() !!}
            {!! $donationChart->script() !!}
            </div>
            <div class="w-1/2">
            {!! $applicationAmountChart->container() !!}
            {!! $applicationAmountChart->script() !!}
            </div>
        
        </div>

        <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            Report Table
                            <tr class="px-4 py-3 text-left">
                                <th class="px-4 py-3 text-left">
                                    Report ID
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Total Amount (RM)
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Total Donation (RM)
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
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $list->id?? 'Report ID' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $list->totalAmount?? 'Total Amount' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $list->totalDonation?? 'Total Donation' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $list-> description?? 'Description' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $list->created_at ?? 'Created At' }}
                                </td>
                            </tr>
                            

                        </tbody>
        </table>
    </div>
    
</x-app-layout>
