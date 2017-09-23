<?php
    class DB_Students_StudentPresence{
        static public function setPresenceValue($student_id){
            $field_values_ar['student_id'] = $student_id;
            $field_values_ar['presence_date'] = date('Y-m-d');
            $record = self::getFullRecord($field_values_ar);
            // dd::show($field_values_ar);
            if($record){ 
                // dd::show($record);
                $sql_ar[] = 'DELETE prsnc FROM '.DB_Students_TbNames::PRESENCE.' AS prsnc';
                $where_sql_ar = self::getWhereSQL(array('id' => $record->id));
                if (!empty($where_sql_ar['sql'])) { $sql_ar[] = 'WHERE '.implode(' AND ', $where_sql_ar['sql']); }
                // dd::show(implode(' ', $sql_ar));
                // dd::show($where_sql_ar);
                $result = DB::executeQuery(implode(' ', $sql_ar), $where_sql_ar['params']);
                // dd::show($result);
                return 'deleted';
            }
            self::insert($field_values_ar);
            return 'inserted';
        }

        static public function insert(array $field_values_ar){
            if(empty($field_values_ar)){
                return false;
            }

            $sql_ar[] = 'INSERT INTO '.DB_Students_TbNames::PRESENCE;
            $sql_ar[] = '('.implode(', ', array_keys($field_values_ar)).')';
            $sql_ar[] = 'VALUES';
            $sql_ar[] = '(:'.implode(', :', array_keys($field_values_ar)).')';

            //build pdo parameters ar
            foreach($field_values_ar as $key => $value){
                $pdo_parameters_ar[':'.$key] = $value;
            }
            return DB::executeInsertQuery(implode(' ', $sql_ar), $pdo_parameters_ar);
        }

        static public function update($id, array $field_values_ar){
            if(empty($field_values_ar) || !$id){
                return false;
            }
            unset($field_values_ar['student_id']);
            $sql_ar[] = 'UPDATE '.DB_Students_TbNames::PRESENCE;
            $sql_ar[] = 'SET';
             //build pdo parameters ar
            foreach($field_values_ar as $key => $value){
                $set_values_ar[] = $key.' = :'.$key; 
                $pdo_parameters_ar[':'.$key] = $value;
            }
            $sql_ar[] = implode(', ', $set_values_ar);
            $sql_ar[] = 'WHERE id = :id';

            $pdo_parameters_ar[':id'] = $id;

            return DB::executeQuery(implode(' ', $sql_ar), $pdo_parameters_ar);
        }

        static public function delete($id){
            return self::update($id, array('is_active' => 0));
        }

        static public function store(array $field_values_ar){
            if(isset($field_values_ar['student_id'])){
                return self::update($field_values_ar['student_id'], $field_values_ar);
            }
            return self::insert($field_values_ar);
        }

        static public function getFullRecord($filter_ar){
            $record = self::getFullRecords($filter_ar);
            if($record){ return reset($record); }
            return false;
        }

        static public function getFullRecords(array $filter_ar = array()){
            if(!isset($filter_ar['is_active'])){
                $filter_ar['is_active'] = 1;
            }
            //build select ar
            $select_ar[] = 'prsnc.id';
            $select_ar[] = 'prsnc.student_id';
            $select_ar[] = 'prsnc.presence_date';

            //build sql ar
            $sql_ar[] = 'SELECT '.implode(', ', $select_ar);
            $sql_ar[] = 'FROM '.DB_Students_TbNames::PRESENCE.' prsnc';
            $where_sql_ar = self::getWhereSQL($filter_ar);
            if (!empty($where_sql_ar['sql'])) { $sql_ar[] = 'WHERE '.implode(' AND ', $where_sql_ar['sql']); }
             // Get query result
            return DB::fetchAll(implode(' ', $sql_ar), $where_sql_ar['params']);
        }   

        static private function getWhereSQL(array $filter_ar = array()) {
            // set default return values
            $return_ar['sql']		= array();
            $return_ar['params']	= array();

            // prepare list of filter_field parts and corresponding arithmetic_operator
            $arithmetic_operator_fields_values_ar = array(
                'IS NOT NULL'	=> 'not_null',
                'IS NULL'		=> 'is_null',
                'IS EMPTY'		=> 'is_empty',
                '<>'			=> 'not_is',
                '>='			=> 'minimum',
                '<='			=> 'maximum',
            );
            $arithmetic_operator_field_lengths_ar = array_map('strlen', $arithmetic_operator_fields_values_ar);
            $min_length_arithmetic_operator_field = min($arithmetic_operator_field_lengths_ar);

            foreach ($filter_ar as $filter_field => $filter_value) {
                $original_filter_field = $filter_field = strtolower(trim($filter_field));
                // determine arithmetic_operator, based on existence of any of the filterable field parts
                $arithmetic_operator = '=';
                if (strlen($filter_field) >= $min_length_arithmetic_operator_field + 7) {
                    foreach ($arithmetic_operator_fields_values_ar as $new_arithmetic_operator => $arithmetic_operator_field) {
                        $check_for_field_part = '_'.$arithmetic_operator_field.'_value';
                        $check_for_field_part_strlen = strlen($check_for_field_part);
                        if (stripos($filter_field, $check_for_field_part) !== false) {
                            $filter_field = substr($filter_field, 0, -$check_for_field_part_strlen);
                            $arithmetic_operator = $new_arithmetic_operator;
                            break;
                        }
                    }
                }
                // set db table abbreviation
                $db_table_abbr = 'prsnc';
                // set SQL, based on field name
                switch ($filter_field) {
                    case 'id':
                    case 'student_id':
                    case 'presence_date':
                        if($filter_field == 'call_id'){ $filter_field = 'id'; }
                        if (is_array($filter_value)) {
                            $tmp_filter_select_ar = array();
                            foreach ($filter_value as $tmp_key => $tmp_value) {
                                $tmp_filter_select_ar[':'.$filter_field.'_'.$tmp_key] = $tmp_value;
                            }
                            $return_ar['sql'][] = $db_table_abbr.'.'.$filter_field.' IN ('.implode(', ', array_keys($tmp_filter_select_ar)).')';
                            $return_ar['params'] = array_merge($return_ar['params'], $tmp_filter_select_ar);
                        } else {
                            if($arithmetic_operator == 'IS NOT NULL' || $arithmetic_operator == 'IS NULL' ){
                                $return_ar['sql'][] = $db_table_abbr.'.'.$filter_field.' '.$arithmetic_operator;
                            }elseif($arithmetic_operator == 'IS EMPTY'){
                                $return_ar['sql'][] = '('.$db_table_abbr.'.'.$filter_field.' IS NULL OR '.$db_table_abbr.'.'.$filter_field.' = " ")';
                            }else{
                                $return_ar['sql'][] = $db_table_abbr.'.'.$filter_field.' '.$arithmetic_operator.' :'.$original_filter_field;
                                $return_ar['params'][':'.$original_filter_field] = $filter_value;
                            }
                        }
                        break;
                    case 'description':
                        $return_ar['sql'][] = $db_table_abbr.'.'.$filter_field.' LIKE CONCAT("%", :'.$original_filter_field.', "%")';
                        $return_ar['params'][':'.$original_filter_field] = $filter_value;
                        break;
                }
            }

            // return final sql and parameters
            return $return_ar;
        }
    }
?>