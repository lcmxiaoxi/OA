<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insert title here</title>
</head>
<body>
<form action="<?php echo U('addOk');?>" method="post">
学号:<input type="text" name="no"></input><br>
姓名:<input type="text" name="name"></input><br>
密码:<input type="text" name="passwd"></input><br>
密码重复:<input type="text" name="re-passwd"></input><br>
年龄:<input type="text" name="age"></input><br>
性别:<input type="text" name="sex"></input><br>
系别:<input type="text" name="dept"></input><br>
<input type="submit"></input>
</form>	
</body>
</html>