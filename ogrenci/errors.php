<?php  if (count($errors) > 0) : ?>
  <ul class="mb-4">
  	<?php foreach ($errors as $error) : ?>
  	  <li class="text-danger font-weight-bold"><?php echo $error ?></li>
  	<?php endforeach ?>
      </ul>
<?php  endif ?>