<div id="bodyData" contenteditable="true">
	<?= $bodyData ?>
</div>


<?php echo $this->tag->javascriptInclude('external/ckeditor/ckeditor.js'); ?>
<?php echo $this->tag->javascriptInclude('external/ckeditor/config.js'); ?>
<script>
CKEDITOR.inline( 'bodyData', {
    extraPlugins: 'inlinesave'
    
    
});
var dump_file="http://globobug.com/hvz/admin/inline";

</script>