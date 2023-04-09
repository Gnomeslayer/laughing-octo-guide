<?php
if(!isset($_SESSION))
{
    header("Location: ?page=home");
}elseif(isset($_SESSION) && empty($_SESSION))
{
    header("Location: ?page=home");
}elseif(isset($_SESSION) && $_SESSION['role'] != "Admin")
{
    header("Location: ?page=home");
}
?>
<div class="box">
		<div class="boxtitle">
			<h2>Are you sure you wish to delete this post?</h2>
		</div>
		<div class="boxcontent">
		<div class="buttoncontainer">
            <div class="buttoncontainer">
				<a href="?page=confirmdelete&role=Admin&type=<?php echo $_GET['type']; ?>&id=<?php echo $_GET['id']; ?>"><div class="button">Delete</div></a>
				<a href="?page=home"><div class="button">Go back</div></a>
                <?php
                    if($_GET['type'] == "blog")
                    {
                        $blog = getsingleblog($_GET['id']);
                    }elseif($_GET['type'] == "nsfw")
                    {
                        $blog = getsinglensfw($_GET['id']);
                    }elseif($_GET['type'] == "thing")
                    {
                        $blog = getsinglething($_GET['id']);
                    }
                ?>
			</div>
		</div>
		</div>
	</div><br>
    <div class="box">
    <div id="postid" hidden="False"><?php echo $_GET['id']; ?></div><div id="type" hidden="True"><?php echo $_GET['type']; ?></div>
		<div class="boxtitle">
			<h2>Create a new things entry</h2>
		</div>
		<div class="boxcontent" id="mybox">
            <h1>Title of Thing</h1>
            <div contenteditable="False" class="formtitle" id="formtitle"><?php echo $blog[0]['title']; ?></div>
            <?php if($_GET['type'] == "thing"): ?>
                <h1>Link to thing</h1>
                <div contenteditable="False" class="formlink" id="formlink"><?php echo $blog[0]['thing']; ?></div>
                <h1>Link to github</h1>
                <div contenteditable="False" class="formgithub" id="formgithub"><?php echo $blog[0]['github']; ?></div>
            <?php elseif($_GET['type'] == "nsfw"): ?>
                <h1>Link to NSFW</h1>
                <div contenteditable="False" class="formlink" id="formlink"><?php echo $blog[0]['nsfw']; ?></div>
                <h1>Link to github</h1>
                <div contenteditable="False" class="formgithub" id="formgithub"><?php echo $blog[0]['github']; ?></div>
            <?php endif; ?>
            <h1>Content</h1>
            <div contenteditable="False" class="formcontent" id="formcontent"><?php echo $blog[0]['content']; ?></div><br>
            
		</div>
        <?php if($_GET['type'] == "thing" | $_GET['type'] == "nsfw"): ?>
            <button onclick="submitother()">Submit!</button>
        <?php elseif($_GET['type'] == "blog"): ?>
            <button onclick="submitblog()">Submit!</button>
        <?php endif; ?>
	</div>
<br>