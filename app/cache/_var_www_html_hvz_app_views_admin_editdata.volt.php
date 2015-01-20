


<?= $this->tag->form("admin/editData/$title") ?>
	<input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"value="<?php echo $this->security->getToken() ?>"/>
	
	<textarea id="editor1" class="ckeditor" name="data" rows="50"><?= $currData ?></textarea>
	
</form>
<?php echo $this->tag->javascriptInclude('external/ckeditor/ckeditor.js'); ?>
<?php echo $this->tag->javascriptInclude('external/ckeditor/config.js'); ?>

<script>
CKEDITOR.replace( 'editor1', {
    extraPlugins: 'autogrow',
    autoGrow_minHeight: 250,
    //autoGrow_maxHeight: 600
    
});
</script>


