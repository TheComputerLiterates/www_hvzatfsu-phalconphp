<h1>Admin</h1>
<p><b>This controller is purely for testing and is not going to be here when we are done</b></p><br><br>

  {{ form("admin/index", "role":"form") }}
	<input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"value="<?php echo $this->security->getToken() ?>"/>

	{{ submit_button("Update ACL", "class":"btn btn-default") }}

</form>

<br>
<a href="{{ url("admin/editData/body") }}">Edit Data Below</a>
<br>

<h3>START DATA</h2>
<table width="100%" border="2"><tr><td>
<?= $body ?>
</td></tr></table>
<h3>END DATA </h2>