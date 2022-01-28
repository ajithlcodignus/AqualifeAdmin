<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<body>

<form action="<?php echo base_url() ?>mobile/favourites" method="post">
	Name: <input type="text" name="userId" value="1" /><br>
	E-mail: <input type="text" name="itemId" value="8" /><br>
	flag: <input type="text" name="favouriteFlag" value="1" /><br>
	<input type="submit">
</form>

</body>
</html>