

<?php




 
$conn =mysqli_connect('localhost','root','root','ex_project');

if(!$conn){
echo 'Fail : '  .mysqli_connect_error();
}


$errors = [

  'NameError'=> '',
  'UsernameError'=> '',
  'EmailError'=> '',
  'PasswordError'=> '',
  'PasswordError2'=> '',
  'PhoneNumberError'=> '',
  
]; 

if (isset($_POST['submit'])){


  
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $email =mysqli_real_escape_string($conn, $_POST['email']);
  $password =MD5(mysqli_real_escape_string ($conn,$_POST['password']));
  $password2 =MD5(mysqli_real_escape_string ($conn,$_POST['password2']));
  $phoneNumber = mysqli_real_escape_string($conn,$_POST ['phoneNumber']);
   


 $sql = "INSERT INTO employee(name,username,email,password, phone,rate)
VALUES ('$name','$username','$email','$password','$phoneNumber','0')";

if(empty($name)){
  $errors['NameError'] ='Enter Your Name';
 

}
 if(empty($username)){
  $errors['UsernameError'] ='Enter Your Username';

} if(empty($email)){
  $errors['EmailError'] ='Enter Your Email';

}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
  $errors['EmailError'] ='Enter A Valid Email';
}
 if(empty($password)){
  $errors['PasswordError'] ='Enter A Password';

} if(empty($password2)){
  $errors['PasswordError2'] ='Enter A Confirm Password';
 
} if(empty($phoneNumber)){
  $errors['PhoneNumberError'] ='Enter A Phone Number';
 
} if($password != $password2){
  $errors['PasswordError'] =' Password Not Match !';
  
}

if((!empty($name)) && (!empty($username))&& (!empty($email))  &&(filter_var($email,FILTER_VALIDATE_EMAIL))&& (!empty($password))&& (!empty($password2)) &&(!empty($phoneNumber)) &&($password == $password2)){
  mysqli_query($conn,$sql);
  echo '<script type=text/javascript> alert("You have been successfully Registered for this Volunteering opportunity ");window.location.href=window.location.href;</script>';
}  

 

}


mysqli_close($conn);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css">
    <title>Register page</title>
</head>
<body>
    


<!--<form action="register_form_for_employee.php">
<input type="text" name="firstName" id ="firstName" placeholder="Enter Your First Name">
<input type="text" name="lastName" id ="lastName"placeholder="Enter Your Last Name">
<input type="text" name="email" id ="email"placeholder="Enter Your Email">
<input type="text" name="password1" id ="password1"placeholder="Enter Your Password">
<input type="text" name="password2" id ="password2"placeholder="Confirm Your Password Again">
<input type="text" name="phoneNumber" id ="phoneNumber"placeholder="Enter Your Phone Number">
<input type="submit" name= "submit"value="Register" >
 
</form>
!-->
<div class ="container"> 
<h1>  Register Employee Page   </h1>
<form class = "mt-5" action ="<?php  $_SERVER['PHP_SELF']   ?>" method="POST" >
  
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name ="name" value="<?php echo $name ?>  "id="name" required >
    <div id="emailHelp" class="form-text error"> <?php echo $errors['NameError'] ?></div>
  </div>


  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" name ="username"  value="<?php echo $username ?> "  id="username"required >
    <div id="emailHelp" class="form-text error"> <?php echo $errors['UsernameError'] ?></div>
  </div>




 

<div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email"value="<?php echo $email ?> "id="email"required >
    <div id="emailHelp" class="form-text error"><?php echo $errors['EmailError'] ?> </div>
  </div>


  <div class="mb-3">
    <label for="Password1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password"required>
    <div id="emailHelp" class="form-text error"><?php echo $errors['PasswordError'] ?> </div>
  </div>

  <div class="mb-3">
    <label for="Password2" class="form-label">Confirm Password</label>
    <input type="password" class="form-control"name="password2" id="password2"required>
    <div id="emailHelp" class="form-text error"><?php echo $errors['PasswordError2'] ?> </div>
  </div>

  <div class="mb-3">
    <label for="phoneNumber" class="form-label">Phone Number</label>
    <input type="text" class="form-control" name="phoneNumber" value="<?php echo $phoneNumber ?> "  id="phoneNumber" required>
    <div id="emailHelp" class="form-text error"> <?php echo $errors['PhoneNumberError'] ?></div>
  </div>
 
  <button type="submit" name= "submit"class="btn btn-primary">Register</button>
</form>


</div>
</body>
</html>