<?php
if($ongkir=='0'){ ?>
	<div style="clear:both"></div>
		
</div>
<?php } ?>

<script>
$(document).ready(function(){
$(".service").each(function(o_index,o_val){
	$(this).on("change",function(){
		var did=$(this).attr('data-id');
		var tarif=$("#tarif"+did).val();
		$("#ongkir").val(tarif);
		hitung();
	});
});
});
</script>