<h1>Login</h1>

<!--  Overall, the changes were mostly cosmetic.
      the role = "form" is for bootstrap form
      The divs with class="form-group" define groups of elements in the form -->

{{ form("session/login", "role":"form") }}
  
  <!-- Did not bother adding bootstrap to this element -->
	<input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"value="<?php echo $this->security->getToken() ?>"/>

  <div class="form-group">
	  <label for="emailUsername">Username/Email</label>
    {{ text_field("emailUsername", "size":"30", "class":"form-control") }}
  </div>

  <div class="form-group">
	  <label for="password">Password</label>
    {{ password_field("password", "size":"30", "class":"form-control") }}
  </div>

  <!-- class = "btn btn-default" for bootstrap button-->
  {{ submit_button("Login", "class":"btn btn-default") }}

</form>