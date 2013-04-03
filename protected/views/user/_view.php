<div class="view row-fluid">
  <div class="span11">
  
    <div class="span12 name">
      <b><?php echo CHtml::link(CHtml::encode($data->fullNameLastFirst),array('view','id'=>$data->id)); ?></b>
    </div>
    
    <div class="span4">
      <?php echo CHtml::mailto($data->email); ?>
    </div>
  
    <div class="span4">
      <label><?php echo CHtml::encode($data->getAttributeLabel('careerAcct')); ?>:</label>
      <?php echo CHtml::encode($data->careerAcct); ?>
    </div>
  
    <div class="span4">
      <label><?php echo CHtml::encode($data->getAttributeLabel('puid')); ?>:</label>
      <?php echo CHtml::encode($data->puid); ?>
    </div>
  
    <div class="span12 last-login">
    <?php echo CHtml::encode($data->getAttributeLabel('lastLogin')); ?>: 
    <?php echo CHtml::encode($data->lastLogin); ?>
    </div>
	</div>
</div>