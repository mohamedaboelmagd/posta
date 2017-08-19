<?php namespace App\Http\Controllers;

use App\Comments;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Posts;
use App\User;
use App\Notification;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Posts::allPosts();
		return view('index',compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $requests)
	{
		$post = Posts::create([
			'post_name' => $requests->input('name'),
			'post_user_id' => Auth::user()->id
		]);
		return Redirect::back();
	}

	/**
	 * Display comments for spacific post the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$comment = Posts::find($id)->comment;
		$html = '';
		foreach($comment as $val)
		{
			$html = $html.'<blockquote>'.
						'<p>'.$val->comment_name.'</p>'.
						'<footer>'.$val->user->name.'</footer>'.
					'</blockquote>';
		}
		return $html;
	}

	/**
	 * Show the form for post the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showPost($id)
	{
		$post = Posts::find($id);
		return view('showPost',compact('post'));
	}

	/**
	 * add comment to post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function comment($id, Request $requests)
	{
		$comment = Comments::create([
			'comment_name' => $requests->input('comment'),
			'post_id' => $id,
			'comment_user_id' => Auth::user()->id
		]);
		
		$commentExistence = Comments::where('post_id','=',$id)->where('comment_user_id','=',Auth::user()->id);
		if((Auth::user()->id !== Posts::find($id)->user->id) && $commentExistence->count() == 1){
			Notification::create([
				'comment_user_id' => Auth::user()->id,
				'post_id' => $id,
				'comment_user_name' => Auth::user()->name,
				'post_user_id' => Posts::find($id)->user->id
			]);
		}
		return Redirect::back();
	}

}
