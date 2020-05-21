<?php
#the bus model
class BusME extends Model{

  public function __construct($bus=''){
    $table='busmileage';
    parent::__construct($table);
    if ($bus != '') {
      if (is_int($bus)) {
        $b = $this->_db->findFirst('busmileage', ['conditions'=>'BusId = ?', 'bind'=>[$bus]]);
      }else{
        $b = $this->_db->findFirst('busmileage', ['conditions'=>'BusNumber = ?', 'bind'=>[$bus]]);
      }
      if ($b) {
        foreach ($b as $key => $value) {
          $this->$key = $value;
        }
      }
    }
  }

  public function findByBusNumber($BusNumber){
    return $this->findFirst(['conditions'=>'BusNumber = ?', 'bind'=>[$BusNumber]]);
  }

  public function populatechecklist($id){
    $tables=['bustable','buscategory'];
    $keys = ['BusCategory','BusType'];
    $params = ['BusId','*'];
    $id = ['BusId' => $id];
    $result=$this->LeftJoinSpecific($tables,$keys,$params,$id);
    unset($result['BusId']);
    unset($result['BusType']);
    return($result);
  }

  public function NewDistanceTravelledRow($BusNumber,$Distance){
    #dnd($Distance);
    $columns = ModelCommon::getColumnNames($this->_table);
    $params=['BusNumber'=>$BusNumber];
    #echo(implode('    |||',$columns));
    #dnd('..............................');
    foreach($columns as $key){
      if($key!='BusNumber'){
        $params[$key] = $Distance;
      }
    }
    #echo(implode('    |||',$params));
    #dnd('..............................');
    $this->insert($params);
  }

  public function updateRowByBusNumber($number,$params){
      if(isset($number)){
          $unique = ['BusNumber'=>$number];
          return $this->UpdateRow($unique,$params);
      }
  }

  public function  isBusNumberValid($id){
      $params=['BusNumber'=>$id];
      return $this->isValidKey($params);
  }
}
