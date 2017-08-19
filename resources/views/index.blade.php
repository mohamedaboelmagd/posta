@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        @foreach($posts as $post)
                            <blockquote>
                                <p>{{$post->post_name}}</p>
                                <footer>{{$post->user_name}}</footer>
                                @if($post->comment_number > 0)
                                    <a href="javascript:void(0)" onclick="var result = getComments({{$post->post_id}})">show comments</a>
                                    <div id="commentsOfPost{{$post->post_id}}"></div>
                                @endif
                                <form class="form-custom" action='{{url("create/comment/$post->post_id")}}' method="post">
                                    <input type="text" name="comment"/>
                                    <br/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <input type="submit" value="Save" class="btn btn-md btn-success" name="submit">
                                </form>
                            </blockquote>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function getComments(postId) {
         $.ajax({
         type: "GET",
         url: 'show/comment/'+postId,
         data: {postId: postId},
         success: function (result) {
             $('#commentsOfPost'+postId).html(result);
         }
         });
    };
</script>