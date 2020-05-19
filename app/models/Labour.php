<?php

class Labour extends Model
{
    public function __construct($labour = '')
    {
        $table = '';
        parent::__construct($table);
        if ($labour != '') {
            if (is_int($labour)) {
                $l = $this->_db->findFirst('', ['conditions' => 'LabourId = ?', 'bind' => [$labour]]);
            }
            if ($l) {
                foreach ($l as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }


    public function isLabourIdValid($id){
        $params = ['LabourId'=>$id];
        return $this->isValidKey($params);
    }

    public function registerNewLabouror($params){
        $this->assign($params);
        $this->deleted=0;
        $this->save();
    }

    public function stateChange_this($state){
        return $this->stateChange($this->LabourId,$state);
    }

    public function stateChange($id,$state){
        if(isset($id)&&isset($state)){
            $unique=['LabourId'=>$id];
            return $this->UpdateRow($unique,['LabourState'=>$state]);
        }
        return(false);
    }

}