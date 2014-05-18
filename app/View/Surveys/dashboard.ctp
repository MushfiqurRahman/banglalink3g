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
                                        <form class="form-horizontal">

                                        <div class="control-group">
                                        <label class="control-label">Select Region</label>
                                        <div class="controls">
                                                <select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1">
                                                        <option value="">Select...</option>
                                                        <option value="Region 1">Region 1</option>
                                                        <option value="Region 2">Region 2</option>
                                                        <option value="Region 3">Region 3</option>
                                                        <option value="Region 4">Region 4</option>
                                                </select>
                                        </div>
                                        </div>

                                        <div class="control-group">
                                        <label class="control-label">Select Area</label>
                                        <div class="controls">
                                                <select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1">
                                                        <option value="">Select...</option>
                                                        <option value="Area 1">Area 1</option>
                                                        <option value="Area 2">Area 2</option>
                                                        <option value="Area 3">Area 3</option>
                                                        <option value="Area 4">Area 4</option>
                                                </select>
                                        </div>
                                        </div>

                                        <div class="control-group">
                                        <label class="control-label">Select Team</label>
                                        <div class="controls">
                                                <select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1">
                                                        <option value="">Select...</option>
                                                        <option value="Team 1">Team 1</option>
                                                        <option value="Team 2">Team 2</option>
                                                        <option value="Team 3">Team 3</option>
                                                        <option value="Team 4">Team 4</option>
                                                </select>
                                        </div>
                                        </div>

                                        <!-- Forms: Form Actions -->
                                        <div class="form-actions">
                                                <button type="submit" class="btn btn-warning"> Submit</button>
                                                <button type="button" class="btn"> Cancel</button>
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