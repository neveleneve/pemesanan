<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function checkQty($data)
    {
        $checkVal = count($data);
        foreach ($data as  $value) {
            if ($value == 0) {
                $checkVal--;
            }
        }

        if ($checkVal <= 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getGrandTotal($data)
    {
        $total = 0;
        foreach ($data as  $value) {
            $menu = Menu::find($value['id']);
            $total += $menu->harga * $value['qty'];
        }
        return $total;
    }
}
