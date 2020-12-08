<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class DiggingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        $eloquentCollection = BlogPost::withTrashed()->get();
        //dd(__METHOD__, $eloquentCollection);

        $collection = collect($eloquentCollection->toArray());

        $result['where']['data'] = $collection
            ->where('user_id', '=', '1')
            ->values()
            ->keyBy('id');

        // Получить экземпляр коллекции с свойством 'items', который является массивом
        // содержащим массивы данных постов у которых created_at больше
        // этой даты: 2020-09-10 00:00:00
        $result['where_first'] = $collection
            ->where('created_at', '>', '2020-09-10 00:00:00');
        dd($result);
    }
}
