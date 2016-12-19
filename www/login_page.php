<?php include "/header/header-control.php"; ?>
<html>
  <head>
		<title>Login</title>
    <?php include "/header/header-head.php"; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <style>
    body, html{
     	background-repeat: repeat;
    }

    h1.title {
    	font-size: 50px;
    	font-weight: 400;
    }

    hr{
    	width: 10%;
    	color: #fff;
    }

    .form-group{
    	margin-bottom: 15px;
    }

    label{
    	margin-bottom: 15px;
    }

    input,
    input::-webkit-input-placeholder {
        font-size: 11px;
        padding-top: 3px;
    }

    .main-login{
     	background-color: #fff;
        /* shadows and rounded borders */
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

    }

    .main-center{
     	margin-top: 30px;
     	margin: 0 auto;
     	max-width: 330px;
        padding: 30px 30px;

    }

    .login-button{
    	margin-top: 5px;
    }

    .login-register{
    	font-size: 11px;
    	text-align: center;
    }

    @import('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css')
      .funkyradio div {
       clear: both;
       overflow: hidden;
      }
      .funkyradio label {
       width: 100%;
       border-radius: 3px;
       border: 1px solid #D1D3D4;
       font-weight: normal;
      }
      .funkyradio input[type="radio"]:empty,
      .funkyradio input[type="checkbox"]:empty {
       display: none;
      }
      .funkyradio input[type="radio"]:empty ~ label,
      .funkyradio input[type="checkbox"]:empty ~ label {
       position: relative;
       line-height: 2.5em;
       text-indent: 3.25em;
       cursor: pointer;
       -webkit-user-select: none;
          -moz-user-select: none;
           -ms-user-select: none;
               user-select: none;
      }
      .funkyradio input[type="radio"]:empty ~ label:before,
      .funkyradio input[type="checkbox"]:empty ~ label:before {
       position: absolute;
       display: block;
       top: 0;
       bottom: 0;
       left: 0;
       content: '';
       width: 2.5em;
       background: #D1D3D4;
       border-radius: 3px 0 0 3px;
      }
      .funkyradio input[type="radio"]:hover:not(:checked) ~ label,
      .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
       color: #888;
      }
      .funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
      .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
       content: '\2714';
       text-indent: .9em;
       color: #C2C2C2;
      }
      .funkyradio input[type="radio"]:checked ~ label,
      .funkyradio input[type="checkbox"]:checked ~ label {
       color: #777;
      }
      .funkyradio input[type="radio"]:checked ~ label:before,
      .funkyradio input[type="checkbox"]:checked ~ label:before {
       content: '\2714';
       text-indent: .9em;
       color: #333;
       background-color: #ccc;
      }
      .funkyradio input[type="radio"]:focus ~ label:before,
      .funkyradio input[type="checkbox"]:focus ~ label:before {
       box-shadow: 0 0 0 3px #999;
      }
      .funkyradio-default input[type="radio"]:checked ~ label:before,
      .funkyradio-default input[type="checkbox"]:checked ~ label:before {
       color: #333;
       background-color: #ccc;
      }
      .funkyradio-primary input[type="radio"]:checked ~ label:before,
      .funkyradio-primary input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #337ab7;
      }
      .funkyradio-success input[type="radio"]:checked ~ label:before,
      .funkyradio-success input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #5cb85c;
      }
      .funkyradio-danger input[type="radio"]:checked ~ label:before,
      .funkyradio-danger input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #d9534f;
      }
      .funkyradio-warning input[type="radio"]:checked ~ label:before,
      .funkyradio-warning input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #f0ad4e;
      }
      .funkyradio-info input[type="radio"]:checked ~ label:before,
      .funkyradio-info input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #5bc0de;
      }
      .new_user{
      font-size:14px;
      color:#18a210;
      font-weight: bold;
      }
    </style>
	</head>
	<body style="background-attachment: fixed">
    <?php include "/header/header-body.php"; ?>
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	      </div>
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="login.php">

            <div class="form-group">
							<h1 align="center">Login</h1>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email" required="required"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password" required="required"/>
								</div>
							</div>
						</div>
            <div class="form-group">
              <?php if(isset($_GET['src'])) : ?>
              <?php if($_GET['src'] == 'new_user') : ?>
                <p class="new_user text-center">Thank you for signing up! Please log in to confirm your account.</p>
              <?php endif; ?>
              <?php endif; ?>
							<button type="sumbit" name="login_PAGE" id="submit" class="btn btn-primary btn-lg btn-block login-button" action="login.php">Login</button>
						</div>

              <script>
                  function checkEmail() {
                    var email = $("#email").val();
                    var index = email.indexOf("@");

                    var check = email.substring(index);

                    if (check != "@s207.org") {
                      $("#emailWarning").html("Must be @s207.org").css('color', 'red');
                       $("#submit").attr("disabled","disabled");
                    } else {
                      $("#emailWarning").html("<br>").css('color', 'red');
                      $("#submit").removeAttr('disabled');
                    }
                  }

                  $(document).ready(function () {
                    $("#confirm").keyup(checkPasswordMatch);
                    $("#email").keyup(checkEmail);
                  });

                  $('form').submit(function(){
                    var required = $('[required="required"]');
                    var error = false;

                    for(var i = 0; i <= (required.length - 1);i++)
                    {
                      if(required[i].value == '')
                      {
                        required[i].style.backgroundColor = 'rgb(255,155,155)';
                        error = true;
                      }
                    }
                    if(error)
                    {
                      return false;
                    }
                    });


              </script>

					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	</body>
</html>
