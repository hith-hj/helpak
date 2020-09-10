<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Chat;
use App\Likes;
use App\Redos;
use App\Comments;
use App\Message;
use App\Report;
use App\Ask;
use DB;
class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
    }

    public function posts(Content $cont)
    {
        // $cont = new Content();
        $posts = Post::all();                
        return $cont->title('Posts')
                    ->description('Here you can check Users posts ')
                    ->body(view('admin.posts.postsIndex',compact('posts')));
    }

    public function postCreate (Content $cont)
    {
        return $cont->title('New Post')
                        ->description('Post Created Here will be under Helpak name')
                        ->body(view('admin.posts.postcreate'));
    }

    public function postStore(Content $cont , Request $req){
        dd($req->all());
    }

    public function postShow(Content $cont ,$id)
    {
        $post = Post::find($id);
        if($post !== null)
        {
            $post->likes = Likes::all()->where('post_id',$post->id)->sortByDesc('created_at');
            foreach ($post->likes as $like)
            {
                $like["user_info"] = User::find($like->user_id);
            }
            $post->redos = Redos::all()->where('post_id',$post->id)->sortByDesc('created_at');
            foreach ($post->redos as $redo)
            {
                $redo["user_info"] = User::find($redo->redo_user_id);
            } 
            $post->comments =  Comments::all()->where('post_id',$post->id)->sortByDesc('created_at')->take(1);
            foreach ($post->comments as $com)
            {
                $com["user_info"] = User::find($com->user_id);
            }
            $post->asks =  Ask::all()->where('post_id',$post->id)->sortByDesc('created_at');
            foreach($post->asks as $ask)
            {
                $ask["user_info"] = User::find($ask->sender_id);
            }
            return $cont->title('Post Details')
                        ->description('Here you can check any details about this post ')
                        ->body(view('admin.posts.postShow',compact('post')));
        } else {
            $post = null;
            return $cont->title('Post is Deleted')
                        ->description('it is seems like someone deleted the Post')
                        ->body(view('admin.posts.postShow',compact('post')));
        }
    }

    public function postDelete(Content $cont ,$id)
    {
        $post = Post::find($id);
        if($post !== null)
        {
            $likes = DB::table('likes')->where('post_id',$post->id);
            $likes->delete();
            $comments = DB::table('comments')->where('post_id',$post->id);
            $comments->delete();
            $redos = DB::table('redos')->where('post_id',$post->id);
            $redos->delete();
            $asks = DB::table('asks')->where('post_id',$post->id);
            $asks->delete();
            $post->delete();
        } else {
            // $this->posts();
            return back();
        }
        
    }

    public function donate(){
        return $cont->title('new Funding')
                    ->description('create new funding post')
                    ->body(view('admin.posts.donate'));
    }
    
    public function users(Content $cont){
        $users = User::all();
        return $cont->title('Users')
                        ->description('Users details list ')
                        ->body(view('admin.users.userIndex',compact('users')));
    }

    public function userShow(Content $cont , $id)
    {
        $user = User::find($id);
        if($user !== null && !empty($user))
        {
            return $cont->title('User Details')
                        ->description('User details page ')
                        ->body(view('admin.users.userShow',compact('user')));
        }else {
            return $cont->title('user is Deleted')
                        ->description('it is seems like someone deleted the user')
                        ->body(view('admin.users.userShow'));
        }
    }
    
    public function asks(Content $cont){
        $cont->title('Asks')->description('Here you can check Users information ')->body(Ask::all());
        return $cont;
    }

    
    public function reports(Content $cont){
        $cont->title('Reports')->description('Here you can check Users information ')->body(Report::all());
        return $cont;
    }

    
    public function messages(Content $cont){
        $cont->title('Messages')->description('Here you can check Users information ')->body(Message::all());
        return $cont;
    }

    
    public function chats(Content $cont){
        $cont->title('Chats')->description('Here you can check Users information ')->body(Chat::all());
        return $cont;
    }

    public function helpakMsgs(Content $cont){
        $msgs = Message::all()->where('chat_id','HalpakChat');
        foreach($msgs as $msg)
        {
            $msg->sender = User::find($msg->sender_id);
        }
        // dd($msgs);
        return $cont->title('User Details')
        ->description('User details page ')
        ->body(view('admin.chats.helpakMsgs',compact('msgs')));
    }

    
}
