<?php
	session_start();

	$dbhost='localhost';
	$dbuser='root';
	$dbpass='';
	$dbname='bmesi';
	$connect=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(mysqli_connect_errno())
	{
		die('database connection failed');
	}

	unset($reg,$delegate,$row,$numrows,$_SESSION['message'],$message,$_SESSION['reg']);

	if($_POST['login'])
	{
		

		$reg=$_POST['reg'];
		$delegate=$_POST['delegate'];

		if(isset($reg,$delegate))
		{
			$sql='SELECT * FROM login WHERE registration = "'.$reg.'" AND delegate = "'.$delegate.'"';
			$row=mysqli_query($connect,$sql);
			$numrows = mysqli_num_rows($row);

			if($numrows==1)
			{
				// head to rules and regulation page
				header("Location: rules.php");
			}
			else
			{
				$sql2='SELECT * FROM login WHERE registration="'.$reg.'"';
				$result = mysqli_query($connect, $sql2);
				$numr=mysqli_num_rows($result);
				if($numr>0)
				{
					$_SESSION['reg']=$reg;
					$message = "Wrong Delegate ID";
				}
				else
				{
					$message = "Wrong Registration Number";
				}
				echo $message;
				$_SESSION['message']=$message;
				header("Location: login.php");

			}
		}
		else
		{
			$_SESSION['message']="both the fields are required";
			header("Location: login.php");
		}
	}
?>