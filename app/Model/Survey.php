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
            App::import('Model', 'Promoter');
            $Promoter = new Promoter();
            
            return $Promoter->field('team_id', array('conditions' => array(
                'Promoter.id' => $promoterId
            )));            
        }
        
        protected function _getAreaRegionId($locationId){
            $response = array();
            App::import('Model', 'Location');
            $Location = new Location();
            $response['area_id'] = $Location->field('area_id', array('conditions' => array(
                'Location.id' => $locationId
            )));
            
            $response['region_id'] = $Location->Area->field('region_id', array('conditions' => array(
                'Area.id' => $response['area_id']
            )));
        }
        
//        protected function _getRegionId($locationId){
//            App::import('Model', )
//        }
        
        /**
         * 
         * @param type $data
         * @return boolean
         */
        public function saveSurvey($data){
            $survey['Survey'] = array();
            
            foreach( $data as $k => $v){
                $survey['Survey'][$k] = $v;
                
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
            
//            if( $surveyIds ){
//                $conditions[]['Survey.id'] = $surveyIds;                
//            }else{
//                $conditions[]['Survey.id'] = 0;
//            }
            
            if( $locationIds ){
                $conditions[]['Survey.location_id'] = $locationIds;                
            }
            
            if( isset($data['start_date']) && !empty($data['start_date']) ){
                $conditions[]['DATE(Survey.created) >='] = $data['start_date'];
            }
            if( isset($data['end_date']) && !empty($data['end_date']) ){
                $conditions[]['DATE(Survey.created) <='] = $data['end_date'];
            }
            
            if( isset($data['occupation_id']) && !empty($data['occupation_id']) ){
                $conditions[]['Survey.occupation_id'] = $data['occupation_id'];
            }
            if( isset($data['age_limit']) && !empty($data['age_limit']) ){
                $limits = $this->_get_limits($data['age_limit']);
                $conditions[]['age >='] = $limits['lower'];
                if( isset($limits['upper']) ){
                    $conditions[]['age <='] = $limits['upper'];
                }                
            }            
            if( isset($data['is_3g']) && !empty($data['is_3g']) ){
                $conditions[]['Survey.is_3g'] = $data['is_3g'];
            }
            if( isset($data['is_smart_phone']) && !empty($data['is_smart_phone']) ){
                $conditions[]['Survey.is_smart_phone'] = $data['is_smart_phone'];
            }
            return $conditions;
        }
        
        public function getTotalFb(){
            return $this->find('count');
        }
        
        public function parcent3gPackUser(){
            $total = $this->getTotalFb();
            if( $total>0 ){
                $total3GUser = $this->find('count', array('conditions' => array(
                    'Survey.is_3g' => 1
                )));
                $this->log(print_r($total3GUser, true), 'error');
                $parcent = (100*$total3GUser)/$total;
                return $parcent;
            }else{
                return 0;
            }
        }
        
        public function parcentSmartPhoneUser(){
            $total = $this->getTotalFb();
            if( $total>0 ){
                $totalSmartPhoneUser = $this->find('count', array('conditions' => array(
                    'Survey.is_smart_phone' => 1
                )));
                $this->log(print_r($totalSmartPhoneUser, true), 'error');
                $parcent = (100*$totalSmartPhoneUser)/$total;
                return $parcent;
            }else{
                return 0;
            }
        }
        
        public function getTodaysFbTotal(){            
            $todaysTotal = $this->find('count', array('conditions' => array(
                'DATE(Survey.date_time)' => date('Y-m-d',time())
            )));
            $this->log(print_r($todaysTotal, true), 'error');
            return $todaysTotal;
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
                $formatted[$i]['date_time'] = date('Y-m-d',strtotime($srv['Survey']['date_time']));
                
                $i++;
            }
            return $formatted;
        }
}
