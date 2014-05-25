<?php
App::uses('AppModel', 'Model');
/**
 * Location Model
 *
 * @property Area $Area
 * @property Team $Team
 * @property Survey $Survey
 */
class Location extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'area_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'team_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Survey' => array(
			'className' => 'Survey',
			'foreignKey' => 'location_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
        
        public function getLocationIds($data = null){
            $ids = array();
            if( !empty($data['location_id']) ){
                $ids[] = $data['location_id'];
            }else if( !empty($data['area_id']) ){
                $ids = $this->find('list', array(
                    'fields' => array('id'),
                    'conditions' => array('Location.area_id' => $data['area_id']),
                    'recursive' => -1));
            }else if(!empty($data['region_id'])){
                $areaIds = $this->Area->find('list',array(
                    'fields' => array('Area.id'),
                    'conditions' => array('Area.region_id' => $data['region_id']),
                    'recursive' => -1));               
                //$this->log(print_r($areaIds, true),'error');
                
                $ids = $this->find('list', array(
                    'fields' => array('id'),
                    'conditions' => array('Location.area_id' => $areaIds),
                    'recursive' => -1));
            }else{
                $ids = $this->find('list', array(
                    'fields' => array('id'),
                    'recursive' => -1
                ));
            }
            //$this->log(print_r($ids, true),'error');
            return $ids;
        }

}
