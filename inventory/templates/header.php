<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand font-weight-bolder" href="#">Inventory</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <?php if(isset($_SESSION['uId'])){ ?>
            <a class="nav-item nav-link active" href="dashboard.php"><i class="fa fa-tachometer">&nbsp;</i>Dashboard</a>
            <?php }?>
            
            <?php if(isset($_SESSION['uId'])){ ?>
            <a class="nav-item nav-link active" href="logout.php"><i class="fa fa-user">&nbsp;</i>Logout</a>
            <?php }else { ?>
            <a class="nav-item nav-link active" href="index.php"><i class="fa fa-user">&nbsp;</i>Login</a>
            <?php }?>
        </div>
    </div>
</nav>