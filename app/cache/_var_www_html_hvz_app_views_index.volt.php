<!DOCTYPE html>
<html>
	<head>
	
		<?php echo $this->tag->stylesheetLink('css/bootstrap.min.css'); ?>
		<?php echo $this->tag->stylesheetLink('css/main.css'); ?>
		<?php echo $this->tag->stylesheetLink('css/jquery.dataTables.min.css'); ?>

		<?php echo $this->tag->getTitle(); ?>

		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	</head>
	<body>
	
		<!-- Main layout moved to /layout/main.volt -->
		
		
		
		<?php echo $this->getContent(); ?>
		

		
		<!-- <?php echo $this->tag->javascriptInclude('js/jquery-2.1.1.min.js'); ?> -->
		<?php echo $this->tag->javascriptInclude('http://code.jquery.com/jquery-1.11.1.min.js'); ?>
		<?php echo $this->tag->javascriptInclude('js/bootstrap.min.js'); ?>
		<?php echo $this->tag->javascriptInclude('js/main.js'); ?>
		<?php echo $this->tag->javascriptInclude('js/jquery.dataTables.min.js'); ?>

	</body>
</html>