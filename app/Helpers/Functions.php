<?php
use Illuminate\Support\Facades\DB;


function loadOptions($list, $parentId = 0, $text = '', $id=0) {
    foreach ($list as $value) {
        if ($value->parent_id == $parentId) {
            $selected = $value->id==$id?'selected':false;
            echo '<option value="'.$value->id.'" '.$selected.'>'.$text.$value->name.'</option>';
            loadOptions($list, $value->id, $text.'--', $id);
        }
    }
}

function loadListCategory ($list, $parentId = 0, $text = '', &$listCategory = []){
    foreach ($list as $value) {
        if ($value->parent_id == $parentId) {
            $listCategory[] = [
                'id' => $value->id,
                'name' => $text.$value->name,
                'icon' => $value->icon,
                'created_at' => $value->created_at
            ];
            loadListCategory($list, $value->id, $text.'--- ', $listCategory);
        }
        
    }
}

function selectedTag($listProductTag, $idTag) {
    foreach ($listProductTag as $value) {
        if ($value->tag_id == $idTag) {
            return 'selected';
        }
    }
}

function renderArrImagePath($collectImagePathList) {
    $arr = [];
    foreach ($collectImagePathList as $item) {
        $arr[] = [$item->image_path][0];
    }
    return $arr;
}

function getOptionSetting($key, $column = 'opt_key') {
    $item = DB::table('settings')
    ->where('opt_key', $key)
    ->first();
    if (empty($item)) {
        return false;
    }
    if ($column == 'opt_value') {
        return json_decode($item->$column, true);
    }
    return $item->$column;
}

// Xử lý việc phân trang
function handlePagination($totalRow, $currentPage, $limit = 10) {
    /**
     * - totalRow: Tổng số bản ghi
     * - currentPage: Trang hiện tại trên trình duyệt
     * - limit: Số lượng bản ghi lấy ra
     * - startPage: Vị trí bắt đầu lấy bản ghi
     * - pageNumber: Số lượng trang để chứa limit bản ghi
     */
    $startPage = ($currentPage - 1)*$limit;
    $pageNumber = (int)ceil($totalRow/$limit);
    return [
        'startPage' => $startPage,
        'pageNumber' => $pageNumber,
         'limit' => $limit
    ];
}
// Xử lý việc render trang ra màn hình
function handleRenderPagination($currentPage, $pageNumber){
    /**
     * - prev: Nút lùi lại 1 trang của paging
     * - next: Nút tiến thêm 1 trang của paging
     * - start: stt trang bắt đầu
     * - end: stt trang kết thúc
     */
    $prev = $currentPage - 1;
    $next = $currentPage + 1;
    $start = $currentPage - 4;
    $end = $currentPage + 4;
    
    if ($start < 1) {
        $start = 1;
    }
    if ($end > $pageNumber) {
        $end = $pageNumber;
    }
    return [
        'start' => $start,
        'end' => $end,
        'prev' => $prev,
        'next' => $next,
        'currentPage' => $currentPage,
        'pageNumber' => $pageNumber
    ];
}

// Xử lý tạo url phần paging
function handleUrlPaging($queryArr = [], $pageIndex) {
    $url = '?_page='.$pageIndex;
    if (!empty($queryArr)) {
        foreach ($queryArr as $key => $value) {
            if ($key != '_page' && $value != null ) {
                $url = $url.'&'.$key.'='.$value;
            }
        }
    }
    return $url;
}

// load slider
function loadSlider() {
    $item = DB::table('sliders')
    ->get();
    return $item;
}
