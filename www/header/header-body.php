<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>

      </button>
      <a class="navbar-brand" href="index.php"><img alt="Hawklot" src="headerhl.png" style="height:20px;"></a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(substr($_SERVER['PHP_SELF'],1)=='index.php'):?>class="active"<?php endif;?>><a href="index.php">Home</a></li>
        <li <?php if(substr($_SERVER['PHP_SELF'],1)=='reportbug.php'):?>class="active"<?php endif;?>><a href="reportbug.php">Report Bug</a></li>
        <?php if ($_SESSION['logon'] >= 3) : ?>
          <li <?php if(substr($_SERVER['PHP_SELF'],1)=='admin.php'):?>class="active"<?php endif;?>><a href="admin.php">Admin</a></li>
        <?php endif; ?>
        <?php if ($_SESSION['logon'] >= 2) : ?>
          <li <?php if(substr($_SERVER['PHP_SELF'],1)=='owner.php'):?>class="active"<?php endif;?>><a href="owner.php">Owner Access</a></li>
        <?php endif; ?>
        <?php if ($_SESSION['logon'] == 1 || $_SESSION['logon'] == 3)  : ?>
          <li <?php if(substr($_SERVER['PHP_SELF'],1)=='user.php'):?>class="active"<?php endif;?>><a href="user.php">Renter Access</a></li>
        <?php endif; ?>
      </ul>
      <?php if ($_SESSION['logon'] < 1) : ?>
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text">Already have an account?</p></li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><b>Login</b><span class="caret"></span></a>
      <ul id="login-dp" class="dropdown-menu">
        <li>
           <div class="row">
              <div class="col-md-12">
                 <form class="form" role="form" method="post" action="login.php" accept-charset="UTF-8" id="login-nav">
                    <div class="form-group">
                       <label class="sr-only" for="InputEmail">Email address</label>
                       <input type="email" name="email" class="form-control" id="InputEmail" placeholder="Email address" required>
                    </div>
                    <div class="form-group">
                       <label class="sr-only" for="InputPassword">Password</label>
                       <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password" required>
                      <div class="help-block text-right"><a href="">Forgot your password?</a></div>
                    </div>
                    <div class="form-group">
                       <button class="btn btn-primary btn-block" type="submit" action="login.php" name="login_HEADER">Sign In</button>
                    </div>
                 </form>
              </div>
              <div class="bottom text-center">
                New here ? <a href="register.php"><b>Join Us</b></a>
              </div>
           </div>
        </li>
      </ul>
    <?php endif; ?>
    <?php if($_SESSION['logon'] >= 1) : ?>
      <ul class="nav navbar-nav navbar-right">

        <li>
          <a href="reroute.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
        </li>
      <ul>
    <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
