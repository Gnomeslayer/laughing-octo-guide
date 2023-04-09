<?php

include "config.php";

//Sanitizes the data to prevent any code injection
	function sanitize_input($data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}


//Connects to the database.
function connect_to_db()
{
	$charset = "utf8mb4";
	
	$dsn = "mysql:host="._SEVERNAME.";dbname="._DBNAME.";charset=$charset";
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		try {
			 $pdo = new PDO($dsn, _USERNAME, _PASSWORD , $options);
		} catch (\PDOException $e) {
			 throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
		
	return $pdo;
		
}

function getblog()
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("SELECT * FROM blog ORDER BY id DESC");
	$stmt->execute();

	$records = $stmt->fetchAll();
	return $records;
}

function getthings()
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("SELECT * FROM things ORDER BY id DESC");
	$stmt->execute();

	$records = $stmt->fetchAll();
	return $records;
}

function getnsfw()
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("SELECT * FROM nsfw ORDER BY id DESC");
	$stmt->execute();

	$records = $stmt->fetchAll();
	return $records;
}

function getimages($id, $posttype)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("SELECT * FROM imagelibrary WHERE belongstopost = :id AND posttype = :posttype");
	$stmt->execute(['id' => $id, 'posttype' => $posttype]);

	$records = $stmt->fetchAll();
	return $records;
}

function totalblogs()
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("SELECT * FROM blog ORDER BY id DESC LIMIT 1");
	$stmt->execute();
	$number_of_rows = $stmt->fetchColumn();
	
	//Returns 1 if exist and 0 if not.
	$number_of_rows++;
	return $number_of_rows;
}

function getallimages()
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("SELECT * FROM imagelibrary");
	$stmt->execute();

	$records = $stmt->fetchAll();
	return $records;
}

function saveimages($fullimage, $thumbnail, $imagename)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("INSERT INTO imagelibrary (fullimage, thumbnail, imagename) VALUES (:fullimage, :thumbnail, :imagename)");
	$stmt->execute(['fullimage' => $fullimage, 'thumbnail' => $thumbnail, 'imagename' => $imagename]);
}

if(!empty($_GET))
{
	if(!empty($_GET['action']))
	{
		if($_GET['action'] == "imagelist")
		{
			$imagelist = getallimages();
			foreach($imagelist as $i)
			{
				$imagename = "[".$i['imagename']."]";
				$fullimage = $i['fullimage'];
				echo "<a href=\"#\" id=\"unselected\" onclick=\"addimage('$fullimage')\">";
				echo "<img src=\"images/".$i['thumbnail']."\">";
				echo "</a>";
			}
		}
	}
	
}

function getsingleblog($id)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("SELECT * FROM blog WHERE id = :id");
	$stmt->execute(['id' => $id]);
	$blogdetails = $stmt->fetchAll();
	return $blogdetails;
}

function deleteblog($id)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("DELETE FROM blog WHERE id=:id");
	$stmt->execute(['id' => $id]);
}

function updateblog($id, $title, $content)
{
	$pdo = connect_to_db();
	$content = nl2br($content);
	$sql = "UPDATE blog SET title = :title, content = :content WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['title' => $title, 'content' => $content, 'id' => $id]);
}

function createblog($title, $content)
{
	$pdo = connect_to_db();
	$content = nl2br($content);
	$stmt = $pdo->prepare("INSERT INTO blog (title, content) VALUES (:title, :content)");
	$stmt->execute(['title' => $title, 'content' => $content]);
}


function getsinglensfw($id)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("SELECT * FROM nsfw WHERE id = :id");
	$stmt->execute(['id' => $id]);
	$blogdetails = $stmt->fetchAll();
	return $blogdetails;
}

function deletensfw($id)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("DELETE FROM nsfw WHERE id=:id");
	$stmt->execute(['id' => $id]);
}

function updatensfw($id, $github, $content, $nsfw, $title)
{
	$pdo = connect_to_db();
	$content = nl2br($content);
	$stmt = $pdo->prepare("UPDATE nsfw SET github = :github, content = :content, nsfw = :nsfw, title = :title WHERE id=:id");
	$stmt->execute(['github' => $github, 'content' => $content, 'nsfw' => $nsfw, 'title' => $title, 'id' => $id]);
}

function creatensfw($github, $content, $nsfw, $title)
{
	$pdo = connect_to_db();
	$content = nl2br($content);
	$stmt = $pdo->prepare("INSERT INTO nsfw (github, content, nsfw, title) VALUES (:github, :content, :nsfw, :title)");
	$stmt->execute(['github' => $github, 'content' => $content, 'nsfw' => $nsfw, 'title' => $title]);
}

function getsinglething($id)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("SELECT * FROM things WHERE id = :id");
	$stmt->execute(['id' => $id]);
	$blogdetails = $stmt->fetchAll();
	return $blogdetails;
}

function deletething($id)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("DELETE FROM things WHERE id=:id");
	$stmt->execute(['id' => $id]);
}

function updatething($id, $github, $content, $thing, $title)
{
	$pdo = connect_to_db();
	$content = nl2br($content);
	$stmt = $pdo->prepare("UPDATE things SET github = :github, content = :content, thing = :thing, title = :title WHERE id=:id");
	$stmt->execute(['github' => $github, 'content' => $content, 'thing' => $thing, 'title' => $title, 'id' => $id]);
}

function creatething($github, $content, $thing, $title)
{
	$pdo = connect_to_db();
	$content = nl2br($content);
	$stmt = $pdo->prepare("INSERT INTO things (github, content, thing, title) VALUES (:github, :content, :thing, :title)");
	$stmt->execute(['github' => $github, 'content' => $content, 'thing' => $thing, 'title' => $title]);
}


function check_if_exist($username)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
	$stmt->execute(['username' => $username]);
	$number_of_rows = $stmt->fetchColumn();
	
	//Returns 1 if exist and 0 if not.
	return $number_of_rows;
}

function register_user($username, $password)
{
	$pdo = connect_to_db();
	
	$password = password_hash($password, PASSWORD_BCRYPT);
	$error = "";
	if(check_if_exist($username) == 1)
	{
		$error = "User already exists.";
	}else{
		$stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
		$stmt->execute(['username' => $username, 'password' => $password, 'role' => "General"]);
	}
	
	return $error;
}

function login($username, $password)
{
	$pdo = connect_to_db();
	
	$exists = check_if_exist($username);
	
	$match = "No";
	
	if($exists == 1)
	{
		$stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
		$stmt->execute(['username' => $username]);
		
		$row = $stmt->fetchColumn();
		if(password_verify($password, $row))
		{
			$match = "Yes";
		}

		if($match == "Yes")
		{
			$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
			$stmt->execute(['username' => $username]);
			$userdata = $stmt->fetchAll();
		}
	}
	return $userdata;
}