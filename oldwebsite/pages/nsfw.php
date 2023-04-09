<?php
	$blogdetails = getnsfw();
?>
<?php foreach($blogdetails as $blog): ?>
	<div class="box">
		<div class="boxtitle">
			<h2><?php echo $blog['title']; ?></h2>
			<?php if(isset($_SESSION) && !empty($_SESSION['role'])): ?>
					<?php if($_SESSION['role'] == "Admin"): ?>
						<a href=?page=edit&type=nsfw&id=<?php echo $blog['id']; ?>><div class="button edit">Edit</div></a>
						<a href=?page=delete&type=nsfw&id=<?php echo $blog['id']; ?>><div class="button delete">Delete</div></a>
					<?php endif; ?>
				<?php endif; ?><br><br>
			
		</div>
		<div class="boxcontent">
			<div class="buttoncontainer">
				<a href="<?php echo $blog['github']; ?>" Target="_BLANK"><div class="button github_button">View on github!</div></a>
				<a href="<?php echo $blog['nsfw']; ?>" Target="_BLANK"><div class="button demo_button">View it live on my website!</div></a>
				
			</div>
			
			<p><?php echo $blog['content']; ?></p>
		</div>
	</div><br>
<?php endforeach; ?>
<br>
