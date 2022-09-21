<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        return [
            'status' => 'success',
            'Menu' => Menu::all()
        ];
    }

    public function postMenu(Request $request)
    {
        try {
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->parent_id = $request->parent_id;
            $menu->link = $request->link;
            $menu->save();
            return [
                'status' => 'success',
                'menu' => Menu::all()
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 'errors',
            ];
        }
    }

    public function putMenu(Request $request)
    {
        try {
            $menu = Menu::find($request->id);
            $menu->name = $request->name;
            $menu->parent_id = $request->parent_id;
            $menu->link = $request->link;
            $menu->save();
            return [
                'status' => 'success',
                'menu' => Menu::all()
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 'errors',
            ];
        }
    }

    public function deleteMenu(Request $request)
    {
        try {
            $menu = Menu::find($request->id);
            $menu->delete();
            return [
                'status' => 'success',
                'menu' => Menu::all()
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 'errors',
            ];
        }
    }
}
