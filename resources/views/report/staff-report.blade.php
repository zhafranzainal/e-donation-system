<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Staff Report Index
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
                    </div>
                </div> 
        <div style="text-align:center">
            <button type="submit" class="button button-primary" onclick="window.print();">Export to PDF</button>
        </div>
<!--Report Table-->
                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr class="px-4 py-3 text-left">
                                <th class="px-4 py-3 text-left">
                                    Student ID
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Student Name
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Total Amount
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Total Application Apply
                                </th>
                            </tr>
                        </thead>
                        
                        <tbody class="text-gray-600">
                            
                            
                        @foreach($lists as $list)
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $list->student_id?? 'Student ID' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $list->matric_no?? 'Student Name' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $list->total?? 'Total Amount' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $list->totalApplication?? 'Total Application Apply' }}
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
