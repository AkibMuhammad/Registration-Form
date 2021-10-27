<!DOCTYPE html>
<html>
<head>
<title>Registration Form</title>
</head>
<body>
<style>
.error {color:red;}
</style>





<?php
$fname = $lname = $gender = $dob = $religion = $present_address = $permanent_address = $phone = $email = $personal_website = $user_name = $password = '';
$fnameErr = $lnameErr = $genderErr = $dobErr = $religionErr = $present_addressErr = $permanent_address = $phoneErr = $emailErr =$personal_websiteErr = $user_nameErr= $passwordErr =  '';
$message = '';
$error = '';
$flag=1;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
if (empty($_POST["fname"]))
{
$fnameErr = "First Name is required";
$flag=0;
}
else
{
$fname = test_input($_POST["fname"]);
if (!preg_match("/^[a-zA-Z0-9-' _.-]*$/",$fname) || str_word_count($fname)<2 )
{
$fnameErr = "Only letters, white space, period, dash allowed and minimum one words";
$fname="";
$flag=0;
}
}





if (empty($_POST["lname"]))
{
$lnameErr = "Last Name is required";
$flag=0;
}
else
{
$lname = test_input($_POST["lname"]);
if (!preg_match("/^[a-zA-Z0-9-' _.-]*$/",$lname) || str_word_count($lname)<2 )
{
$lnameErr = "Only letters, white space, period, dash allowed and minimum one words";
$lname="";
$llag=0;
}
}





if(empty($_POST["gender"]))
{
$genderErr = "Select Gender";
$flag=0;
}
else
{
$gender = test_input($_POST["gender"]);
}




if(empty($_POST["dob"]))
{
$dobErr = "Enter Date of Birth";
$flag=0;
}
else
{
$dob = test_input($_POST["dob"]);
}




if(empty($_POST["religion"]))
{
$religionErr = "Select religion";
$flag=0;
}
else
{
$religion = test_input($_POST["religion"]);
}


if(empty($_POST["$present_address"]))
{
$$present_addressErr = "Enter a valid $present_address";
$flag=0;
}
else
{
$$present_address = test_input($_POST["$present_address"]);
}



if(empty($_POST["$permanent_address"]))
{
$$permanent_addressErr = "Enter a valid $permanent_address";
$flag=0;
}
else
{
$$permanent_address = test_input($_POST["$permanent_address"]);
}



if(empty($_POST["phone"]))
{
$phoneErr = "Enter a valid phone number";
$flag=0;
}
else
{
$phone = test_input($_POST["phone"]);
}







if (empty($_POST["email"]))
{
$emailErr = "Email is required";
$flag=0;
}
else
{
$email = test_input($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
$emailErr = "Invalid email format";
$email="";
$flag=0;
}
}



if (empty($_POST["personal_website"]))
{
$personal_websiteErr = "Website is required";
$flag=0;
}
else
{
$personal_website = test_input($_POST["personal_website"]);
if (!filter_var($personal_website, FILTER_VALIDATE_EMAIL))
{
$personal_websiteErr = "Invalid website format";
$personal_website="";
$flag=0;
}
}





if(empty($_POST["user_name"]))
{
$user_nameErr = "User Name is required";
$flag=0;
}
else
{
$user_name = test_input($_POST["user_name"]);
if (!preg_match("/^[a-zA-Z0-9-' _.-]*$/",$user_name) || str_word_count($user_name)<2 )
{
$user_nameErr = "User name sould be minimum in two words";
$user_name="";
$flag=0;
}
}






if (empty($_POST["password"]))
{
$passwordErr = "Password is required";
$flag=0;
}
else
{
$password = test_input($_POST["password"]);
if (strlen($password) < 8)
{
$passwordErr = "Minimum 8 characters";
$password="";
$flag=0;
}
else if (!preg_match("/[@,#,$,%]/",$password))
{
$passwordErr = "Provide at least one of the special character (@, #, $,%)";
$password ="";
$flag=0;
}
}


{
if(isset($_POST["submit"]))
{
if(file_exists('data.json'))
{
$current_data = file_get_contents('data.json');
$array_data = json_decode($current_data, true);
$extra = array(
'fname' => $_POST['fname'],
'lname' => $_POST['lname'],
'gender' => $_POST['gender'],
'dob' => $_POST['dob'],
'religion' => $_POST['religion'],
'present_address' => $_POST["present_address"],
'permanent_address' => $_POST["permanent_address"],
'phone' => $_POST["phone"],
'email' => $_POST['email'],
'personal_website' => $_POST['personal_website'],
'user_name' => $_POST['user_name'],
'password' => $_POST['password']);
$array_data[] = $extra;
$final_data = json_encode($array_data);
if(file_put_contents('data.json', $final_data))
{
$message = "Your Registration is complete.";
}
}
else
{
$error = "Saved file doesn't found";
}
}
}
}






function test_input($data)
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>





<fieldset style="width: 750px">
<legend>REGISTRATION</legend>
<form method="post">

<p><span class="error">* required field</span></p>

<label for="basic_information">Basic Information :</label><hr>


<label for="fname">First Name :</label>
<input type="text" id="fname" name="fname">
<span class="error"> * <?php echo $fnameErr;?></span><hr>





<label for="lname">Last Name :</label>
<input type="text" id="lname" name="lname">
<span class="error"> * <?php echo $lnameErr;?></span><hr>





<fieldset "width: 300px">
<legend> Gender</legend>
<input type="radio" id="male" name="gender" value="male">
<label for="male">Male</label>
<input type="radio" id="female" name="gender" value="female">
<label for="female">Female</label>
<input type="radio" id="other" name="gender" value="other">
<label for="other">Other </label>
<span class="error"> * <?php echo $genderErr;?></span>
</fieldset><hr>




<fieldset "width: 300px">
<legend>Date of Birth</legend>
<input type="date" name="dob">
<span class="error"> *  <?php echo $dobErr;?></span>
</fieldset><hr>



<fieldset>
<legend>Religion</legend>
<select class="form-control dropdown" id="religion" name="religion">
<option value="" selected="selected" disabled="disabled">-- select one --</option>
<option value="Christian(Catholic)">Christian(Catholic)</option>
<option value="Christian(Protestant)">Christian(Protestant)</option>
<option value="Muslim">Muslim</option>
</select>
<span class="error"> *  <?php echo $religionErr;?></span>
</fieldset><hr>

<label for="contact_information">Contact Information :</label><hr>




<label for="present_address">Present Address:</label><hr>
<textarea></textarea><hr>
<label for="permanent_address">Permanent Address:</label><hr>
<textarea></textarea><hr>



<label for="phone">Phone :</label>
<input type="tel" id="phone" name="phone">
<span class="error"> <?php echo $phoneErr;?></span><hr>




<label for="email">Email :</label>
<input type="text" id="email" name="email">
<span class="error"> * <?php echo $emailErr;?></span><hr>



<label for="personal_website">Personal Website :</label>
<input type="url" id="personal_website" name="personal_website">
<span class="error"> * <?php echo $personal_websiteErr;?></span><hr>



<label for="account_information">Account Information :</label><hr>



<label for="user_name">User name :</label>
<input type="text" id="user_name" name="user_name">
<span class="error"> * <?php echo $user_nameErr;?></span><hr>





<label for="password">Password :</label>
<input type="password" id="password" name="password">
<span class="error"> * <?php echo $passwordErr;?></span><hr>





<p>
<input type="submit" name="submit" value="Submit">
<input type="reset" name="reset" value="Reset">
</p>



</form>
</fieldset>
<?php
echo $error;
echo "<br>";
echo $message;
echo "<br>";
?>
</body>
</html>