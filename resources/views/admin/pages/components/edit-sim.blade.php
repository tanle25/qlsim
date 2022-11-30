<form action="{{url('admin/update-sim')}}" method="post" >
    @csrf
    <div id="edit-sim-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <input type="hidden" name="sim_id" id="sim_id">
                <div class="p-6 text-center">

                    <div class="mb-5">
                        <div class="flex mb-5">
                            <div class="mr-2 w-1/2">
                                <input type="text" id="sim-number" name="number" class="input-field" placeholder="{{__('phone')}}">
                            </div>
                            <div class="ml-2 w-1/2">
                                <input type="text" id="iccid" class="input-field" name="iccid" placeholder="iccid">
                            </div>
                        </div>

                        <div class="flex mt-5">
                            <div class="w-1/2">
                                <select name="network" id="network" class="input-field" id="">
                                    @foreach ($networks as $network )
                                    <option value="{{$network->id}}">{{$network->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button data-modal-toggle="edit-sim-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{__('Cancel')}}</button>
                    <button type="submit" class="btn-default">
                        {{__('Update')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
