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
        <div class ="container1">
        <h1>    
            Total Application
            
            {!! $chart->container() !!}
            {!! $chart->script() !!}
        </h1>
        </div>
    </div>
    
</x-app-layout>
