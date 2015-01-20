{{ javascript_include("js/jquery-validate.js") }}

<h1>Register</h1>

<!-- 	This is the bootstrap version of the register form.
			The original can be found in register.volt.backup
-->

{{ form("session/register", "role":"form", "id":"registration_form") }}

	<input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"value="<?php echo $this->security->getToken() ?>"/>
	
		<div class="form-group">
			<label for="firstname">First Name</label>
			{{ text_field("firstname", "size":"40", "class":"form-control") }}  
		</div>
	
		<div class="form-group">
			<label for="lastname">Last Name</label>
			{{ text_field("lastname", "size":"40", "class":"form-control") }}
		</div>
	
		<div class="form-group">
			<label for="email">E-mail</label>
			{{ text_field("email", "size":"40", "class":"form-control") }}
		</div>
	
		<div class="form-group">
			<label for="emailRetype">Confirm E-mail</label>
			{{ text_field("emailRetype", "size":"40", "class":"form-control") }}
		</div>
	
		<div class="form-group">
			<label for="username">Username</label>
			{{ text_field("username", "size":"40", "class":"form-control") }}
		</div>
		
		<div class="form-group">
			<label for="password">Password</label>
			{{ password_field("password", "size":"40", "class":"form-control") }}
		</div>
	
		<div class="form-group">
			<label for="passwordRetype">Confirm Password</label>
			{{ password_field("passwordRetype", "size":"40", "class":"form-control") }}
		</div>
	
	
		{{ submit_button("Register", "class":"btn btn-default") }}
	 
</form>