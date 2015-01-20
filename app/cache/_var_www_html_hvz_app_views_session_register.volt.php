<?php echo $this->tag->javascriptInclude('js/jquery-validate.js'); ?>

<h1>Register</h1>

<!-- 	This is the bootstrap version of the register form.
			The original can be found in register.volt.backup
-->

<?php echo $this->tag->form(array('session/register', 'role' => 'form', 'id' => 'registration_form')); ?>

	<input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"value="<?php echo $this->security->getToken() ?>"/>
	
		<div class="form-group">
			<label for="firstname">First Name</label>
			<?php echo $this->tag->textField(array('firstname', 'size' => '40', 'class' => 'form-control')); ?>  
		</div>
	
		<div class="form-group">
			<label for="lastname">Last Name</label>
			<?php echo $this->tag->textField(array('lastname', 'size' => '40', 'class' => 'form-control')); ?>
		</div>
	
		<div class="form-group">
			<label for="email">E-mail</label>
			<?php echo $this->tag->textField(array('email', 'size' => '40', 'class' => 'form-control')); ?>
		</div>
	
		<div class="form-group">
			<label for="emailRetype">Confirm E-mail</label>
			<?php echo $this->tag->textField(array('emailRetype', 'size' => '40', 'class' => 'form-control')); ?>
		</div>
	
		<div class="form-group">
			<label for="username">Username</label>
			<?php echo $this->tag->textField(array('username', 'size' => '40', 'class' => 'form-control')); ?>
		</div>
		
		<div class="form-group">
			<label for="password">Password</label>
			<?php echo $this->tag->passwordField(array('password', 'size' => '40', 'class' => 'form-control')); ?>
		</div>
	
		<div class="form-group">
			<label for="passwordRetype">Confirm Password</label>
			<?php echo $this->tag->passwordField(array('passwordRetype', 'size' => '40', 'class' => 'form-control')); ?>
		</div>
	
	
		<?php echo $this->tag->submitButton(array('Register', 'class' => 'btn btn-default')); ?>
	 
</form>