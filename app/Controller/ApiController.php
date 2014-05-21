<?php
App::uses('AppController', 'Controller');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiController
 *
 * @author root
 */
class ApiController extends AppController {
    var $dataForMobileApp = array();
    
//    var $menuItemCounter = array();
    var $counter = array();
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = $this->autoRender = false;
        $this->Auth->allow( 'fetch_all_data', 'receive_survey_data');
    } 
    
    /**
     * 
     */
    protected function _initialize_counter(){
        $this->counter['area_counter'] = $this->counter['location_counter'] = 0;
        $this->counter['promoter_counter'] = $this->counter['occupation_counter'] = 0;
        $this->counter['package_counter'] = $this->counter['mobile_brand_counter'] = 0;
    }

    /**
     * App Need to get all the necessery data just after installation
     */
    public function fetch_all_data(){
        $this->layout = $this->autoRender = false;
        $this->_initialize_counter();
        
        $this->_get_areas();
        $this->_get_locations();
        $this->_get_promoters();        
        $this->_get_occupations();
        $this->_get_packages();
        $this->_get_mobile_brands();       
        
//        $this->_count_total_data();
//        pr($this->dataForMobileApp);        
        echo json_encode($this->dataForMobileApp);
    }
    
    /**
     * This is essential to check whether all data has been received and inserted in local db of front-end
     */
//    protected function _count_total_data(){
//        $this->dataForMobileApp['Total']['TradePromotion'] = count($this->dataForMobileApp['TradePromotion']);
//        $this->dataForMobileApp['Total']['PopItem'] = count($this->dataForMobileApp['PopItem']);
//        $this->dataForMobileApp['Total']['HotSpot'] = count($this->dataForMobileApp['HotSpot']);
//        $this->dataForMobileApp['Total']['Sku'] = count($this->dataForMobileApp['Sku']);
//        $this->dataForMobileApp['Total']['Task'] = count($this->dataForMobileApp['Task']);
//    }
    
    protected function _get_areas(){
        $this->loadModel('Area');
        $areas = $this->Area->find('list');
        foreach($areas as $k => $ara){  
            $this->dataForMobileApp['Area'][ $this->counter['area_counter'] ]['area_id'] = $k;
            $this->dataForMobileApp['Area'][ $this->counter['area_counter'] ]['title'] = $ara;
            $this->counter['area_counter']++;
        }
    }
    
    protected function _get_locations(){
        $this->loadModel('Location');
        $locations = $this->Location->find('all', array('recursive' => -1));
        foreach($locations as $location){  
            $this->dataForMobileApp['Location'][ $this->counter['location_counter'] ]['location_id'] = $location['Location']['id'];
            $this->dataForMobileApp['Location'][ $this->counter['location_counter'] ]['area_id'] = $location['Location']['area_id'];
            $this->dataForMobileApp['Location'][ $this->counter['location_counter'] ]['team_id'] = $location['Location']['team_id'];
            $this->dataForMobileApp['Location'][ $this->counter['location_counter'] ]['title'] = $location['Location']['title'];
            
            $this->counter['location_counter']++;
        }
    }
    
    protected function _get_promoters(){
        $this->loadModel('Promoter');
        $promoters = $this->Promoter->find('all', array('recursive' => 0));
        foreach($promoters as $prm){  
            $this->dataForMobileApp['Promoter'][ $this->counter['promoter_counter'] ]['promoter_id'] = $prm['Promoter']['id'];
            $this->dataForMobileApp['Promoter'][ $this->counter['promoter_counter'] ]['team_id'] = $prm['Promoter']['team_id'];
            $this->dataForMobileApp['Promoter'][ $this->counter['promoter_counter'] ]['team_name'] = $prm['Team']['name'];
            $this->dataForMobileApp['Promoter'][ $this->counter['promoter_counter'] ]['promoter_name'] = $prm['Promoter']['name'];
            $this->dataForMobileApp['Promoter'][ $this->counter['promoter_counter'] ]['code'] = $prm['Promoter']['code'];
            $this->counter['promoter_counter']++;
        }
    }  
        
    protected function _get_occupations(){
        $this->loadModel('Occupation');
        $occupations = $this->Occupation->find('list');
        foreach($occupations as $k => $ocp){  
            $this->dataForMobileApp['Occupation'][ $this->counter['occupation_counter'] ]['occupation_id'] = $k;
            $this->dataForMobileApp['Occupation'][ $this->counter['occupation_counter'] ]['title'] = $ocp;
            $this->counter['occupation_counter']++;
        }
    }
    
    protected function _get_packages(){
        $this->loadModel('Package');
        $packages = $this->Package->find('list');
        foreach( $packages as $k => $pkg){
            $this->dataForMobileApp['Package'][ $this->counter['package_counter'] ]['package_id'] = $k;
            $this->dataForMobileApp['Package'][ $this->counter['package_counter'] ]['title'] = $pkg;
            $this->counter['package_counter']++;
        }
    }
    
    protected function _get_mobile_brands(){
        $this->loadModel('MobileBrand');
        
        $mobiles = $this->MobileBrand->find('list');
        foreach($mobiles as $k => $mb){
            $this->dataForMobileApp['MobileBrand'][ $this->counter['mobile_brand_counter'] ]['mobile_brand_id'] = $k;
            $this->dataForMobileApp['MobileBrand'][ $this->counter['mobile_brand_counter'] ]['title'] = $mb;
            $this->counter['mobile_brand_counter']++;
        }
    }
    
    /**
     * 
     */
    public function receive_survey_data(){
        $this->autoLayout = $this->autoRender = false;
        $this->layout = false;
        $this->log(print_r($this->request->data, true),'error');
        
        $response['success'] = true;
            
        if( !empty($this->request->data) ){
            $this->loadModel('Survey');
            $result = $this->Survey->saveSurvey($this->request->data);
            $response = $result;
        }else{
            $response['message'] = 'Nothing found!';
            $response['success'] = false;
        }
        //$this->log(print_r($response, true),'error');
        echo json_encode($response);
    }
}
