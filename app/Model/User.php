<?php 
App::uses('AuthComponent', 'Controller/Component');
 
class User extends AppModel 
{
          
    public $validate = array(
        'first_name' => array(
            'nonEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'First name is required',
                'allowEmpty' => false
            )
        ),
        'last_name' => array(
            'nonEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'Last name is required',
                'allowEmpty' => false
            )
        ),
        'contact_number' => array(
            'nonEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'Contact number is required',
                'allowEmpty' => false
            ),
            'numeric' => array(
                'rule' => array('numeric','contact_number'),
                'message' => 'contact number must be digits.'
            ),
            'min_length' => array(
                'rule' => array('minLength', '10'),  
                'message' => 'Contact number must be of 10 digits'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'A password is required'
            ),
            'min_length' => array(
                'rule' => array('minLength', '6'),  
                'message' => 'Password must have a mimimum of 6 characters'
            ),
            'max_length' => array(
                'rule' => array('maxLength', '20'),  
                'message' => 'Password must have a maximum of 20 characters'
            )
        ),
        'confirm_password' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Please confirm your password'
            ),
             'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Both passwords must match.'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email', true),    
                'message' => 'Please provide a valid email address.'   
            ),
            'unique' => array(
                'rule'    => array('isUniqueEmail'),
                'message' => 'This email is already in use',
            )
        ),
        'address' => array(
            'nonEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'Address is required',
                'allowEmpty' => false
            ),
        )
    );
     
    public function numeric($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];
 
        return preg_match('/^[0-9 \-]*$/', $value);
    }

    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
    function isUniqueEmail($check) {
 
        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id'
                ),
                'conditions' => array(
                    'User.email' => $check['email']
                )
            )
        );
        
        if(!empty($email)){
            if(isset($this->data['User']['id']) && $this->data['User']['id'] == $email['User']['id']){
                return true; 
            } else {
                return false; 
            }
        } else {
            return true; 
        }
    }
     
     
    public function equaltofield($check,$otherfield) 
    { 
        //get name of field 
        $fname = ''; 
        foreach ($check as $key => $value){ 
            $fname = $key; 
            break; 
        } 
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname]; 
    } 
 
    /**
     * Before Save
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        // fallback to our parent
        return parent::beforeSave($options);
    }

    public $belongsTo = array(
        'State' => array(
            'className' => 'State',
            'dependent' => true,
            'foreignKey' => 'state'
        )
    );
}