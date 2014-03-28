
<?php
/* @var $this YiiClassController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<ul class="tree">
<?php
foreach ($data as $item) {
	echo <<<EOF
	<li>
		{$item['name']}
		<a title="construct" onclick="return ajax_get_construct(this, '{$item['name']}');">show</a>
	</li>
EOF;
}
$ajaxUrl = Yii::app()->createUrl('yiiClass/ajax');
?>
</ul>
<script type="text/javascript">
	var ajaxing = false;
	function ajax_get_construct(select, class_name) {
		if (ajaxing) {
			return false;
		}
		ajaxing = true;
		var obj = $(select);
		if (obj.html() == 'hide') {
			obj.html("show")
			$(select).next('ul').hide()
		} else if ($(select).next('ul').length > 0) {
			$(select).next('ul').show();
			obj.html('hide');
		} else {
			$.ajax({
				type:"get",
				url:"<?php echo $ajaxUrl;?>",
				data: {"parentClassName":class_name},
				dataType: "json",
				async: false,
				success: function(result){

					var html = "<ul>";
					if (result.length > 0) {
						result.forEach(function(item, index, array){
							html += '<li>'+item+' <a title="construct" onclick="return ajax_get_construct(this, \''+item+'\');">show</a></li>'
						})
					} else {
						html += 'none';
					}
					html += '</ul>';
					$(select).after(html);
					obj.html('hide');
				}
			});
		}
		ajaxing = false;
		return false;
	}
</script>
<style>
.tree, .tree ul {list-style: none}
.tree a {cursor: pointer;}
.tree {font-size:16px;}
</style>