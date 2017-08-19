<?php namespace App;

use Illuminate\Database\Eloquent\Model;
//use Mpociot\Firebase\SyncsWithFirebase;

class Comments extends Model {
    /**
     * Automatically persist the model in the Firebase realtime
     * database, whenever it gets created/updated/deleted
     */
    //use SyncsWithFirebase;

    protected $primaryKey = 'comment_id';
    protected $table = 'comments';
    protected $fillable = array('comment_name','post_id','comment_user_id');

    public function post()
    {
        return $this->belongsTo('App\Posts','post_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'comment_user_id');
    }
}
