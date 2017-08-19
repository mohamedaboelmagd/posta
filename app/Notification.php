<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Notification extends Model {
    /**
     * Automatically persist the model in the Firebase realtime
     * database, whenever it gets created/updated/deleted
     */
    use SyncsWithFirebase;

    protected $primaryKey = 'notification_id';
    protected $table = 'notification';
    protected $fillable = array('comment_user_id','post_id','comment_user_name','post_user_id');
    public $timestamps = false;
}
