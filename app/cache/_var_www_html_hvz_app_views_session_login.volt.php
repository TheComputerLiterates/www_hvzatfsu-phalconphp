<h1>Login</h1>

<!--  Overall, the changes were mostly cosmetic.
      the role = "form" is for bootstrap form
      The divs with class="form-group" define groups of elements in the form -->

<?php echo $this->tag->form(array('session/login', 'role' => 'form')); ?>
  
  <!-- Did not bother adding bootstrap to this element -->
	<input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"value="<?php echo $this->security->getToken() ?>"/>

  <div class="form-group">
	  <label for="emailUsername">Username/Email</label>
    <?php echo $this->tag->textField(array('emailUsername', 'size' => '30', 'class' => 'form-control')); ?>
  </div>

  <div class="form-group">
	  <label for="password">Password</label>
    <?php echo $this->tag->passwordField(array('password', 'size' => '30', 'class' => 'form-control')); ?>
  </div>

  <!-- class = "btn btn-default" for bootstrap button-->
  <?php echo $this->tag->submitButton(array('Login', 'class' => 'btn btn-default')); ?>

</form>