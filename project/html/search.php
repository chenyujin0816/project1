<?php 
	error_reporting(0);
	session_start(); 
	include("conn.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>社团学生组织招新平台</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/main.css" type="text/css">
	<link rel="stylesheet" href="../css/home.css" type="text/css">
</head>
<body>
	<div id="header">
		<div class="title">
			<p>社团学生组织招新平台</p>
		</div>
		<div class="search">
			<form action="search.php" method="post">
	            <input type="text" placeholder="请输入社团/学生组织名称..." name="searchContent" id="searchContent" />
	            <input type="submit" name="search" value="搜索" id="search">
            </form>
        </div>
        <div class="login">
        	<?php if($_SESSION['user'])
        	{ 
        		echo '你好，'.$_SESSION['user'];
        	?>
        	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
        	<a href="logout.php">登出</a>
        	<?php }else{ ?>
        	<a href="login.php">登录</a>
        	<a href="register.php">注册</a>
        	<?php } ?>
        </div>
	</div>
	<div class="nav">
		<ul class="menubar">
			<li class="menu-value"><a href="index.php">首页</a></li>
			<li class="" ><a href="info.php">浏览社团</a></li>
			<li class="" >
				<?php if($_SESSION['is_logged'] and $_SESSION['is_org']){ ?>
					<a href="<?php echo $orgpage ?>">我的社团</a>
				<?php }elseif($_SESSION['is_logged'] and !$_SESSION['is_org'] and isset($myorg)){ ?>
					<a href="<?php echo $myorg ?>">我的社团</a>
				<?php }else{ ?>
					<a href="mypage.php">我的社团</a>
				<?php } ?>
			</li>
			<li class="" ><a href="apply.php">申请</a></li>
		</ul>
	</div>
	<div id="result">
		<?php 
			if (isset($_POST['search'])) 
			{
				$searchContent=$_POST['searchContent'];
				$sql="SELECT * FROM account_org WHERE org_name='$searchContent'";
				$query = mysqli_query($conn,$sql);
				$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
				$searchResult=$row['org_main_page'];
				if(isset($searchResult))
				{
					echo "<a href='$searchResult'><h1>$searchContent</h1></a>";
				}
				else
				{
					echo "<h1>没有结果！</h1>";
				}
			} 
		?>
	</div>
</body>
</html>