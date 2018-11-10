<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Overtrue\LaravelPinyin\Facades\Pinyin;

class HomeController extends Controller
{
    public function upload(Request $request)
    {
        $files = [];
        foreach ($request->files as $key => $file) {
            $file = $request->file($key)->store('uploads');
            $files[] = Storage::url($file);
        }

        return response()->json(compact('files'));
    }

    public function convert_slug(Request $request)
    {
        $this->validate($request, [
            'text' => [],
            'table' => ['required'],
            'method' => ['in:abbr,permalink']
        ]);

        $text = $request->text;
        $table = $request->table;
        $method = $request->input('method', 'permalink');
        $delimiter = $request->input('delimiter', '');

        $slug = '';
        $i = -1;
        while ($text && empty($slug)) {
            $slug = Pinyin::$method($text, $delimiter);
            if (++$i) {
                $slug .= "$delimiter$i";
            }
            if (DB::table($table)->where('slug', $slug)->exists()) {
                $slug = '';
            }
        }

        return response()->json(compact('slug'));
    }
}
