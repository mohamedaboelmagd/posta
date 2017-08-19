<?php namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
//use Mpociot\Firebase\SyncsWithFirebase;

class Posts extends Model {

    //use SyncsWithFirebase;

    protected $primaryKey = 'post_id';
    protected $table = 'posts';
    protected $fillable = array('post_name','post_user_id');

    public function comment()
    {
        return $this->hasMany('App\Comments','post_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','post_user_id');
    }

    protected static function allPosts()
    {
        $posts = DB::table('posts')
        ->selectRaw('posts.post_id,posts.post_name,
        users.name as user_name,users.email as user_email, Count(comments.comment_id) as comment_number')
        ->LeftJoin('users', function ($join) {
            $join->on('posts.post_user_id', '=', 'users.id');
        })
        ->LeftJoin('comments', function ($join) {
            $join->on('posts.post_id', '=', 'comments.post_id');
        })
        ->groupBy('posts.post_id')->orderBy('posts.post_id', 'asc')->get();
        return $posts;
    }
}
