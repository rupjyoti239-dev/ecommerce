<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Online Shop</title>

  <!-- Bootstrap -->
  <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- bootstrap-daterangepicker -->
  <link href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">

</head>

<body class="login">
  <div>
    

    <div style="width:35%; margin: 200px auto">
      <div  style="background-color: rgb(205, 233, 246); padding: 10px 30px;">
        <section class="login_content">
          <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <h1>Admin Login Form</h1>
            <div>
              <input type="text" class="form-control" name="email" placeholder="Useremail" required="" />
            </div>
            <div>
              <input type="password" class="form-control" name="password" placeholder="Password" required="" />
            </div>
            <div class="d-flex justify-content-center">
              <input type="submit" value="Login" class="btn btn-success">
            </div>

            <div class="clearfix"></div>
          </form>
        </section>
      </div>
    </div>

  </div>
</body>

</html>