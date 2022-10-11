<?php

use Carbon\Carbon;

if (! function_exists('getIcon')) {
    function getIcon($item)
    {
        // return Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
        $url = isset($item['url']) ? $item['url'] : null;
        $icon = isset($item['icon']) ? $item['icon'] : null;
        $active = isset($item['active_icon']) ? $item['active_icon'] : null;

        if($url != null && request()->is($item['url'])){
            return $active ? $active : $icon;
        }else{
            return $icon;
        }

    }
}

if(!function_exists('diffDateTime')){
    function diffDateTime(string $date){
        $d1 = Carbon::parse($date);
        $d2 = Carbon::now();
        $compase = $d1->diff($d2);
        // return $compase;
        if($compase->days > 0){
            if($compase->days <= 7){
                return __(':day days ago',['day'=>$compase->d]);
            }else{
                return $d1->format('d/m/Y');
            }

        }else{
            return __(':hour Hours :minus minutes ago',['hour'=>$compase->h, 'minus'=>$compase->i]);
        }

    }
}
