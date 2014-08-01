<?php 
class additionalDetailsBack extends Widget{

      public function __construct() {

        parent::widget ();

    }

    function run($ext = array())
    {
        $model = isset($ext['model']) ? $ext['model'] : array();   
        $modelName = isset($ext['modelName']) ? $ext['modelName'] : 'model';
        $ckeditor =  isset($ext['ckeditor']) ? $ext['ckeditor'] : array();
?>    	
				<div class="form-group">
		        	<label for="" class="col-sm-3">Surrender Policy</label>
		            <div class="col-sm-9">
		             	<span class="icon glyphicon glyphicon-star"></span>
		                <textarea class="form-control ckeditor"  rows="5" name="<?php echo $modelName;?>[surrender_policy]"><?php echo array_key_exists( 'surrender_policy',$model) ? $model['surrender_policy'] : '';?></textarea>
		                	<?php echo display_ckeditor($ckeditor); ?>
		            </div>
		  	    </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-3">Revive Policy</label>
                    <div class="col-sm-9">
                    	<span class="icon glyphicon glyphicon-star"></span>
                        <textarea class="form-control ckeditor"  rows="5" name="<?php echo $modelName;?>[revive_policy]"><?php echo array_key_exists( 'revive_policy',$model) ? $model['revive_policy'] : '';?></textarea>
                        <?php echo display_ckeditor($ckeditor); ?>
                   	</div>
                </div>
                
	             <div class="form-group">
	                    <label for="" class="col-sm-3">Loan</label>
	                    <div class="col-sm-9">
	                    	<span class="icon glyphicon glyphicon-star"></span>
	                        <textarea class="form-control ckeditor"  rows="5" name="<?php echo $modelName;?>[loan]"><?php echo array_key_exists( 'loan',$model) ? $model['loan'] : '';?></textarea>
                        <?php echo display_ckeditor($ckeditor); ?>
                   	</div>
                </div>
                
	             <div class="form-group">
	                    <label for="" class="col-sm-3">Tax Benefits</label>
	                    <div class="col-sm-9">
	                    	<span class="icon glyphicon glyphicon-star"></span>
	                        <textarea class="form-control ckeditor"  rows="5" name="<?php echo $modelName;?>[tax_benefits]"><?php echo array_key_exists( 'tax_benefits',$model) ? $model['tax_benefits'] : '';?></textarea>
                        <?php echo display_ckeditor($ckeditor); ?>
                   	</div>
                </div>
	                
<?php                 
	}
}
?>