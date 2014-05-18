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
                                        <tr class="odd gradeX">
                                                <td>1</td>
                                                <td>Dhaka</td>
                                                <td>Kawran Bazar</td>
                                                <td class="center">Team 1</td>
                                                <td>Location 1</td>
                                                <td>BP Name 1</td>
                                                <td>1027</td>
                                                <td>Shariar Hossain</td>
                                                <td>01918828927</td>
                                                <td>Business</td>
                                                <td class="center">27</td>
                                                <td class="center">Yes</td>
                                                <td>2GB</td>
                                                <td>Smart Phone</td>
                                                <td>Samsung</td>
                                                <td>2014-03-31 18:05:36</td>
                                        </tr>
                                        <tr class="even gradeC">
                                                <td>2</td>
                                                <td>Chittagong</td>
                                                <td>Bohoddar Hat</td>
                                                <td class="center">Team 3</td>
                                                <td>Location 2</td>
                                                <td>BP Name 34</td>
                                                <td>1055</td>
                                                <td>Kabir Hossain</td>
                                                <td>01918348953</td>
                                                <td>Student</td>
                                                <td class="center">22</td>
                                                <td class="center">No</td>
                                                <td>50MB</td>
                                                <td>Smart Phone</td>
                                                <td>Nokia</td>
                                                <td>2014-03-31 14:05:36</td>
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