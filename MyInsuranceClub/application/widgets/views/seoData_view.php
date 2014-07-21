

                <div class="form-group">
                    <label for="" class="col-sm-3">SEO Title</label>
                    <div class="col-sm-9">
                    	<span class="icon glyphicon glyphicon-star"></span>
                        <input type="text" class="form-control charecterCount" required  placeholder="SEO Title" maxlength="90" id="seo_title" name="companyModel[seo_title]" maxlength="90" value="<?php echo array_key_exists( 'seo_title','$'.$modelName) ? '$'.$modelName['seo_title'] : '';?>" >
                         <span class="help-block" style="margin-bottom: -5px;">Max 90 chars | Recommended 60 chars</span>
                        <span class="help-block currentLength"><?php echo array_key_exists( 'seo_title','$'.$modelName) ? 'Current length: '.strlen('$'.$modelName['seo_title']).' chars' : '0'.' chars';?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-3">SEO Description</label>
                    <div class="col-sm-9">
                    	<span class="icon glyphicon glyphicon-star"></span>
                        <textarea class="form-control charecterCount" rows="5" required maxlength="250" id="seo_description" name="companyModel[seo_description]"><?php echo array_key_exists( 'seo_description','$'.$modelName) ? '$'.$modelName['seo_description'] : '';?></textarea>
                        <span class="help-block" style="margin-bottom: -5px;">Max 250 chars | Recommended 150 chars</span>
                        <span class="help-block currentLength"><?php echo array_key_exists( 'seo_description','$'.$modelName) ? 'Current length: '.strlen('$'.$modelName['seo_description']).' chars' : '0'.' chars';?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-3">SEO Keywords</label>
                    <div class="col-sm-9">
                    	<span class="icon glyphicon glyphicon-star"></span>
                        <textarea class="form-control charecterCount" rows="4" required  maxlength="175" id="seo_keywords" name="companyModel[seo_keywords]"><?php echo array_key_exists( 'seo_keywords','$'.$modelName) ? '$'.$modelName['seo_keywords'] : '';?></textarea>
                        <span class="help-block" style="margin-bottom: -5px;">Max 175 chars | Recommended 150 chars</span>
                        <span class="help-block currentLength"><?php echo array_key_exists( 'seo_keywords','$'.$modelName) ? 'Current length: '.strlen('$'.$modelName['seo_keywords']).' chars' : '0'.' chars';?></span>
                    </div>
                </div>