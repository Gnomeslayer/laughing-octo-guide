<?php
	include "functions.php";
	session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="styles/stylesheet.css">
    <title>Gnomes Things</title>
  </head>
  <body>
	
	<div class="topnav">
	<div class="navcontainer">
		<?php
		$home = "inactive";
		$things = "inactive";
		$nsfw = "inactive";
		$login = "inactive";
		$logout = "inactive";
		$register = "inactive";
		$upload = "inactive";
			if(!empty($_GET))
			{
				$page = $_GET['page'];
				switch($page)
				{
					case "home":
						$home = "active";
						break;
					case "things":
						$things = "active";
						break;
					case "nsfw":
						$nsfw = "active";
						break;
					case "login":
						$login = "active";
						break;
					case "logout":
						$logout = "active";
						break;
					case "register":
						$register = "active";
						break;
					case "uploadimage":
						$upload = "active";
						break;
					case "creatensfw":
						break;
					case"createblog":
						break;
					case "createthings":
						break;
					case "edit":
						break;
					case "delete";
						break;
					case "confirmdelete":
						break;
					default:
						$home = "active";
				}
			}else{
				$home = "active";
			}
			?>
		  <a class=<?php echo $home; ?> href="?page=home">Home</a>
		  <a class=<?php echo $things; ?> href="?page=things">Things</a>
		  <a class=<?php echo $nsfw; ?> href="?page=nsfw">NSFW things</a>

			<?php if(isset($_SESSION) && !empty($_SESSION['username'])): ?>
				<?php if($_SESSION['role'] == "Admin"): ?>
		  			<a class=<?php echo $nsfw; ?> href="?page=uploadimage">Upload Image</a>
				<?php endif; ?>
			<?php endif; ?>
		  
			<?php if(isset($_SESSION) && !empty($_SESSION['username'])): ?>
				<a class=<?php echo $logout; ?> href="?page=logout">Logout</a>
			<?php endif; ?>
			
			<?php if(isset($_SESSION) && !empty($_SESSION['role'])): ?>
				<?php if($_SESSION['role'] == "Admin"): ?>
					<?php if(!empty($_GET['page'])): ?>
						<?php if($_GET['page'] == "home"): ?>
							<div class="createnew"><a href="?page=createblog">New blog entry </a></div>
						<?php elseif($_GET['page'] == "nsfw"): ?>
							<div class="createnew"><a href="?page=creatensfw">New nsfw entry </a></div>
						<?php elseif($_GET['page'] == "things"): ?>
							<div class="createnew"><a href="?page=createthings">New things entry </a></div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
</div>
	</div>

	<div class="mainbody">
		<div class="content">
			<?php
				if(!empty($_GET))
				{
					$page = $_GET['page'];
					switch($page)
					{
						case 'home':
							include "pages/home.php";
							break;
						case 'things':
							include "pages/things.php";
							break;
						case 'nsfw':
							include "pages/nsfw.php";
							break;
						case 'login':
							include "pages/login.php";
							break;
						case 'logout':
							include "pages/logout.php";
							break;
						case 'register':
							include "pages/register.php";
							break;
						case 'confirmlogout':
							include "pages/confirmlogout.php";
							break;
						case 'confirmlogin':
							include "pages/confirmlogin.php";
							break;
						case 'createblog':
							include "pages/createblog.php";
							break;
						case 'creatensfw':
							include "pages/creatensfw.php";
							break;
						case 'createthings':
							include "pages/createthings.php";
							break;
						case 'confirmregister':
							include "pages/confirmregister.php";
							break;
						case 'edit':
							include "pages/edit.php";
							break;
						case 'delete':
							include "pages/delete.php";
							break;
						case 'confirmdelete':
							include "pages/confirmdelete.php";
							break;
						case 'uploadimage':
							include "pages/uploadimage.php";
							break;
						default:
							include "pages/home.php";
					}
				}else{
					include "pages/home.php";
				}
				
			?>
		</div>
	</div>
  </body>
</html>