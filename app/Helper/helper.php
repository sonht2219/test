<?php

use BenSampo\Enum\Enum;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

if (!function_exists("get_meta")) {
    /**
     * @param LengthAwarePaginator $paginate_data
     * @return array
     */
    function get_meta(LengthAwarePaginator $paginate_data)
    {
        $paginate_data->appends(request()->query());

        return [
            'total' => $paginate_data->total(),
            'limit' => (int)$paginate_data->perPage(),
            'current_page' => $paginate_data->currentPage(),
            'last_page' => $paginate_data->lastPage(),
            'next_url' => $paginate_data->nextPageUrl(),
            'prev_url' => $paginate_data->previousPageUrl()
        ];
    }
}

if (!function_exists("str_slug")) {
    function str_slug($str, $white_space = '-')
    {
        $str = Str::slug($str, $white_space);
        return Str::lower($str);
//        $white_space = $white_space ?: '-';
//        $patterns = [
//            'u' => "/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|U)/",
//            'e' => "/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|é|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|E)/",
//            'o' => "/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|O)/",
//            'a' => "/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|A)/",
//            'i' => "/(ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|I)/",
//            'd' => "/(đ|Đ|D)/",
//            'y' => "/(ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ|Y)/",
//            $white_space => "/[\n\r\s\t]+/",
//            '' => "/[^A-Za-z0-9$white_space]|'$/"
//        ];
//        $str = str_replace(" $white_space ", $white_space, $str);
//        foreach ($patterns as $replacement => $pattern)
//            $str = preg_replace($pattern, $replacement, $str);
//        return strtolower($str);
    }
}

if (!function_exists('generate_db_comment')) {
    function generate_db_comment(array $enum_instances) {
        $comment = '';
        foreach ($enum_instances as $enum_instance) {
            $comment .= $enum_instance->value . ': ' . $enum_instance->description . '. ';
        }
        return $comment;
    }
}
