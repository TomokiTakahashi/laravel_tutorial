<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;



class BlogController extends Controller
{
  
    /**
     * ブログ一覧を表示する
     * @return view
     */
    public function showList()
    {
        $blogs=Blog::all();

        return view("blog.list",
        ["blogs"=>$blogs]);
    }

     /**
     * 
     * ブログ詳細を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $blog=Blog::find($id);

        if(is_null($blog)){
            \Session::flash("err_msg","データがありません");
            return redirect(route("blogs"));
        }

        return view("blog.detail",
        ["blog"=>$blog]);
    }

     /**
     * 
     * ブログの登録画面を表示する
     * @return view
     */
    public function showCreate()
    {
        return view("blog.form");
    }

     /**
     * 
     * ブログの登録の処理
     * @return view
     */
    public function exeStore(BlogRequest $request)
    {
        //データを受け取る
        $inputs=($request->all());

        try {
            //ブログを登録
            Blog::create($inputs);
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
        
        \Session::flash("err_msg","ブログを登録しました");
        return redirect(route("blogs"));
    }

      /**
     * 
     * ブログ編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $blog=Blog::find($id);

        if(is_null($blog)){
            \Session::flash("err_msg","データがありません");
            return redirect(route("blogs"));
        }

        return view("blog.edit",
        ["blog"=>$blog]);
    }

     /**
     * 
     * ブログの更新の処理
     * @return view
     */
    public function exeUpdate(BlogRequest $request)
    {
        //データを受け取る
        $inputs=($request->all());

        \DB::beginTransaction();
        try {
            //ブログを編集
            $blog=Blog::find($inputs["id"]);
            $blog->fill([
                "title"=>$inputs["title"],
                "content"=>$inputs["content"]
            ]);
            $blog->save();
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
        
        \Session::flash("err_msg","ブログを更新しました");
        return redirect(route("blogs"));
    }

      /**
     * 
     * ブログ編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        if(empty($id)){
            \Session::flash("err_msg","データがありません");
            return redirect(route("blogs"));
        }

        try {
            //ブログを削除
            $blog=Blog::destroy($id);
        } catch(\Throwable $e){
            abort(500);
        }

        \Session::flash("err_msg","ブログを削除しました");
        return redirect(route("blogs"));
    }


}
