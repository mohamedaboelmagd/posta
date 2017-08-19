<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">Notification</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>

						<li class="dropdown" id="notificationGroup" style="display:none;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Notification <span class="numNotify">5</span><span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu" id="notification"></ul>
						</li>

					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

</body>

@if (!Auth::guest())
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.25/vue.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.4.1/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyC33FLGV5whXvihw7ixLlIHShVtDlT6CNI",
            authDomain: "notification-a3e3f.firebaseapp.com",
            databaseURL: "https://notification-a3e3f.firebaseio.com",
            storageBucket: "notification-a3e3f.appspot.com",
            messagingSenderId: "937356031991"
        };
        firebase.initializeApp(config);

        //Create reference
        const notificationRefObject = firebase.database().ref().child('notification');

        notificationRefObject.on("value", function(snapshot) {
            var count = 0;
            var notificationArr = [];
            $('#notification').append('');
	        snapshot.forEach(function(childSnapshot) {
	            var childData = childSnapshot.val();
	            
	            if({{Auth::user()->id}} == childData.post_user_id){
	                $('.numNotify').text(++count);
	                $('#notificationGroup').show();
	                var linkPost = '/post/'+childData.post_id;
	                var li = "<li><a href='"+"{{url()}}"+linkPost+"'>"+childData.comment_user_name+" has commented on a post of yours</a></li>";
	                notificationArr.push(li);
	            }
	        });
			$('#notification').html(notificationArr.getUnique());
        });

        Array.prototype.getUnique = function(){
		   var u = {}, a = [];
		   for(var i = 0, l = this.length; i < l; ++i){
		      if(u.hasOwnProperty(this[i])) {
		         continue;
		      }
		      a.push(this[i]);
		      u[this[i]] = 1;
		   }
		   return a;
		}
    </script>
   	@endif
</html>
