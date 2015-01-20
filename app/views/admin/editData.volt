


<?= $this->tag->form("admin/editData/$title") ?>
	<input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"value="<?php echo $this->security->getToken() ?>"/>
	
	<textarea id="editor1" class="ckeditor" name="data" rows="50"><?= $currData ?></textarea>
	
</form>
{{ javascript_include("external/ckeditor/ckeditor.js") }}
{{ javascript_include("external/ckeditor/config.js") }}

<script>
CKEDITOR.replace( 'editor1', {
    extraPlugins: 'autogrow',
    autoGrow_minHeight: 250,
    //autoGrow_maxHeight: 600
    
});
</script>


