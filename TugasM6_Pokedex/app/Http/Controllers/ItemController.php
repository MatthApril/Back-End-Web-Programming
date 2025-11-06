<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index($type){
        require public_path('data_tugas.php');

        $type = ucfirst($type);

        if ($type != 'All') {
            $items = array_filter($items, fn($item) => $item['category'] == $type);
            $items = array_values($items);
        }

        return view('pages.items.index', ['items' => $items]);
    }

    public function show($id){
        require public_path('data_tugas.php');

        $item = array_filter($items, fn($item) => $item['id'] == $id);
        $item = array_values($item)[0];

        return view('pages.items.show', ['item' => $item]);
    }
}
