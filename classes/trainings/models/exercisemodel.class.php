<?php
    class Trainings_Models_ExerciseModel{

        public $records_ar = array();
        public $id = 0;

        public function __construct($record_id = 0){
            if($record_id){
                $this->id = $record_id;
                $this->records_ar = self::getRecords();
            }
        }

        private function getRecords(){
            if(!$this->id){
                return false;
            }
            return DB_Trainings_Exercises::getFullRecord($this->id);
        }
    }
?>
