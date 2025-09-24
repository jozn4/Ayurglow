<!doctype html>
<html lang="en">
  <head>
  	<title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- Your custom CSS file -->
	<link href="login.css" rel="stylesheet">

    <!-- Inline CSS override to force green button -->
    <style>
      .btn-primary {
        background-color: green !important;
        border-color: green !important;
      }
      .btn-primary:hover {
        background-color: darkgreen !important;
        border-color: darkgreen !important;
      }
    </style>
  </head>

<body class="img js-fullheight" style="background-image: url('../../uploads/a1.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
		
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">LOGIN</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<form action="loginaction.php" class="signin-form" method="post">
		      		<div class="form-group">
		      			<input type="text" class="form-control" name="username" placeholder="Username" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password"  name="passsword" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit">Sign In</button>
	            </div>
	            
	          </form>
	    
		      </div>
				</div>
			</div>
		</div>
	</section>
	</body>
</html>
