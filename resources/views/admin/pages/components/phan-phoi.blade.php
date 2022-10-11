<div id="distribution" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <div class="p-6 text-center">

                <div class="mb-5">

                    <div class="flex mt-5">

                        <div class="ml-2 w-full">
                            <span class="dark:text-white font-medium">Chọn nhà phân phối hoặc cộng tác viên</span>
                            <select name="partner" class="input-field" id="">
                                @foreach ($partners as $partner)
                                <option value="{{$partner->id}}">{{$partner->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>


                <button data-modal-toggle="distribution" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{__('Cancel')}}</button>
                <button type="submit" class="btn-default">
                    {{__('Add')}}
                </button>
            </div>
        </div>
    </div>
</div>
