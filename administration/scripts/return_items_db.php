<?php

$arr = array(1,2,3,4);
reset($arr);
$key = key($arr);
echo '
<script>
	console.log('.print_r($arr).');	
</script>
';

?>