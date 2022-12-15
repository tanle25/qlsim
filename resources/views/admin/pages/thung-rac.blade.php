@extends('admin.layout.app')

@section('content')
<div class="absolute right-0 w-auto z-50">

    @include('admin.pages.components.errors')

</div>
<div class="-mx-4 sm:-mx-8 py-4 overflow-x-auto px-4">
    <div class="inline-block w-full shadow-md rounded-lg overflow-hidden pb-5">
        <table id="product-table" class="w-full leading-normal dark:text-gray-400">
            <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th>
                        {{__('phone')}}
                    </th>
                    <th>
                        {{__('ICCID')}}
                    </th>
                    <th>
                        {{__('Created at')}}
                    </th>
                    <th>
                        {{__('Ngày xoá')}}
                    </th>
                    <th class="nosort"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sims as $sim )
                <tr>
                    <td>
                        <div class="ml-3">
                            <p class="text-color whitespace-no-wrap">
                                {{$sim->phone}}
                            </p>
                        </div>
                    </td>
                    <td>
                        <p class="text-color whitespace-no-wrap">{{$sim->iccid}}</p>
                    </td>


                    <td>
                        <p class="text-color whitespace-no-wrap">{{$sim->created_at->format('d-m-Y')}}</p>
                    </td>
                    <td>
                        <p class="text-color whitespace-no-wrap">{{$sim->deleted_at->format('d-m-Y')}}</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                        <a title="Khôi phục" href="{{url('admin/khoi-phuc-sim-da-xoa',$sim->id)}}" class="view-change inline-block text-gray-500 hover:text-green-500 mx-2" data-index="{{$loop->index}}">
                            <svg fill="currentColor" stroke="currentColor" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 1000 1000" xml:space="preserve">
                                <g><path  d="M919.9,990c-40.6-218.8-228.5-384.3-454.6-384.3c-5.9,0-11.4,0-17.1,0v205.2c1.2,10.3-1.6,21-9.4,28.9c-0.1,0.1-0.2,0.1-0.3,0.2c-6.2,6.6-14.9,10.8-24.6,10.8c-10.7,0-19.8-5.3-26.1-13.1l-340.3-381c-7.3-7.3-10.3-17.1-9.8-26.7c-0.5-9.6,2.6-19.3,9.8-26.7L389.5,20.3c13.6-13.7,35.6-13.7,49.1,0c7.8,7.9,10.6,18.6,9.4,28.9v206.3c284.1,0,514.4,235.2,514.4,525.2C962.5,855.2,947.2,925.9,919.9,990z M500.5,325.6c-17.8-0.6-35.2-2.3-52.4,0h-68.6v-35v-35V136.4L117.1,430.1l262.3,293.7V605.7v-35v-35h68.6c37.3,0,46.2-1,68.6,0C659.5,542.2,820,648.9,894,745.8C892.9,614.2,742.5,333.2,500.5,325.6z"/></g>
                                </svg>
                            </a>
                        <a title="Xoá vĩnh viễn" href="{{url('admin/xoa-vinh-vien-sim', $sim->id)}}" class="inline-block text-gray-500 hover:text-red-400 mx-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
