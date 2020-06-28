<?php
#the bus model
class BusME extends Model{
  public $GrantedService ;

  public function __construct($bus=''){
    $this->GrantedService = null ;
    $table='busmileage';
    parent::__construct($table,'BusME','BusNumber');

    if ($bus != '') {
        $b = $this->_db->findFirst('busmileage', ['conditions'=>'BusNumber = ?', 'bind'=>[$bus]]);

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

  public function populatechecklist(){
      //dnd($id);
    $tables=['bustable','buscategory'];
    $keys = ['BusCategory','BusType'];
    $params = ['bustable.BusId','buscategory.*'];
    $id = ['BusNumber'=> $this->findIDbyBusNumber($this->BusNumber)];

    //dnd($id);
    $result=$this->LeftJoinSpecific($tables,$keys,$params,$id);
    //dnd('here');
    unset($result['BusId']);
    unset($result['BusType']);
    $filtered=[];
    foreach ($result as $service => $value){
        if ($value!=null){
            $filtered[$service]=$value;
        }
    }
    //dnd($filtered);
    $this->GrantedService = $filtered;
    return $filtered;
  }

  public function NewBusDistanceUpdate($BusNumber,$Distance){
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
    #dnd($params);

    $this->assign($params);
    $this->deleted = 0;
    $this->save();
  }

  public function updateRowByBusNumber($number,$params){
      if(isset($number)){
          $unique = ['BusNumber'=>$number];
          return $this->UpdateRow($unique,$params);
      }
  }

  public function  isBusNumberValid($id){
      #dnd($id);
      $params=['BusNumber'=>$id];
      return $this->isValidKey($params);
  }


  public function DistanceUpdate($params){
      $this->assign($params);
      $this->save();
  }

  public function findIDbyBusNumber($BusNumber){
      return (ModelCommon::selectAllArray('bustable','BusNumber',$BusNumber)['BusId']);
  }


  public function UpdateTotalDistance($distance){
      $this->TotalDistaceTravelled=$this->TotalDistaceTravelled+$distance;
  }

  public function LogDistance($key,$distance){ #can be used to make zero
          $this->{$key}=$distance;
          $this->save();
  }

  public function IncrementDistance($key,$distance){
      if (isset($this->{$key})){
          $value = $this->{$key}+$distance;
          $this->LogDistance($key,$value);
      }else{
          $this->LogDistance($key,$distance);
      }
  }

  public function UpdateDistanceOfBus($id,$distance){
      //dnd('comes');
      $bus = $this->findByBusNumber($id);
      //dnd($bus);
      $bus->populatechecklist();
      $bus->DistanceIncrement($distance);
  }

  public function DistanceIncrement($distance){
      if (!($this->GrantedService == null) && isset($distance)){
          foreach ($this->GrantedService as $key => $value){
            $this->IncrementDistance($key,$distance);
          }
          //dnd('is there any errore');
          $this->UpdateTotalDistance($distance);
      }
  }

  public function CheckForService(){
      $AvailableServices = [];
      foreach ($this->GrantedService as $service=>$value){
          if (isset($bus->{$service}) && $bus->{$service}>=$value){
              array_push($AvailableServices,$service);
          }
      }
      return $AvailableServices;
  }


  public function check($id){
      $bus = $this->findByBusNumber($id);
      $bus->populatechecklist();
      return $bus->CheckForService();
  }
}


