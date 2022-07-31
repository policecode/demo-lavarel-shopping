<?php

namespace App\Trait;

use Illuminate\Support\Facades\Session;

class Cart
{
    private $nameSession = 'cart';
    public function __construct() {

    }
    // Lấy tất cả sản phẩm trong giỏ hàng
    public function getAllCart() {
        return Session::get($this->nameSession);
    }
    // Thêm sản phẩm vào giỏ hàng
    public function addCart($data = []) {
        if (!empty($data['id']) && !empty($data['name']) && !empty($data['qty']) && !empty($data['price']) && !empty($data['options'])) {
            $dataInsert = [
                'id' => $data['id'],
                'name' => $data['name'],
                'qty' => $data['qty'],
                'price' => $data['price'],
                'options' => $data['options']
            ];
            if (Session::has($this->nameSession)) {
                if (is_array(Session::get($this->nameSession)) && !empty(Session::get($this->nameSession)[0])) {
                    Session::push($this->nameSession, $dataInsert);
                }  else {
                    Session::put($this->nameSession, [$dataInsert]);
                }
            } else {
                Session::put($this->nameSession,[$dataInsert]);
            }
        } else {
            dd('Kiểm tra lại dữ liệu');
        }
    }
    // Cập nhật giỏ hàng (thay đổi về số lượng hàng muốn mua)
    public function updateCart($index, $data) {
        $arrCart = $this->getAllCart();
        // Thao tác sửa thông tin của mảng
        foreach ($data as $key => $value) {
            if ($key == 'qty') {
                $arrCart[$index][$key] = $value;
            }
        }
        Session::put($this->nameSession, $arrCart);
    }
    // Xóa sản phẩm khỏi giỏ hàng
    public function deleteCart($index) {
        $arrCart = $this->getAllCart();
        array_splice($arrCart, $index, 1);
        Session::put($this->nameSession, $arrCart);

    }
    // Xóa toàn bộ giỏ Hàng
    public function destroyCart(){
        Session::put($this->nameSession, []);
    }
    // Tổng số tiền 
    public function totalPrice(){
        $arrCart = $this->getAllCart();
        $total = 0;
        if ($arrCart) {
            foreach ($arrCart as  $value) {
                $total += $value['price'] * $value['qty'];
            }
        }
        return $total;
    }
    // Lấy số sản phẩm trong giỏ hàng
    public function getCount() {
        $arrCart = $this->getAllCart();
        if (!empty($arrCart) && is_array($arrCart)) {
            return count($arrCart);
        } else {
            return 0;
        }
    }
}