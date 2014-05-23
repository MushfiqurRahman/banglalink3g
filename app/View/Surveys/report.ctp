<?php echo $this->element('info_box');?>
<!-- Query Panel (Filtering Drop Downs) -->
<div class="row-fluid">

        <!-- Box -->
        <div class="span12">

                <!-- Top Bar -->
                <div class="top-bar">
                        <h3><i class="icon-user"></i> Filter Panel</h3>
                </div>
                <!-- / Top Bar -->

                <!-- Content -->
                <div class="well">

                <!-- Forms: Form -->
                        <form class="form-horizontal">

                                <div class="control-group">
                                        <label class="control-label">Select Location</label>
                                        <div class="controls">
                                                <select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1">
                                                        <option value="">Select...</option>
                                                        <option value="Location 1">Location 1</option>
                                                        <option value="Location 2">Location 2</option>
                                                        <option value="Location 3">Location 3</option>
                                                        <option value="Location 4">Location 4</option>
                                                </select>
                                        </div>
                                </div>

                                <div class="control-group">
                                        <label class="control-label" for="datepicker">Select Date Range</label>
                                        <div class="controls">
                                                <input type="text" id="startDate" placeholder="..." class="span3">

                                                <input type="text" id="endDate" placeholder="..." class="span3">
                                        </div>
                                </div>

                                <!-- Forms: Form Filter Options -->
                                <div class="control-group">
                                        <label class="control-label" for="inputDate">Filter by</label>
                                        <div class="controls">
                                                <select class="span3">
                                                        <option value="number">Select Age Group</option>
                                                        <option value="10 - 15">10 - 15</option>
                                                        <option value="15 - 20">15 - 20</option>
                                                        <option value="20 - 25">20 - 25</option>
                                                        <option value="25 - 30">25 - 30</option>
                                                        <option value="30+">30+</option>
                                                </select>
                                                <select class="span3">
                                                        <option value="Month">Select Occupation</option>
                                                        <option value="Service">Service</option>
                                                        <option value="Business">Business</option>
                                                        <option value="Student">Student</option>
                                                        <option value="Others">Others</option>
                                                </select>
                                                <select class="span3">
                                                        <option value="Year">Select 3G Pack Status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                </select>
                                                <select class="span3">
                                                        <option value="Year">Select 3G Package</option>
                                                        <option value="Yes">20MB</option>
                                                        <option value="No">50MB</option>
                                                        <option value="Yes">1GB</option>
                                                        <option value="No">2GB</option>
                                                </select>
                                        </div>
                                </div>
                                <!-- / Forms: Filter Options -->

                                <!-- Forms: Form Actions -->
                                        <div class="form-actions">
                                                <button type="submit" class="btn btn-warning"> Submit</button>
                                                <button type="button" class="btn"> Cancel</button>
                                        </div>
                                        <!-- / Forms: Form Actions -->

                                        </form> 
                                        <!-- / Forms: Form -->  
                </div>
                <!-- / Content -->

        </div>
        <!-- / Box -->

</div>
<!-- / Query Panel (Filtering Drop Downs) -->




<!-- Live Stats -->
<div class="row-fluid">

        <!-- Pie: Box -->
        <div class="span12">

                <!-- Pie: Top Bar -->
                <div class="top-bar">
                        <h3><i class="icon-eye-open"></i> 3G Feedback Report</h3>
                </div>
                <!-- / Pie: Top Bar -->

                <!-- Pie: Content -->
                <div class="well">
                        <div style="overflow: auto;">
                        <table class="table">
                                <thead class="table-bordered">
                                        <tr>
                                                <th>Sl</th>
                                                <th>Region</th>
                                                <th>Area</th>
                                                <th>Team</th>
                                                <th>Location</th>
                                                <th>BP Name</th>
                                                <th>BP Code</th>
                                                <th>Consumer Name</th>
                                                <th>Mobile No</th>
                                                <th>Occupation</th>
                                                <th class="center">Age</th>
                                                <th class="center">3G Pack</th>
                                                <th class="center">3G Package</th>
                                                <th>Handset Type</th>
                                                <th>Handset Brand</th>
                                                <th>Date &amp; Time</th>
                                        </tr>
                                </thead>
                                <tbody class="table-bordered">
                                <?php
                                    if(count($Surveys)>0){
                                        $i = 1;
                                        foreach ($Surveys as $survey){
                                            ?>                                
                                        <tr class="<?php echo $i%2==1? 'odd gradeX' : 'even gradeC';?>">    
                                            <td><?php echo $survey['Survey']['id'];?></td>
                                            <td><?php echo $survey['Location']['Area']['Region']['title'];?></td>
                                            <td><?php echo $survey['Location']['Area']['title'];?></td>
                                            <td class="center"><?php echo $survey['Promoter']['Team']['name'];?></td>
                                            <td><?php echo $survey['Location']['title'];?></td>
                                            <td><?php echo $survey['Promoter']['name'];?></td>
                                            <td><?php echo $survey['Promoter']['code'];?></td>
                                            <td><?php echo $survey['Survey']['name'];?></td>
                                            <td><?php echo $survey['Survey']['mobile'];?></td>
                                            <td><?php echo $survey['Occupation']['title'];?></td>
                                            <td class="center"><?php echo $survey['Survey']['age'];?></td>
                                            <td class="center"><?php echo $survey['Survey']['is_3g']==true ? 'Yes': 'No';?></td>
                                            <td><?php echo $survey['Package']['title'];?></td>
                                            <td><?php echo $survey['Survey']['is_smart_phone']==true? 'Smart Phone': 'Regular Phone';?></td>
                                            <td><?php echo $survey['MobileBrand']['title'];?></td>
                                            <td><?php echo $survey['Survey']['created'];?></td>
                                        </tr>
                                <?php                                
                                        }
                                    }else {
                                        
                                    }
                                ?>              
                                        </tr>
                                        
                                </tbody>
                        </table>
                        </div>

                        <br />
                        <button type="submit" class="btn btn-inverse"> Export to Excel</button>
                </div>
                <!-- / Pie: Content -->

        </div>
        <!-- / Pie -->

</div>
<!-- / Live Stats -->