<?php
	$blogdetails = getblog();
?>
<?php foreach($blogdetails as $blog): ?>
	<div class="box">
		<div class="boxtitle">
			<h2><?php echo $blog['title']; ?></h2>
			<?php if(isset($_SESSION) && !empty($_SESSION['role'])): ?>
					<?php if($_SESSION['role'] == "Admin"): ?>
						<a href=?page=edit&type=blog&id=<?php echo $blog['id']; ?>><div class="button edit">Edit</div></a>
						<a href=?page=delete&type=blog&id=<?php echo $blog['id']; ?>><div class="button delete">Delete</div></a>
					<?php endif; ?>
				<?php endif; ?>
		</div>
		<div class="boxcontent">
			<p><?php echo $blog['content']; ?></p>
		</div>
	</div><br>
<?php endforeach; ?>
<br>
