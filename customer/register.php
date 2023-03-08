<style>
  @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);


body{
    margin: 0;
    font-size: .9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #212529;
    text-align: left;
    background-color: #f5f8fa;
}

.navbar-laravel
{
    box-shadow: 0 2px 4px rgba(0,0,0,.04);
}

.navbar-brand , .nav-link, .my-form, .login-form
{
    font-family: Raleway, sans-serif;
}

.my-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.my-form .row
{
    margin-left: 0;
    margin-right: 0;
}

.login-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.login-form .row
{
    margin-left: 0;
    margin-right: 0;
}
</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./register.php">Register</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
	<?php 
        require_once('./saveRegister.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/customer.php');
        $classCustomer = new customer();
    ?>
    
<div class="row justify-content-center">
   
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Register</div>
                            <div class="card-body">

                                <form class="form-horizontal" method="post">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Full Name</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="fullname" id="name" placeholder="Enter your Full Name"  required />
                                            </div>
                                        </div>	
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Your Email</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="cols-sm-2 control-label">Username</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter your Username" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" required />
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Phone</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm" class="cols-sm-2 control-label">Address</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="apartment_number" id="apartment_number" placeholder="Apartment number" required />
                                                <input type="text" class="form-control" name="street" id="street" placeholder="Street" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                <select name="provinces" id="provinces" class="form-control" required>
                                                    <option>Province</option>
                                                    <?php 
                                                        $province = $classCustomer->executeResult('SELECT * FROM `provinces`');
                                                        foreach ($province as $province) {
                                                            echo '<option value="'.$province['provinces_id'].'">'.$province['provinces_name'].'</option>';
                                                        }
                                                    ?>
                                                </select>    

                                                <select name="districts" id="districts" class="form-control" required>
                                                    <option>District</option>
                                                   
                                                </select>

                                                <select name="wards" id="wards" class="form-control" required>
                                                    <option>Ward</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <button type="submit" name="btn_register" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                                    </div>
                                   
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
</div>
<script>
    $(document).ready(function() {
        $('#provinces').on('change', function() {
            var provinces_id = $(this).val();   
            $.ajax({
                method: "POST",
                url : "./operation/handle_province.php",
                data: {provinces_id: provinces_id},
                dataType: "html",
                success: function(data) {
                    $('#districts').html(data);
                }
            })
        })


        $('#districts').on('change', function() {
            $(this).off
            var districts_id = $(this).val();   
            $.ajax({
                method: "POST",
                url : "./operation/handle_district.php",
                data: {districts_id: districts_id},
                dataType: "html",
                success: function(data) {
                    $('#wards').html(data);
                }
            })
        })

    })
</script>