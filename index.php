<!DOCTYPE html>
<html>
<head>
	<title>Kasir</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body style="background-image:; background-size:cover;">

<section>
        <div class="container mt-5 pt-5 mb-0">
            <div class="row"> 
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow" style="background-color: rgb(255, 255, 255, 0.5);">
                    <br>
					<div class="card-body">
							
							<center><h5>LOGIN</h5></center>
							<br>
						<?php 
	                      if(isset($_GET['pesan'])){
		                if($_GET['pesan']=="gagal"){
			               echo "<div class='alert'>Username Atau Password tidak sesuai</div>";
		                }
	                      }
	                    ?>
                            <form action="cek_login.php" method="post">
								<div class="form-group mb-3" >
									<label for="">Username</label>
									<input type="text" name="username" id="" class="form-control" placeholder="username">
								</div>
								<div class="form-group mb-5">
									<label for="">Password</label>
									<input type="password" name="password" id="" class="form-control " placeholder="password">
								</div>
                                <div class="text-center mt-5">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>