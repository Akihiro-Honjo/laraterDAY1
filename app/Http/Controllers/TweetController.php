<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //一覧画面を表示する処理
         $tweets = Tweet::with('user')->latest()->get(); //Tweet 大文字で始まる  with('user')userの情報を取る latest()新しい順 getでデータを取る
         return view('tweets.index', compact('tweets'));  //tweet.indexの画面を表示 compact('変数名を文字列で,で複数も可')
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
             //作成画面を表示する処理
             return view('tweets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'tweet' => 'required|max:255',
          ]);
  
           // ディレクトリ名
           $dir = 'sample';
           // sampleディレクトリに画像を保存
           $path = $request->file('image_file')->store('public/' . $dir);
           $url=str_replace('public','storage',$path);
           // $request->merge(['image' => $path]);
           //ddd($request);
           //テーブルにデータを保存する処理
           $res = $request->user()->tweets()->create($request->merge(['image' => $url])->all());
           //ddd($res);
           return redirect()->route('tweets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
        //詳細画面を表示
        return view('tweets.show', compact('tweet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet)
    {
        //更新画面の表示
        return view('tweets.edit', compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet)
    {
        //更新処理
        $request->validate([
            'tweet' => 'required|max:255',
          ]);
      
          $tweet->update($request->only('tweet'));
      
          return redirect()->route('tweets.show', $tweet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
    {
        //削除処理
        $tweet->delete();

        return redirect()->route('tweets.index');
    }
}
