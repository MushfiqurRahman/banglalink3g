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
<!--                    <form class="form-horizontal">-->
            <?php 
                echo $this->Form->create('Survey', array(
                    'type' => 'post',
                    'action' => 'report'
                ));
            ?>
            <div class="control-group">
                <label class="control-label">Select Location</label>
                <div class="controls">
                    <?php
                        echo $this->Form->input('location_id', array(
                            'type' => 'select',
                            'options' => $locations,
                            'class' => 'span6 m-wrap',
                            'empty' => 'Select Location',
                            'label' => false
                        ));
                    ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="datepicker">Select Date Range</label>
                <div class="controls">
                        <input type="text" id="startDate" name="data[Survey][start_date]" placeholder="..." class="span3">

                        <input type="text" id="endDate" name="data[Survey][end_date]" placeholder="..." class="span3">
                </div>
            </div>

            <!-- Forms: Form Filter Options -->
            <div class="control-group">
                <label class="control-label" for="inputDate">Filter by</label>
                <div class="controls">
                    <?php 
                        echo $this->Form->input('age', array(
                            'type' => 'select',
                            'label' => false,
                            'options' => array(
                                '10:15' => '10 - 15',
                                '15:20' => '15 - 20',
                                '20:25' => '20 - 25',
                                '25:30' => '25 - 30',
                                '30:30' => '30+'
                            ),
                            'empty' => 'Select Age Group',
                            'class' => 'span3',
                            'div' => false
                        ));

                        echo $this->Form->input('occupation_id', array(
                            'type' => 'select',
                            'options' => $occupations,
                            'class' => 'span6 m-wrap',
                            'empty' => 'Select Occupation',
                            'label' => false,
                            'class' => 'span3',
                            'div' => false
                        ));

                        echo $this->Form->input('is_3g', array(
                            'type' => 'select',
                            'options' => array('Yes' => 'Yes', 'No' => 'No'),
                            'class' => 'span6 m-wrap',
                            'empty' => 'Select 3g Pack Status',
                            'label' => false,
                            'class' => 'span3',
                            'div' => false
                        ));

                        echo $this->Form->input('package_id', array(
                            'type' => 'select',
                            'options' => $packages,
                            'class' => 'span6 m-wrap',
                            'empty' => 'Select Package',
                            'class' => 'span3',
                            'label' => false,
                            'div' => false
                        ));
                        
                        
                        $url_params = array();

                        if( isset($this->data['start_date']) ){
                            $url_params['start_date'] = $this->data['start_date'];
                        }
                        if( isset($this->data['end_date']) ){
                            $url_params['end_date'] = $this->data['end_date'];
                        }
                        if( isset($this->data['Region']['id']) && $this->data['Region']['id']){
                            $url_params['region_id'] = $this->data['Region']['id'];
                        }
                        if( isset($this->data['Area']['id']) && $this->data['Area']['id']){
                            $url_params['area_id'] = $this->data['Area']['id'];
                        }
                        if( isset($this->data['House']['id']) && $this->data['House']['id']){
                            $url_params['house_id'] = $this->data['House']['id'];
                        }
                        if( isset($this->data['occupation_id']) ){
                            $url_params['occupation_id'] = $this->data['occupation_id'];
                        }
                        if( isset($this->data['age_limit']) ){
                            $url_params['age_limit'] = $this->data['age_limit'];
                        }
            //            if( isset($this->data['adc']) ){
            //                $url_params['adc'] = $this->data['adc'];
            //            }
                        if( isset($this->data['brand_id']) ){
                            $url_params['brand_id'] = $this->data['brand_id'];
                        }
                        $this->Paginator->options(array('url' => $url_params));  
                    ?>
                </div>
            </div>
            <!-- / Forms: Filter Options -->

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
                                                <th>Occupation</th>
                                                <th class="center">Age</th>
                                                <th class="center">Gender</th>
                                                <th>Mobile No</th>
                                                <th class="center">Monthly Recharge</th>
                                                <th class="center">Monthly Internet Usage</th>
                                                <th>Handset Type</th>
                                                <th>Handset Brand</th>
                                                <th class="center">Buying 3G Pack</th>
                                                <th class="center">New Package</th>
                                                <th>Date &amp; Time</th>
                                        </tr>
                                </thead>
                                <tbody class="table-bordered">
                                <?php
                                    if(count($Surveys)>0){
                                        $i = 1;
                                        foreach ($Surveys as $survey){ //pr($survey);exit;
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
                                            <td><?php echo $survey['Occupation']['title'];?></td>
                                            <td class="center"><?php echo $survey['Survey']['age'];?></td>
                                            <td><?php echo $survey['Survey']['is_female']?'Female':'Male';?></td>
                                            <td><?php echo $survey['Survey']['mobile'];?></td>
                                            <td class="center"><?php echo $survey['Survey']['recharge_amount'];?></td>
                                            <td class="center"><?php echo $survey['Survey']['monthly_internet_usage'];?></td>
                                            <td class="center"><?php echo $survey['Survey']['is_smart_phone']==true? 'Smart Phone': 'Regular Phone';?></td>
                                            <td><?php echo $survey['MobileBrand']['title'];?></td>
                                            <td class="center"><?php echo $survey['Survey']['is_3g']==true ? 'Yes': 'No';?></td>                                            
                                            <td><?php echo $survey['Package']['title'];?></td>                                            
                                            <td><?php echo $survey['Survey']['date_time'];?></td>
                                        </tr>
                                <?php                                
                                        }
                                    }else {
                                        
                                    }
                                ?>              
                                        </tr>
                                        
                                </tbody>
                        </table>
                            <div class="paging">
                            <?php
                                echo $this->Paginator->counter(array(
                                'format' => __('Showing {:current} records out of {:count} total')
                                ));
                                echo '<br/>';
                                    echo $this->Paginator->prev('< ' . __('previous | '), array(), null, array('class' => 'prev disabled'));
                                    echo $this->Paginator->numbers(array('separator' => ' | '));
                                    echo $this->Paginator->next(__(' | next') . ' >', array(), null, array('class' => 'next disabled'));
                            ?>
                            </div>
                        </div>

                        <br />
                        <?php echo $this->Form->create('Survey', array('type' => 'post','action' => 'export_report'))?>
                        <button type="submit" class="btn btn-inverse"> Export to Excel</button>
                        <?php echo $this->Form->end();?>
                </div>
                <!-- / Pie: Content -->

        </div>
        <!-- / Pie -->

</div>
<!-- / Live Stats -->