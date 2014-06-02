<?php
App::uses('AppModel', 'Model');
/**
 * Promoter Model
 *
 * @property Team $Team
 * @property Survey $Survey
 */
class Promoter extends AppModel {

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
		'code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                    'isUnique' => array(
                        'rule'    => 'isUnique',
                        'message' => 'This username has already been taken.'
                    )
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
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
			'foreignKey' => 'promoter_id',
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
        
        public function getPromoterIds($data = null){
            $ids = array();
            if( !empty($data['promoter_id']) ){
                $ids[] = $data['promoter_id'];
            }else if( !empty($data['area_id']) ){
                $teamIds = $this->Team->Location->find('list', array(
                    'fields' => array('team_id'),
                    'conditions' => array('Location.area_id' => $data['area_id']),
                    'group' => 'team_id',
                    'recursive' => -1));
                
                $ids = $this->find('list', array(
                    'fields' => array('Promoter.id'),
                    'conditions' => array('Promoter.team_id' => $teamIds)
                ));
            }else if(!empty($data['region_id'])){
                $areaIds = $this->Team->Location->Area->find('list',array(
                    'fields' => array('Area.id'),
                    'conditions' => array('Area.region_id' => $data['region_id']),
                    'recursive' => -1));
                
                $teamIds = $this->Team->Location->find('list', array(
                    'fields' => array('team_id'),
                    'conditions' => array('Location.area_id' => $areaIds),
                    'recursive' => -1));
                
                $ids = $this->find('list', array(
                    'fields' => array('id'),
                    'conditions' => array('Promoter.team_id' => $teamIds),
                    'recursive' => -1));
            }else if( !empty($data['team_id']) ){
                $ids = $this->find('list', array(
                    'fields' => array('id'),
                    'conditions' => array('Promoter.team_id' => $data['team_id']),
                    'recursive' => -1));
            }else{
                $ids = $this->find('list', array(
                    'fields' => array('id'),
                    'recursive' => -1
                ));
            }
            return $ids;
        }

}
