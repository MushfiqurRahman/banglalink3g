<?php
App::uses('AppModel', 'Model');
/**
 * Survey Model
 *
 * @property Promoter $Promoter
 * @property Location $Location
 * @property Occupation $Occupation
 * @property Package $Package
 * @property MobileBrand $MobileBrand
 */
class Survey extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'promoter_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'location_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'occupation_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'package_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mobile_brand_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_3g' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_smart_phone' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mobile' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'age' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Promoter' => array(
			'className' => 'Promoter',
			'foreignKey' => 'promoter_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'Team' => array(
			'className' => 'Team',
			'foreignKey' => 'team_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Occupation' => array(
			'className' => 'Occupation',
			'foreignKey' => 'occupation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Package' => array(
			'className' => 'Package',
			'foreignKey' => 'package_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MobileBrand' => array(
			'className' => 'MobileBrand',
			'foreignKey' => 'mobile_brand_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        protected function _getTeamId($promoterId){
            
            return $this->Promoter->field('team_id', array(
                'Promoter.id' => $promoterId
            ));            
        }
        
        protected function _getAreaRegionId($locationId){
            $response = array();
            $response['area_id'] = $this->Location->field('area_id', array(
                'Location.id' => $locationId
            ));
            
            $response['region_id'] = $this->Location->Area->field('region_id', array(
                'Area.id' => $response['area_id']
            ));
            return $response;
        }
        
        /**
         * 
         * @param type $data
         * @return boolean
         */
        public function saveSurvey($data){
            $survey['Survey'] = array();
            
            foreach( $data as $k => $v){                
                $survey['Survey'][$k] = $v;
                
                if( $k=='package_id' && $v=='None'){
                    $survey['Survey'][$k] = 0;
                }                
                if( $k=='location_id'){
                    $areaRegion = $this->_getAreaRegionId($v);                    
                    $survey['Survey']['area_id'] = $areaRegion['area_id'];
                    $survey['Survey']['region_id'] = $areaRegion['region_id'];
                }
                if( $k=='promoter_id' ){
                    $survey['Survey']['team_id'] = $this->_getTeamId($v);
                }
            }
            if( $this->save($survey) ){
                $response['message'] = 'Experience has been saved';
                $response['success'] = true;
            }else{
                $response['message'] = 'Save Failed! Please try agaiin.';
                $response['success'] = false;
            }
            return $response;
        }
        
        public function get_contain_array(){
            return array(
                'Location' => array(
                    'fields' => array('id','title'),
                    'Area' => array(
                        'fields' => array('id', 'title'),
                        'Region' => array(
                            'fields' => array('title'),
                        )
                    )
                ),
                'Promoter' => array(
                    'fields' => array('id', 'team_id','name', 'code'),
                    'Team' => array(
                        'fields' => array('id','name'),
                    )
                ),
                'Occupation' => array(
                    'fields' => array('title'),
                ),
                'MobileBrand' => array(
                    'fields' => array('title'),
                ),
                'Package' => array(
                    'fields' => array('title')
                ));
        }
        
        /**
         *
         * @return type 
         */
        //public function set_conditions( $surveyIds = null, $data = array(), $is_feedback = false ){
        public function set_conditions( $locationIds = null, $data = array()){
            
            $conditions = array();
            
            if( $locationIds ){
                $conditions[]['Survey.location_id'] = $locationIds;                
            }
                        
            if( isset($data['Survey']['promoter_id']) && !empty($data['Survey']['promoter_id']) ){
                $conditions[]['Survey.promoter_id'] = $data['Survey']['promoter_id'];
            }
            if( isset($data['Survey']['start_date']) && !empty($data['Survey']['start_date']) ){
                $conditions[]['DATE(Survey.created) >='] = $data['Survey']['start_date'];
            }
            if( isset($data['Survey']['end_date']) && !empty($data['Survey']['end_date']) ){
                $conditions[]['DATE(Survey.created) <='] = $data['Survey']['end_date'];
            }            
            if( isset($data['Survey']['occupation_id']) && !empty($data['Survey']['occupation_id']) ){
                $conditions[]['Survey.occupation_id'] = $data['Survey']['occupation_id'];
            }
            if( isset($data['Survey']['package_id']) && !empty($data['Survey']['package_id']) ){
                $conditions[]['Survey.package_id'] = $data['Survey']['package_id'];
            }
            if( isset($data['Survey']['age']) && !empty($data['Survey']['age']) ){
                $limits = $this->_get_limits($data['Survey']['age']);
                $conditions[]['Survey.age >='] = $limits['lower'];
                if( isset($limits['upper']) ){
                    $conditions[]['Survey.age <='] = $limits['upper'];
                }                
            }            
            if( isset($data['Survey']['is_3g'])){
//                $this->log(print_r($data, true),'error');                
                if( $data['Survey']['is_3g']== 1){
                    $conditions[]['Survey.is_3g'] = 1;
                }else if( strlen($data['Survey']['is_3g'])>0 ){
                    $conditions[]['Survey.is_3g !=']  = '1';
                }
            }
            return $conditions;
        }
        
        /**
         * 
         */
        protected function _get_limits( $str ){
            $hasSeperator = strpos($str,':');
            
            if( $hasSeperator!==false ){
                $res['lower'] = substr($str,0,$hasSeperator);
                $res['upper'] = substr($str, $hasSeperator+1);
            }else{
                $res['lower'] = $str;
            }
            return $res;
        }
        
        /**
         * this is essential for info_box.ctp file. To show the statistics
         * accurately. Since conditions array may miss the compulsory feidl
         * for specific statical data.
         * 
         * @param type $conditions
         * @param type $fieldName
         * @return boolean
         */
        protected function _does_condition_exists($conditions = array(), $fieldName){
            
            foreach($conditions as $vals){
                foreach( $vals as $k => $v){
                    if($k==$fieldName) return true;
                }
            }
            return false;
        }
        
        public function getTotalFb( $conditions = array() ){
            if( !empty($conditions) ){                
                return $this->find('count', array(
                    'conditions' => $conditions
                ));
            }else{
                return $this->find('count');
            }
            
        }
        
        public function parcent3gPackUser( $conditions = array() ){
            if( !empty($conditions) ){
                $total = $this->getTotalFb($conditions);
                
                if( $this->_does_condition_exists($conditions, 'Survey.is_3g')==false){
                    $conditions[]['Survey.is_3g'] = 1;
                }
//                $this->log(print_r($conditions, true),'error');
                if( $total>0 ){
                    $total3GUser = $this->find('count', array('conditions' => $conditions));
                    $parcent = round((100*$total3GUser)/$total, 2);                
                    return $parcent;
                }else{
                    return 0;
                }
            }else{
                $total = $this->getTotalFb();
                if( $total>0 ){
                    $total3GUser = $this->find('count', array('conditions' => array(
                        'Survey.is_3g' => 1
                    )));
                    $parcent = round((100*$total3GUser)/$total, 2);                
                    return $parcent;
                }else{
                    return 0;
                }
            }
            
        }
        
        public function parcentSmartPhoneUser( $conditions = array() ){
            if( !empty($conditions) ){
                $total = $this->getTotalFb($conditions);
                
                if( $this->_does_condition_exists($conditions, 'Survey.is_smart_phone')==false){
                    $conditions[]['Survey.is_smart_phone'] = 1;
                }
//                $this->log(print_r($conditions, true),'error');
                if( $total>0 ){
                    $totalSmartPhoneUser = $this->find('count', array(
                        'conditions' => $conditions));
                    $parcent = round((100*$totalSmartPhoneUser)/$total, 2);
                    return $parcent;
                }else{
                    return 0;
                }
            }else{
                $total = $this->getTotalFb();
                if( $total>0 ){
                    $totalSmartPhoneUser = $this->find('count', array('conditions' => array(
                        'Survey.is_smart_phone' => 1
                    )));
                    $parcent = round((100*$totalSmartPhoneUser)/$total, 2);
                    return $parcent;
                }else{
                    return 0;
                }
            }
            
        }
        
        public function getTodaysFbTotal( $conditions = array() ){            
//                            $this->log(print_r($conditions, true),'error');
            if( !empty($conditions) ){
                if( $this->_does_condition_exists($conditions, 'DATE(Survey.created)')==false){
                    $conditions[]['DATE(Survey.created)'] = date('Y-m-d',time());
                }
//                $this->log(print_r($conditions, true),'error');
                $todaysTotal = $this->find('count', array(
                    'conditions' => $conditions
                ));
                return $todaysTotal;
            }else{
                $todaysTotal = $this->find('count', array('conditions' => array(
                    'DATE(Survey.created)' => date('Y-m-d',time())
                )));
                return $todaysTotal;
            }
            
        }
        
        /**
         * @desc Used in surveys controller for excel export. In the export_report method
         * @param type $surveys 
         */
        public function format_for_export( $surveys ){
            
//            $this->log(print_r($surveys, true),'error');exit;
            
            $areaRegionList = $this->Location->Area->find('all', array(
                'fields' => array('id','region_id','title', 'Region.title'),
                'recursive' => 0));
                        
            $formatted = array();
            $i = 0;
            
            foreach( $surveys as $srv ){
                $formatted[$i]['sl'] = $srv['Survey']['id'];
                
                foreach ($areaRegionList as $v){
                    if( $v['Area']['id'] == $srv['Location']['area_id'] ){
                        $formatted[$i]['region'] = $v['Region']['title'];
                        $formatted[$i]['area'] = $v['Area']['title'];
                        break;
                    }
                }
                $formatted[$i]['team_name'] = $srv['Team']['name'];
                $formatted[$i]['location'] = $srv['Location']['title'];
                $formatted[$i]['bp_name'] = $srv['Promoter']['name'];
                $formatted[$i]['bp_code'] = $srv['Promoter']['code'];                
                $formatted[$i]['consumer_name'] = $srv['Survey']['name'];
                $formatted[$i]['occupation'] = $srv['Occupation']['title'];
                $formatted[$i]['age'] = $srv['Survey']['age'];
                $formatted[$i]['gender'] = $srv['Survey']['is_female']?'Female':'Male';
                $formatted[$i]['mobile_no'] = $srv['Survey']['mobile'];
                $formatted[$i]['monthly_recharge'] = $srv['Survey']['recharge_amount'];
                $formatted[$i]['monthly_internet_usage'] = $srv['Survey']['monthly_internet_usage'];
                $formatted[$i]['handset_type'] = $srv['Survey']['is_smart_phone']?'Smart Phone':'Regular Phone';
                $formatted[$i]['handset_brand'] = $srv['Survey']['mobile_brand_id']==0?'N/A':$srv['MobileBrand']['title'];
                $formatted[$i]['buying_3g_pack'] = $srv['Survey']['is_3g']?'Yes':'No';
                $formatted[$i]['new_package'] = $srv['Survey']['package_id']==0?'N/A':$srv['Package']['title'];
                $formatted[$i]['date_time'] = date('Y-m-d',strtotime($srv['Survey']['created']));
                
                $i++;
            }
            return $formatted;
        }
        
        /**
         * For the pi chart
         */
        public function byTeamContribution(){
            $teams = $this->Team->find('list');
            $contributions = array();
            $totalCount = $this->find('count');
            //$this->log('total count:'.$totalCount, 'error');
            foreach($teams as $k => $tm){
                $temps = $this->find('all', array(
                    'conditions' => array(
                        'Survey.team_id' => $k
                    )
                ));
                $teamCount = count($temps);
                if( $totalCount>0 ){
                    $contributions[$tm] = round(($teamCount*100/$totalCount), 2);
                }else{
                    $contributions[$tm] = round((100/(count($teams))), 2);
                }
            }
            
            $response = array();
            $i = 0;
            foreach( $contributions as $k => $v){
                $response[$i]['label'] = $k;
                $response[$i]['data'] = $v;
                $i++;
            }
            return $response;
//            $this->log(print_r($contributions,true),'error');
//            return $contributions;
        }
}
