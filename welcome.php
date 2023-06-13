<?php
    include('../connect/connect.php'); 
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    // database connection
    include('config.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Crud Operation</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
<a href="https://lexacademy.in" target="_blank"><img src="" alt="" width="350px" ></a><br><hr>

<!-- adding alert notification  -->
<?php
	if($added){
		echo "
			<div class='btn-success' style='padding: 15px; text-align:center;'>
				Your Student Data has been Successfully Added.
			</div><br>
		";
	}

?>





	<a href="logout.php" class="btn btn-success"><i class="fa fa-lock"></i> Logout</a>
	<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-plus"></i> Add New Student
  </button>
		<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
			   <th class="text-center" scope="col">S.L</th>
				<th class="text-center" scope="col">Name</th>
				<th class="text-center" scope="col">Student Id.</th>
				<th class="text-center" scope="col">Phone</th>
				<th class="text-center" scope="col">Staff Id</th>
				<th class="text-center" scope="col">View</th>
				<th class="text-center" scope="col">Edit</th>
				<th class="text-center" scope="col">Delete</th>
			</tr>
		</thead>
			<?php

        	$get_data = "SELECT * FROM student_data order by 1 desc";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['id'];
				$u_card = $row['u_card'];
				$u_f_name = $row['u_f_name'];
				$u_l_name = $row['u_l_name'];
				$u_phone = $row['u_phone'];
				$u_family = $row['u_family'];
				$u_staff_id = $row['staff_id'];

        		$image = $row['image'];

        		echo "

				<tr>
				<td class='text-center'>$sl</td>
				<td class='text-left'>$u_f_name   $u_l_name</td>
				<td class='text-left'>$u_card</td>
				<td class='text-left'>$u_phone</td>
				<td class='text-center'>$u_staff_id</td>
			
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view$id' title='Profile'><i class='fa fa-address-card-o' aria-hidden='true'></i></a>
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>

					     
					    
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>
			</tr>


        		";
        	}

        	?>

			
			
		</table>
		<form method="post" action="export.php">
     <input type="submit" name="export" class="btn btn-success" value="Export Data" />
    </form>
	</div>


	<!---Add in modal---->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
			
			<!-- This is test for New Card Activate Form  -->
			<!-- This is Address with email  -->
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Student Id.</label>
<input type="text" class="form-control" name="card_no" placeholder="Enter 6-digit Student Id." maxlength="6" required>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Mobile No.</label>
<input type="phone" class="form-control" name="user_phone" placeholder="Enter 11-digit Mobile no." maxlength="11" required>
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="firstname">First Name</label>
<input type="text" class="form-control" name="user_first_name" placeholder="Enter First Name">
</div>
<div class="form-group col-md-6">
<label for="lastname">Last Name</label>
<input type="text" class="form-control" name="user_last_name" placeholder="Enter Last Name">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="fathername">Father's Name</label>
<input type="text" class="form-control" name="user_father" placeholder="Enter First Name">
</div>
<div class="form-group col-md-6">
<label for="mothername">Mother's Name</label>
<input type="text" class="form-control" name="user_mother" placeholder="Enter Last Name">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="email">Email</label>
<input type="email" class="form-control" name="user_email" placeholder="Enter Email">
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputState">Gender</label>
<select id="inputState" name="user_gender" class="form-control">
  <option selected>Choose...</option>
  <option>Male</option>
  <option>Female</option>
  <option>Other</option>
</select>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Date of Birth</label>
<input type="date" class="form-control" name="user_dob" placeholder="Date of Birth">
</div>
</div>


<div class="form-group col-md-6">
<label for="family">Family Members</label>
    <textarea class="form-control" name="family" rows="3"></textarea>
</div>



<div class="form-group">
<label for="inputAddress">Address</label>
<input type="text" class="form-control" name="address" placeholder="1234 Main St">
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputCity">City/Municipality</label>
<input type="text" class="form-control" name="dist">
</div>
<div class="form-group col-md-4">
<label for="inputState">State/Province</label>
<select name="state" class="form-control">
  <option selected>Choose...</option>
  <option value="Metro Manila">Metro Manila</option>
		<option value='Metro Manila'>Metro Manila</option>
		<option value='Abra'>Abra</option>
		<option value='Agusan del Norte'>Agusan del Norte</option>
		<option value='Agusan del Sur'>Agusan del Sur</option>
		<option value='Aklan'>Aklan</option>
		<option value='Albay'>Albay</option>
		<option value='Antique'>Antique</option>
		<option value='Apayao'>Apayao</option>
		<option value='Aurora'>Aurora</option>
		<option value='Basilan'>Basilan</option>
		<option value='Bataan'>Bataan</option>
		<option value='Batanes'>Batanes</option>
		<option value='Batangas'>Batangas</option>
		<option value='Benguet'>Benguet</option>
		<option value='Biliran'>Biliran</option>
		<option value='Bohol'>Bohol</option>
		<option value='Bukidnon'>Bukidnon</option>
		<option value='Bulacan'>Bulacan</option>
		<option value='Cagayan'>Cagayan</option>
		<option value='Camarines Norte'>Camarines Norte</option>
		<option value='Camarines Sur'>Camarines Sur</option>
		<option value='Camiguin'>Camiguin</option>
		<option value='Capiz'>Capiz</option>
		<option value='Catanduanes'>Catanduanes</option>
		<option value='Cavite'>Cavite</option>
		<option value='Cebu'>Cebu</option>
		<option value='Compostela Valley'>Compostela Valley</option>
		<option value='Cotabato'>Cotabato</option>
		<option value='Davao de Oro'>Davao de Oro</option>
		<option value='Davao del Norte'>Davao del Norte</option>
		<option value='Davao del Sur'>Davao del Sur</option>
		<option value='Davao Occidental'>Davao Occidental</option>
		<option value='Davao Oriental'>Davao Oriental</option>
		<option value='Dinagat Islands'>Dinagat Islands</option>
		<option value='Eastern Samar'>Eastern Samar</option>
		<option value='Guimaras'>Guimaras</option>
		<option value='Ifugao'>Ifugao</option>
		<option value='Ilocos Norte'>Ilocos Norte</option>
		<option value='Ilocos Sur'>Ilocos Sur</option>
		<option value='Iloilo'>Iloilo</option>
		<option value='Isabela'>Isabela</option>
		<option value='Kalinga'>Kalinga</option>
		<option value='La Union'>La Union</option>
		<option value='Laguna'>Laguna</option>
		<option value='Lanao del Norte'>Lanao del Norte</option>
		<option value='Lanao del Sur'>Lanao del Sur</option>
		<option value='Leyte'>Leyte</option>
		<option value='Maguindanao'>Maguindanao</option>
		<option value='Marinduque'>Marinduque</option>
		<option value='Masbate'>Masbate</option>
		<option value='Misamis Occidental'>Misamis Occidental</option>
		<option value='Misamis Oriental'>Misamis Oriental</option>
		<option value='Mountain Province'>Mountain Province</option>
		<option value='Negros Occidental'>Negros Occidental</option>
		<option value='Negros Oriental'>Negros Oriental</option>
		<option value='Northern Samar'>Northern Samar</option>
		<option value='Nueva Ecija'>Nueva Ecija</option>
		<option value='Nueva Vizcaya'>Nueva Vizcaya</option>
		<option value='Occidental Mindoro'>Occidental Mindoro</option>
		<option value='Oriental Mindoro'>Oriental Mindoro</option>
		<option value='Palawan'>Palawan</option>
		<option value='Pampanga'>Pampanga</option>
		<option value='Pangasinan'>Pangasinan</option>
		<option value='Quezon'>Quezon</option>
		<option value='Quirino'>Quirino</option>
		<option value='Rizal'>Rizal</option>
		<option value='Romblon'>Romblon</option>
		<option value='Samar'>Samar</option>
		<option value='Sarangani'>Sarangani</option>
		<option value='Siquijor'>Siquijor</option>
		<option value='Sorsogon'>Sorsogon</option>
		<option value='South Cotabato'>South Cotabato</option>
		<option value='Southern Leyte'>Southern Leyte</option>
		<option value='Sultan Kudarat'>Sultan Kudarat</option>
		<option value='Sulu'>Sulu</option>
		<option value='Surigao del Norte'>Surigao del Norte</option>
		<option value='Surigao del Sur'>Surigao del Sur</option>
		<option value='Tarlac'>Tarlac</option>
		<option value='Tawi-Tawi'>Tawi-Tawi</option>
		<option value='Zambales'>Zambales</option>
		<option value='Zamboanga del Norte'>Zamboanga del Norte</option>
		<option value='Zamboanga del Sur'>Zamboanga del Sur</option>
		<option value='Zamboanga Sibugay'>Zamboanga Sibugay</option>
</select>
</div>
<div class="form-group col-md-2">
<label for="inputZip">Zip</label>
<input type="text" class="form-control" name="pincode">
</div>
</div>


<div class="form-group">
<label for="inputAddress">Staff ID the one who add this Student.</label>
<input type="text" class="form-control" name="staff_id" maxlength="12" placeholder="Enter 12-digit Staff Id">
</div>
			


        	<div class="form-group">
        		<label>Image</label>
        		<input type="file" name="image" class="form-control" >
        	</div>

        	
        	 <input type="submit" name="submit" class="btn btn-info btn-large" value="Submit">
        	
        	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!------DELETE modal---->




<!-- Modal -->
<?php

$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	echo "

<div id='$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title text-center'>Are you want to sure??</h4>
      </div>
      <div class='modal-body'>
        <a href='delete.php?id=$id' class='btn btn-danger' style='margin-left:250px'>Delete</a>
      </div>
      
    </div>

  </div>
</div>


	";
	
}


?>


<!-- View modal  -->
<?php 

// <!-- profile modal start -->
$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$card = $row['u_card'];
	$name = $row['u_f_name'];
	$name2 = $row['u_l_name'];
	$father = $row['u_father'];
	$mother = $row['u_mother'];
	$gender = $row['u_gender'];
	$email = $row['u_email'];
	$Bday = $row['u_birthday'];
	$family = $row['u_family'];
	$phone = $row['u_phone'];
	$address = $row['u_state'];
	$address = $row['u_address'];
	$dist = $row['u_dist'];
	$pincode = $row['u_pincode'];
	$state = $row['u_state'];
	$time = $row['uploaded'];
	
	$image = $row['image'];
	echo "

		<div class='modal fade' id='view$id' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
				<h5 class='modal-title' id='exampleModalLabel'>Profile <i class='fa fa-user-circle-o' aria-hidden='true'></i></h5>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
			</div>
			<div class='modal-body'>
			<div class='container' id='profile'> 
				<div class='row'>
					<div class='col-sm-4 col-md-2'>
						<img src='upload_images/$image' alt='' style='width: 150px; height: 150px;' ><br>
		
						<i class='fa fa-id-card' aria-hidden='true'></i> $card<br>
						<i class='fa fa-phone' aria-hidden='true'></i> $phone  <br>
						Issue Date : $time
					</div>
					<div class='col-sm-3 col-md-6'>
						<h3 class='text-primary'>$name $name2</h3>
						<p class='text-secondary'>
						<strong>Father's name:</strong> $father <br>
						<strong>Mother's name :</strong>$mother <br>
						<i class='fa fa-venus-mars' aria-hidden='true'></i> $gender
						<br />
						<i class='fa fa-envelope-o' aria-hidden='true'></i> $email
						<br />
						<div class='card' style='width: 18rem;'>
						<i class='fa fa-users' aria-hidden='true'></i> Familiy :
								<div class='card-body'>
								<p> $family </p>
								</div>
						</div>
						
						<i class='fa fa-home' aria-hidden='true'> Address : </i> $address, <br> $dist, $state - $pincode
						<br />
						</p>
						<!-- Split button -->
					</div>
				</div>

			</div>   
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
			</div>
			</form>
			</div>
		</div>
		</div> 


    ";
}


// <!-- profile modal end -->


?>





<!----edit Data--->

<?php

$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$card = $row['u_card'];
	$name = $row['u_f_name'];
	$name2 = $row['u_l_name'];
	$father = $row['u_father'];
	$mother = $row['u_mother'];
	$gender = $row['u_gender'];
	$email = $row['u_email'];
	$Bday = $row['u_birthday'];
	$family = $row['u_family'];
	$phone = $row['u_phone'];
	$address = $row['u_state'];
	$address = $row['u_address'];
	$dist = $row['u_dist'];
	$pincode = $row['u_pincode'];
	$state = $row['u_state'];
	$staffCard = $row['staff_id'];
	$time = $row['uploaded'];
	$image = $row['image'];
	echo "

<div id='edit$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
             <h4 class='modal-title text-center'>Edit your Data</h4> 
      </div>

      <div class='modal-body'>
        <form action='edit.php?id=$id' method='post' enctype='multipart/form-data'>

		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputEmail4'>Student Id.</label>
		<input type='text' class='form-control' name='card_no' placeholder='Enter 12-digit Student Id.' maxlength='12' value='$card' required>
		</div>
		<div class='form-group col-md-6'>
		<label for='inputPassword4'>Mobile No.</label>
		<input type='phone' class='form-control' name='user_phone' placeholder='Enter 10-digit Mobile no.' maxlength='10' value='$phone' required>
		</div>
		</div>
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='firstname'>First Name</label>
		<input type='text' class='form-control' name='user_first_name' placeholder='Enter First Name' value='$name'>
		</div>
		<div class='form-group col-md-6'>
		<label for='lastname'>Last Name</label>
		<input type='text' class='form-control' name='user_last_name' placeholder='Enter Last Name' value='$name2'>
		</div>
		</div>
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='fathername'>Father's Name</label>
		<input type='text' class='form-control' name='user_father' placeholder='Enter First Name' value='$father'>
		</div>
		<div class='form-group col-md-6'>
		<label for='mothername'>Mother's Name</label>
		<input type='text' class='form-control' name='user_mother' placeholder='Enter Last Name' value='$mother'>
		</div>
		</div>
		
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='email'>Email</label>
		<input type='email' class='form-control' name='user_email' placeholder='Enter Email' value='$email'>
		</div>
		</div>
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputState'>Gender</label>
		<select id='inputState' name='user_gender' class='form-control' value='$gender'>
		  <option selected>$gender</option>
		  <option>Male</option>
		  <option>Female</option>
		  <option>Other</option>
		</select>
		</div>
		<div class='form-group col-md-6'>
		<label for='inputPassword4'>Date of Birth</label>
		<input type='date' class='form-control' name='user_dob' placeholder='Date of Birth' value='$Bday'>
		</div>
		</div>
		
		
		<div class='form-group'>
		<label for='family'>Family Members</label>
			<textarea class='form-control' name='family' rows='3'>$family</textarea>
		</div>
		
		
		
		<div class='form-group'>
		<label for='inputAddress'>Address</label>
		<input type='text' class='form-control' name='address' placeholder='1234 Main St' value='$address'>
		</div>
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputCity'>City/Municipality</label>
		<input type='text' class='form-control' name='dist' value='$dist'>
		</div>
		<div class='form-group col-md-4'>
		<label for='inputState'>State/Province</label>
		<select name='state' class='form-control'>
		  <option>$state</option>
		  <option value='Metro Manila'>Metro Manila</option>
		  <option value='Metro Manila'>Metro Manila</option>
		  <option value='Abra'>Abra</option>
		  <option value='Agusan del Norte'>Agusan del Norte</option>
		  <option value='Agusan del Sur'>Agusan del Sur</option>
		  <option value='Aklan'>Aklan</option>
		  <option value='Albay'>Albay</option>
		  <option value='Antique'>Antique</option>
		  <option value='Apayao'>Apayao</option>
		  <option value='Aurora'>Aurora</option>
		  <option value='Basilan'>Basilan</option>
		  <option value='Bataan'>Bataan</option>
		  <option value='Batanes'>Batanes</option>
		  <option value='Batangas'>Batangas</option>
		  <option value='Benguet'>Benguet</option>
		  <option value='Biliran'>Biliran</option>
		  <option value='Bohol'>Bohol</option>
		  <option value='Bukidnon'>Bukidnon</option>
		  <option value='Bulacan'>Bulacan</option>
		  <option value='Cagayan'>Cagayan</option>
		  <option value='Camarines Norte'>Camarines Norte</option>
		  <option value='Camarines Sur'>Camarines Sur</option>
		  <option value='Camiguin'>Camiguin</option>
		  <option value='Capiz'>Capiz</option>
		  <option value='Catanduanes'>Catanduanes</option>
		  <option value='Cavite'>Cavite</option>
		  <option value='Cebu'>Cebu</option>
		  <option value='Compostela Valley'>Compostela Valley</option>
		  <option value='Cotabato'>Cotabato</option>
		  <option value='Davao de Oro'>Davao de Oro</option>
		  <option value='Davao del Norte'>Davao del Norte</option>
		  <option value='Davao del Sur'>Davao del Sur</option>
		  <option value='Davao Occidental'>Davao Occidental</option>
		  <option value='Davao Oriental'>Davao Oriental</option>
		  <option value='Dinagat Islands'>Dinagat Islands</option>
		  <option value='Eastern Samar'>Eastern Samar</option>
		  <option value='Guimaras'>Guimaras</option>
		  <option value='Ifugao'>Ifugao</option>
		  <option value='Ilocos Norte'>Ilocos Norte</option>
		  <option value='Ilocos Sur'>Ilocos Sur</option>
		  <option value='Iloilo'>Iloilo</option>
		  <option value='Isabela'>Isabela</option>
		  <option value='Kalinga'>Kalinga</option>
		  <option value='La Union'>La Union</option>
		  <option value='Laguna'>Laguna</option>
		  <option value='Lanao del Norte'>Lanao del Norte</option>
		  <option value='Lanao del Sur'>Lanao del Sur</option>
		  <option value='Leyte'>Leyte</option>
		  <option value='Maguindanao'>Maguindanao</option>
		  <option value='Marinduque'>Marinduque</option>
		  <option value='Masbate'>Masbate</option>
		  <option value='Misamis Occidental'>Misamis Occidental</option>
		  <option value='Misamis Oriental'>Misamis Oriental</option>
		  <option value='Mountain Province'>Mountain Province</option>
		  <option value='Negros Occidental'>Negros Occidental</option>
		  <option value='Negros Oriental'>Negros Oriental</option>
		  <option value='Northern Samar'>Northern Samar</option>
		  <option value='Nueva Ecija'>Nueva Ecija</option>
		  <option value='Nueva Vizcaya'>Nueva Vizcaya</option>
		  <option value='Occidental Mindoro'>Occidental Mindoro</option>
		  <option value='Oriental Mindoro'>Oriental Mindoro</option>
		  <option value='Palawan'>Palawan</option>
		  <option value='Pampanga'>Pampanga</option>
		  <option value='Pangasinan'>Pangasinan</option>
		  <option value='Quezon'>Quezon</option>
		  <option value='Quirino'>Quirino</option>
		  <option value='Rizal'>Rizal</option>
		  <option value='Romblon'>Romblon</option>
		  <option value='Samar'>Samar</option>
		  <option value='Sarangani'>Sarangani</option>
		  <option value='Siquijor'>Siquijor</option>
		  <option value='Sorsogon'>Sorsogon</option>
		  <option value='South Cotabato'>South Cotabato</option>
		  <option value='Southern Leyte'>Southern Leyte</option>
		  <option value='Sultan Kudarat'>Sultan Kudarat</option>
		  <option value='Sulu'>Sulu</option>
		  <option value='Surigao del Norte'>Surigao del Norte</option>
		  <option value='Surigao del Sur'>Surigao del Sur</option>
		  <option value='Tarlac'>Tarlac</option>
		  <option value='Tawi-Tawi'>Tawi-Tawi</option>
		  <option value='Zambales'>Zambales</option>
		  <option value='Zamboanga del Norte'>Zamboanga del Norte</option>
		  <option value='Zamboanga del Sur'>Zamboanga del Sur</option>
		  <option value='Zamboanga Sibugay'>Zamboanga Sibugay</option>
		</select>
		</div>
		<div class='form-group col-md-2'>
		<label for='inputZip'>Zip</label>
		<input type='text' class='form-control' name='pincode' value='$pincode'>
		</div>
		</div>
		
		
		<div class='form-group'>
		<label for='inputAddress'>Staff Id one who Activate this card.</label>
		<input type='text' class='form-control' name='staff_id' maxlength='12' placeholder='Enter 12-digit Staff Id' value='$staffCard'>
		</div>
        	

        	<div class='form-group'>
        		<label>Image</label>
        		<input type='file' name='image' class='form-control'>
        		<img src = 'upload_images/$image' style='width:50px; height:50px'>
        	</div>

        	
        	
			 <div class='modal-footer'>
			 <input type='submit' name='submit' class='btn btn-info btn-large' value='Submit'>
			 <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
		 </div>


        </form>
      </div>

    </div>

  </div>
</div>


	";
}


?>

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

</body>
</html>