<?php

namespace App\Http\Controllers;

use App\URLShort;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UrlController extends Controller
{

    public function index()
    {

        $urls = URLShort::orderByDesc('created_at')->paginate(10);
        $count = URLShort::count('url');
        $t_visited = URLShort::sum('visited');

        return view('create',compact('urls', 'count', 't_visited'));

    }

    public function short(Request $request){
        if(in_array($request->get('status'), ['never','60','120']))
        {
            $short = $this->validate($request, [
                'url'=> 'required|url'
            ]);
            $short = $this->generateShortURL();

            if(in_array($request->get('status'), ['never'])){
                $one_minute = NULL;

            };
            if(in_array($request->get('status'), ['60'])){
            $one_minute = (new Carbon('+5 hours'))->addMinute()->timestamp;

            };
            if(in_array($request->get('status'), ['120'])){
                $one_minute = (new Carbon('+5 hours'))->addMinutes(2)->timestamp;

            };

            $minutes  = $one_minute;

            URLShort::create([
                'url' => $request->url,
                'short' => $short,
                'ex_time' => $minutes
            ]);
            return redirect()->back();

        }
        return redirect()->back();
    }

    public function shortLink(URLShort $short, $link){
        $minute = URLShort::where('short' , $link)
            ->get()->first();

        if($minute->ex_time != null && $minute->ex_time < time() + 5*3600) {

            return "sorry";
        }else{
            $url = URLShort::whereShort($link)->first();
            $url->increment('visited');
            $url->visited += 1;
            return redirect($url->url);
        }
    }

    public function generateShortURL(){
        $result = base_convert(rand(1000, 99999), 10, 36);

        $data = URLShort::whereShort($result)->first();

        if ($data != null){
            $this->generateShortURL();
        }
        return $result;
    }
}
