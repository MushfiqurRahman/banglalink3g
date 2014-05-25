<?php echo $this->element('info_box');?>
<!-- Dashboard: Content -->
<div class="row-fluid">

        <!-- Dashboard: Box -->
        <div class="span8">

            <!-- Dashboard: Top Bar -->
            <div class="top-bar">
                    <ul class="tab-container">
                      <li class="active"><a href="#"><i class="icon-bar-chart"></i> For More Information</a></li>
                    </ul>
            </div>
            <!-- / Dashboard: Top Bar -->

            <!-- Dashboard: Drop downs -->
            <div class="well">

                <div style="margin-top: 10px;">

                    <!-- Forms: Form -->
                    <?php echo $this->Form->create('Survey',array('type' => 'post',
                        'action' => 'report', 'class' => 'form-horizontal'));?>
<!--                    <form class="form-horizontal">-->

                    <div class="control-group">
                    <label class="control-label">Select Region</label>
                    <div class="controls">
                        <?php echo $this->Form->input('region_id', array(
                            'type' => 'select', 'options' => $regions, 
                            'class' => 'span6 m-wrap', 'id' => 'regionId',
                            'empty'  => 'All Region', 'label' => false));?>

                    </div>
                    </div>

                    <div class="control-group">
                    <label class="control-label">Select Area</label>
                    <div class="controls">
                        <?php echo $this->Form->input('area_id', array(
                            'type' => 'select', 'options' => array(), 
                            'class' => 'span6 m-wrap', 'id' => 'areaId',
                            'empty'  => 'All Area', 'label' => false));?>

                    </div>
                    </div>

                    <div class="control-group">
                    <label class="control-label">Select Team</label>
                    <div class="controls">
                        <?php echo $this->Form->input('location_id', array(
                            'type' => 'select', 'options' => array(), 
                            'class' => 'span6 m-wrap', 'id' => 'locationId',
                            'empty'  => 'All Location', 'label' => false));?>

                    </div>
                    </div>

                    <!-- Forms: Form Actions -->
                    <div class="form-actions">
                        
                        <button type="submit" class="btn btn-warning"> Submit</button>
                        <button type="button" class="btn"> Cancel</button>
                        <?php echo $this->Form->end();?>
                    </div>
                    <!-- / Forms: Form Actions -->

                    </form> 
                    <!-- / Forms: Form -->  
                </div>

            </div>
            <!-- / Dashboard: Content -->

        </div>
        <!-- / Dashboard: Box -->

        <!-- Pie: Box -->
        <div class="span4">
                <!-- Pie: Top Bar -->
                <div class="top-bar">
                        <h3><i class="icon-money"></i> By Team Contribution</h3>
                </div>
                <!-- / Pie: Top Bar -->

                <!-- Pie: Content -->
                <div class="well">
                        <div class="pie pie2"></div>
                </div>
                <!-- / Pie: Content -->
        </div>
        <!-- / Pie -->
</div>
<!-- / Drop downs and Pie -->

<script>
	var base_url = '<?php echo Configure::read('base_url');?>';
	$(document).ready(function(){	
		$("#regionId").change(function(e){
			find_areas( $(this).val());
		});
                
                $("#areaId").change(function(){                    
                    find_locations( $(this).val());	
                });
		
		function find_areas( regionId ){                    
			$.ajax({
				url: base_url+'areas/ajax_area_list',
				type: 'post',
				data: 'region_id='+regionId,
				success: function(response){					
					var areas = $.parseJSON(response);
					
                                        $("#areaId").html('<select name="data[Area][id]" id="areaId"><option value="">All Area</option></select>');
                                        $("#locationId").html('<select name="data[Location][id]" id="locationId"><option value="">All Location</option></select>');
					$.each(areas, function(ind,val){                                             
						$('#areaId').append('<option value="'+ind+'">'+val+'</option>');						                                                
					});
                                        $("#areaId").trigger("chosen:updated");
				}
			});
		}
                
                function find_locations( areaId){                   
                    $.ajax({
                            url: base_url+'locations/ajax_location_list',
                            type: 'post',
                            data: 'area_id='+areaId,
                            success: function(response){                                
                                    var locations = $.parseJSON(response);
                                    
                                    $("#locationId").html('<select name="data[Location][id]" id="locationId"><option value="">All Location</option></select>');
                                    $.each(locations, function(ind,val){                                        
                                            $('#locationId').append('<option value="'+ind+'">'+val+'</option>');						
                                            
                                    });
                                    $("#locationId").trigger("chosen:updated");
                            }
                    });                
                }
	});
</script>