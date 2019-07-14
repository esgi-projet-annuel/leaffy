<?php $data = ($config["config"]["method"]=="POST")?$_POST:$_GET; ?>

	<?php global $user;
    if( !empty($config["errors"])):?>
		<div class="">
			<ul>
			<?php foreach ($config["errors"] as $errors):?>
				<li><?php echo $errors;?>
			<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>


  <form
      action="<?php echo $config["config"]["action"];?>"
      method="<?php echo $config["config"]["method"];?>"
      class="<?php echo $config["config"]["class"];?>"
      id="<?php echo $config["config"]["id"];?>">
    <?php foreach ($config["data"] as $key => $value):?>

		<div class="form-login">
    	<div class="form-label-login">
      	<?php if($value["type"]=="text" || $value["type"]=="email" || $value["type"]=="password" ):?>

      		<?php if($value["type"]=="password" ) unset($data[$key]); ?>


          <label for="<?php echo $value["id"];?>"> <?php echo $value["labelName"];?> </label>
      		<input type="<?php echo $value["type"];?>"
    				name="<?php echo $key;?>"
    				placeholder="<?php echo $value["placeholder"]; ?>"
    				<?php echo ($value["required"])?'required="required"':'';?>
    				id="<?php echo $value["id"];?>"
    				class="<?php echo $value["class"];?>"
    				value="<?php echo $value["value"]??''?>">

        <?php elseif($value["type"]=="hidden"):?>
            <input type="<?php echo $value["type"];?>" name="<?php echo $key;?>" value="<?php echo $user->id??''?>">

      	<?php endif;?>

    	 </div>
    </div>

    <?php endforeach;?>

    <div class="d-flex justify-content-around">
      <?php if( !empty($config["config"]["reset"])):?>
      	<input type="reset" class="form-control button-back button-back--add" value="<?php echo $config["config"]["reset"];?>">
  	  <?php endif;?>
      <input type="submit" class="form-control button-back button-back--add" value="<?php echo $config["config"]["submit"];?>">
    </div>
  </form>
