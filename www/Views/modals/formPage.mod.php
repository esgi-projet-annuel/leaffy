
<?php $data = ($config["config"]["method"]=="POST")?$_POST:$_GET; ?>

	<?php if( !empty($config["errors"])):?>
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

		<div class="form-Setting">
    	<div class="form-label-back">
      	<?php if($value["type"]=="text"):?>
          <label for="<?php echo $value["id"];?>"> <?php echo $value["placeholder"];?> </label>
      		<input type="<?php echo $value["type"];?>"
    				name="<?php echo $key;?>"
    				placeholder="<?php echo  $value["placeholder"];?>"
    				<?php echo ($value["required"])?'required="required"':'';?>
    				id="<?php echo $value["id"];?>"
    				class="<?php echo $value["class"];?>"
    				value="<?php echo $value["value"]??''?>">

					<?php elseif($value["type"]=="textarea"):?>
					<label for="<?php echo $value["id"];?>"> <?php echo $value["placeholder"];?> </label>
					<textarea name="<?php echo $key;?>"
					<?php echo ($value["required"])?'required="required"':'';?>
					id="<?php echo $value["id"];?>"
					class="<?php echo $value["class"];?>" placeholder="<?php echo $value["placeholder"];?>"><?php echo $value["value"]??''?></textarea>

					<?php elseif($value["type"]=="file"):?>
					<label for="<?php echo $value["id"];?>"> <?php echo $value["placeholder"];?> </label>
					<input type="<?php echo $value["type"];?>"
    				name="<?php echo $key;?>"
    				<?php echo ($value["required"])?'required="required"':'';?>
    				id="<?php echo $value["id"];?>"
    				class="<?php echo $value["class"];?>"
    				value="<?php echo $value["value"]??''?>">

                    <?php elseif($value["type"]=="hidden"):?>
                    <input type="<?php echo $value["type"];?>" name="<?php echo $key;?>" value="<?php echo $value["value"]??''?>">
      	<?php endif;?>
    	 </div>
    </div>

      <?php endforeach;?>

    <div class="d-flex form-Setting">
      <input type="submit" class="form-control button-back button-back--add" value="<?php echo $config["config"]["submit"];?>">
    </div>
  </form>
