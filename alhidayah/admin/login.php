<?php 
@session_start();
include "../config/koneksi.php";
if(@$_SESSION['admin']){
	header("location: index.php");
} else {
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	
	<title>Login Page | Administrator</title>
	<!-- Memanggil fungsi CSS -->
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
<div class="container">
	<div class="section">
		<div class="container w-50 bg-body-tertiary p-5 my-5 rounded-2">
			<h1 class="text-center">Login Admin</h1>
			<form action="" method="post" name="login">
					<div class="mt-3">
						<label>Username</label>
						<input type="text" name="username" required="required" autofocus class="form-control mt-3">
					</div>
					<div class="mt-3">
						<label>Password</label>
						<input type="password" name="password" required="required" class="form-control mt-3">
					</div>
			        <div class="mt-3 ">
			          	<input class="btn btn-primary " type="submit" name="login" value="Login">
						<input class="btn btn-primary" type="reset" name="reset" value="Batal">
			        </div>
			      </div>
				</div>
			</form>
			<?php 
			$username = @$_POST['username'];
			$password = @$_POST['password'];
			$login 	  = @$_POST['login'];

			if($login){
				if($username == "" || $password == ""){
					?> <script type="text/javascript">alert("Username atau Password tidak boleh kosong");</script><?php
				} else {
					$sql = mysqli_query($db, "SELECT * FROM tb_admin where username = '$username' and password = '$password'") or die($db->error);
					$data = mysqli_fetch_array($sql);
					$cek = mysqli_num_rows($sql);
					if($cek >= 1){
						if($data['level'] == "Admin"){
							@$_SESSION['admin'] = $data['id_admin'];
							header("location: index.php");
						}
					} else {
						echo "Username atau password salah";
					}
				}
			}
		?>
		</div>
	</div>
</div>
</body>
</html>
<?php } ?>