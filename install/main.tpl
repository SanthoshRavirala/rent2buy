<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Install</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <?php foreach($error as $er) { ?>
		<div class="alert alert-danger">
		   <?php echo $er;?>
		</div>
	<?php } ?>
	<form class="form-horizontal" role="form" action="" method="post">
		<h2>Installation</h2>
		
		<div class="form-group">
			<label for="db_server" class="col-sm-3 control-label">Database server</label>
			<div class="col-sm-9">
				<input type="text" name="db_server" id="db_server" value="<?php echo $db_server;?>" placeholder="Database server" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="db_user" class="col-sm-3 control-label">Database user name</label>
			<div class="col-sm-9">
				<input type="text" name="db_user" id="db_user" value="<?php echo $db_user;?>" placeholder="Database user name" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="db_password" class="col-sm-3 control-label">Database password</label>
			<div class="col-sm-9">
				<input type="text" name="db_password" id="db_password" value="<?php echo $db_password;?>" placeholder="password" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="db_name" class="col-sm-3 control-label">Database name</label>
			<div class="col-sm-9">
				<input type="text" name="db_name" id="db_name" value="<?php echo $db_name;?>" placeholder="Database name" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="region" class="col-sm-3 control-label">Db driver</label>
			<div class="col-sm-9">
				<select id="driver" name="driver" class="form-control">
					<option value="mysqli" <?php if($driver == 'mysqli') echo 'selected';?>>MySqli</option>
					<option value="pdo" <?php if($driver == 'pdo') echo 'selected';?>>PDO</option>				  				 
				</select> 
			</div>
		</div> <!-- /.form-group -->	
		
		<div class="form-group">
			<label for="email" class="col-sm-3 control-label">Admin email</label>
			<div class="col-sm-9">
				<input type="email" name="email" id="email" value="<?php echo $email;?>" placeholder="email" class="form-control">
			</div>
		</div>
		
		<div class="form-group">
			<label for="password" class="col-sm-3 control-label">Admin password</label>
			<div class="col-sm-9">
				<input type="password" name="password" id="password" value="<?php echo $password;?>" placeholder="password" class="form-control">
			</div>
		</div>
		
		
		<div class="form-group">
			<div class="col-sm-9 col-sm-offset-3">
				<button type="submit" class="btn btn-primary btn-block">Install</button>
			</div>
		</div>
	</form> <!-- /form -->
</div>
</body>