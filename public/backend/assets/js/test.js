

$.fn.picker = function(option){

    let date = new Date();
    if($(this).val() == ''){
        date = new Date($(this).val());
    }
    let input = $(this);
    let templateId = $(this).attr('id')+'-picker';
    let template = `
    <div id="${templateId}" class="fixed bg-white shadow-lg rounded-xl dark:bg-gray-700 date-picker z-990" >
            <div class="flex divide-x">
                <div id="date-picker-container" class="flex flex-col px-6 pt-5 pb-6 " data-selected="">
                    <div class="flex items-center justify-between">
                        <button class="picker-prev flex items-center justify-center p-2 rounded-xl hover:bg-gray-50">
                            <i class="far fa-arrow-left"></i>
                        </button>
                        <div class="text-sm font-semibold display-day">February</div>
                        <button class="picker-next flex items-center justify-center p-2 rounded-xl hover:bg-gray-50">
                            <i class="far fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="weekdays grid grid-cols-7 text-xs text-center text-gray-900">
                    ${initDays(templateId,option)}
                    </div>
                    <div class="days-months grid grid-cols-7 text-xs text-center text-gray-900">
                    ${initDate()}
                    </div>
                </div>

            </div>

    </div>`;
    $('body').append(template);
    buildMonth( new Date(), option);

    $(this).on('focus',function(){
        let elements =$('.date-picker');
    $.each(elements,function(index, item){
        if($(item).hasClass('fixed')){
            $(item).removeClass('fixed');
            $(item).addClass('hidden');
        }
    })
        let position = $(this).offset();
        $(`#${templateId}.date-picker`).removeClass('hidden').addClass('fixed');
        $(`#${templateId}.date-picker`).css({
            top:position.top+50,
            left:position.left
        });
    })

    $(document).on('click',`#${templateId} .picker-next`, function(){
        let month = Picker.selectedDate.getMonth();
        let next = Picker.selectedDate.setMonth(month+1);

        Picker.selectedDate = new Date(next);
        buildMonth(new Date(next), option);
        buildDates(new Date(next));
    });
    $(document).on('click',`#${templateId} .picker-prev`, function(){

        let month = Picker.selectedDate.getMonth();
        let prev = Picker.selectedDate.setMonth(month-1);
        Picker.selectedDate = new Date(prev) ;
        buildMonth(new Date(prev), option);
        buildDates(new Date(prev));
    });
    $(document).on('click',`#${templateId} .days-months span`, function(){
        // console.log($('.days-months span'));
        let defaultClass = 'flex cursor-pointer dark:text-white hover:text-blue-600 items-center justify-center w-10 h-10 rounded-lg';
        let activeClass = 'flex cursor-pointer dark:text-white items-center justify-center w-10 h-10 text-white bg-blue-600 rounded-full';
        $.each($(`#${templateId} .days-months span`), function (inex, item) {
             if($(item).hasClass('rounded-full')){
                $(item).removeClass().addClass(defaultClass);
             }
        });
        $(this).removeClass().addClass(activeClass);
        $(input).val($(this).data('date'))
        $(`#${templateId}.date-picker`).removeClass('fixed').addClass('hidden');

    });
    function hide()
    {
        $(`#${templateId}.date-picker`).removeClass('fixed');
        $(`#${templateId}.date-picker`).addClass('hidden');
    }
}

function buildMonth(date, option){


    var localmonts =[
            'Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'
        ]
        // if(option.hasOwnProperty('months') && option.months != null){
        //     localmonts = option.months;
        // }
        let month = date.getMonth();
        $('.display-day').text(option.months[month] + ' - '+ date.getFullYear());
}


function initDays(templateId, option){
    var localdays =[
        'Mo','Tu','We','Th','Fri','Sa','Su'
    ]
    // var option = Picker.option;
    // console.log(option);

    // if(option.hasOwnProperty('days') && option.days != null){
    //     localdays = option.days;
    // }
    let item = '';
    $.each(option.days, function (index, value) {
        item += `<span class="flex cursor-pointer dark:text-white items-center justify-center w-10 h-10 font-semibold rounded-lg">
                        ${value}
                    </span>`;
         $(`#${templateId} .weekdays`).append(item);
        //  weekdays
    });
    return item;
}
function initDate(){
    let date = new Date();
    Picker.selectedDate = date;
    let item = '';
    let day = 0;
        for (let index = 1; index <= 35; index++) {
            let next = new Date(Date.UTC(date.getFullYear(), date.getMonth(), day) );
            next.setDate(next.getDate()+1);
            day ++;
            if(day == date.getDate()){
                item += `<span class="flex cursor-pointer dark:text-white items-center justify-center w-10 h-10 text-white bg-blue-600 rounded-full" data-date="${new Intl.DateTimeFormat('vi-VN').format(next)}">
                    ${next.getDate()}
                        </span>`;
            }else{
                item += `<span class="flex cursor-pointer dark:text-white hover:text-blue-600 items-center justify-center w-10 h-10 rounded-lg" data-date="${new Intl.DateTimeFormat('vi-VN').format(next)}">
                            ${next.getDate()}
                        </span>`;
            }
        }
    return item;
}
