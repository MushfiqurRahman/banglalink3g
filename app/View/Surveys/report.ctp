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
                <label class="control-label">Select BP</label>
                <div class="controls">
                    <?php          
                    //pr($promoters);exit;
                        $selectedPromoterId = isset($this->data['Survey']['promoter_id']) ? $this->data['Survey']['promoter_id']:'';
                        echo $this->Form->input('promoter_id', array(
                            'type' => 'select',
                            'options' => $promoters,
                            'class' => 'span6 m-wrap',
                            'empty' => 'Select BP',
                            'selected' => $selectedPromoterId,
                            'label' => false
                        ));
                    ?>
                </div>
                
                <label class="control-label">Select Location</label>
                <div class="controls">
                    <?php                    
                        if( isset($this->data['Survey']['region_id']) ){
                            echo $this->Form->input('region_id',array('type' => 'hidden'));
                        }
                        if( isset($this->data['Survey']['area_id']) ){
                            echo $this->Form->input('area_id', array('type' => 'hidden'));
                        }
                        if( isset($this->data['Survey']['team_id']) ){
                            echo $this->Form->input('team_id', array('type' => 'hidden'));
                        }                      
                        
                        $selectedLocationId = isset($this->data['Survey']['location_id']) ? $this->data['Survey']['location_id']:'';
                        echo $this->Form->input('location_id', array(
                            'type' => 'select',
                            'options' => $locations,
                            'class' => 'span6 m-wrap',
                            'empty' => 'Select Location',
                            'selected' => $selectedLocationId,
                            'label' => false
                        ));
                    ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="datepicker">Select Date Range</label>
                <div class="controls">
                        <input type="text" id="startDate" name="data[Survey][start_date]" placeholder="..." class="span3" value="<?php echo isset($this->data['Survey']['start_date'])?$this->data['Survey']['start_date']:'';?>">
                        <input type="text" id="endDate" name="data[Survey][end_date]" placeholder="..." class="span3" value="<?php echo isset($this->data['Survey']['end_date'])?$this->data['Survey']['end_date']:'';?>">
                </div>
            </div>

            <!-- Forms: Form Filter Options -->
            <div class="control-group">
                <label class="control-label" for="inputDate">Filter by</label>
                <div class="controls">
                    <?php 
                        $selectedAge = isset($this->data['Survey']['age']) ? $this->data['Survey']['age']:''; 
                        echo $this->Form->input('age', array(
                            'type' => 'select',
                            'label' => false,
                            'options' => array(
                                '10:15' => '10 - 15',
                                '15:20' => '15 - 20',
                                '20:25' => '20 - 25',
                                '25:30' => '25 - 30',
                                '30:130' => '30+'
                            ),
                            'empty' => 'Select Age Group',
                            'class' => 'span3',
                            'selected' => $selectedAge,
                            'div' => false
                        ));

                        $selectedOccupationId = isset($this->data['Survey']['occupation_id']) ? $this->data['Survey']['occupation_id']:''; 
                        echo $this->Form->input('occupation_id', array(
                            'type' => 'select',
                            'options' => $occupations,
                            'class' => 'span6 m-wrap',
                            'empty' => 'Select Occupation',
                            'label' => false,
                            'class' => 'span3',
                            'selected' => $selectedOccupationId,
                            'div' => false
                        ));
                        
                        $selectedIs3G = isset($this->data['Survey']['is_3g']) ? $this->data['Survey']['is_3g']:''; 
                        echo $this->Form->input('is_3g', array(
                            'type' => 'select',
                            'options' => array('1' => 'Yes', '0' => 'No'),
                            'class' => 'span6 m-wrap',
                            'empty' => 'Select 3g Pack Status',
                            'label' => false,
                            'class' => 'span3',
                            'selected' => $selectedIs3G,
                            'div' => false
                        ));

                        $selectedPackageId = isset($this->data['Survey']['package_id']) ? $this->data['Survey']['package_id']:''; 
                        echo $this->Form->input('package_id', array(
                            'type' => 'select',
                            'options' => $packages,
                            'class' => 'span6 m-wrap',
                            'empty' => 'Select Package',
                            'class' => 'span3',
                            'label' => false,
                            'selected' => $selectedPackageId,
                            'div' => false
                        ));                       
                        
                        $url_params = array();

                        //if( isset($this->data['Survey']['start_date']) ){
                            $url_params['start_date'] = isset($this->data['Survey']['start_date']) ? $this->data['Survey']['start_date']:'';
                        //}
                        //if( isset($this->data['Survey']['end_date']) ){
                            $url_params['end_date'] = isset($this->data['Survey']['end_date']) ? $this->data['Survey']['end_date']: '';
                        //}
                        //if( isset($this->data['Survey']['region_id']) && $this->data['Survey']['region_id']){
                            $url_params['region_id'] = isset($this->data['Survey']['region_id']) ? $this->data['Survey']['region_id']:'';
                        //}
                        //if( isset($this->data['Survey']['area_id']) && $this->data['Survey']['area_id']){
                            $url_params['area_id'] = isset($this->data['Survey']['area_id']) ? $this->data['Survey']['area_id']:'';
                        //}
                        //if( isset($this->data['Survey']['team_id']) && $this->data['Survey']['team_id']){
                            $url_params['team_id'] = isset($this->data['Survey']['team_id'])?$this->data['Survey']['team_id']:'';
                        //}
                        //if( isset($this->data['Survey']['promoter_id']) && $this->data['Survey']['promoter_id']){
                            $url_params['promoter_id'] = isset($this->data['Survey']['promoter_id'])?$this->data['Survey']['promoter_id']:'';
                        //}
                        //if( isset($this->data['Survey']['location_id']) && $this->data['Survey']['location_id']){
                            $url_params['location_id'] = isset($this->data['Survey']['location_id']) ? $this->data['Survey']['location_id']:'';
                        //}
                        //if( isset($this->data['Survey']['occupation_id']) ){
                            $url_params['occupation_id'] = isset($this->data['Survey']['occupation_id']) ? $this->data['Survey']['occupation_id']:'';
                        //}
                        //if( isset($this->data['Survey']['age']) ){
                            $url_params['age'] = isset($this->data['Survey']['age'])? $this->data['Survey']['age']:'';
                        //}
                        //if( isset($this->data['Survey']['package_id']) ){
                            $url_params['package_id'] = isset($this->data['Survey']['package_id']) ? $this->data['Survey']['package_id']:'';
                        //}
                        //if( isset($this->data['Survey']['is_3g']) ){
                            $url_params['is_3g'] = isset($this->data['Survey']['is_3g'])? $this->data['Survey']['is_3g']: '';
//                        }else{
//                            $url_params['is_3g'] = 'No';
//                        }
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
                        <input type="hidden" name="data[Survey][region_id]" value="<?php echo isset($this->data['Survey']['region_id']) ? $this->data['Survey']['region_id'] : '';?>"/>
                        <input type="hidden" name="data[Survey][area_id]" value="<?php echo isset($this->data['Survey']['area_id']) ? $this->data['Survey']['area_id'] : '';?>"/>
                        <input type="hidden" name="data[Survey][team_id]" value="<?php echo isset($this->data['Survey']['team_id']) ? $this->data['Survey']['team_id'] : '';?>"/>
                        <input type="hidden" name="data[Survey][promoter_id]" value="<?php echo isset($this->data['Survey']['promoter_id']) ? $this->data['Survey']['promoter_id'] : '';?>"/>
                        <input type="hidden" name="data[Survey][location_id]" value="<?php echo isset($this->data['Survey']['location_id']) ? $this->data['Survey']['location_id'] : '';?>"/>
                        <input name="data[Survey][start_date]" type="hidden" value="<?php echo isset($this->data['Survey']['start_date']) ? $this->data['Survey']['start_date'] : '';?>" />
                        <input name="data[Survey][end_date]" type="hidden" value="<?php echo isset($this->data['Survey']['end_date']) ? $this->data['Survey']['end_date'] : '';?>" />   
<!--                        <input type="hidden" name="adc" value="<?php //echo isset($this->data['adc']) ? $this->data['adc']: '';?>"/>-->
                        <input type="hidden" name="data[Survey][package_id]" value="<?php echo isset($this->data['Survey']['package_id']) ? $this->data['Survey']['package_id']: '';?>"/>
                        <input type="hidden" name="data[Survey][age]" value="<?php echo isset($this->data['Survey']['age']) ? $this->data['Survey']['age']: 0;?>"/>
                        <input type="hidden" name="data[Survey][occupation_id]" value="<?php echo isset($this->data['Survey']['occupation_id']) ? $this->data['Survey']['occupation_id']: '';?>"/>                        
                        <input type="hidden" name="data[Survey][is_3g]" value="<?php echo isset($this->data['Survey']['is_3g']) ? $this->data['Survey']['is_3g']: '';?>"/>                        
                        <button type="submit" class="btn btn-inverse"> Export to Excel</button>
                        <?php echo $this->Form->end();?>
                </div>
                <!-- / Pie: Content -->

        </div>
        <!-- / Pie -->

</div>
<!-- / Live Stats -->
