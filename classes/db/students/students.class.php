<?php
    class DB_Students_Students{

        static public function insert(array $field_values_ar){
            if(empty($field_values_ar)){
                return false;
            }
            unset($field_values_ar['student_id']);
            $field_values_ar['date_created'] = date('Y-m-d');

            $sql_ar[] = 'INSERT INTO '.DB_Students_TbNames::STUDENTS;
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
            $sql_ar[] = 'UPDATE '.DB_Students_TbNames::STUDENTS;
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
            if(isset($field_values_ar['student_id']) && $field_values_ar['student_id'] > 0){
                return self::update($field_values_ar['student_id'], $field_values_ar);
            }
            return self::insert($field_values_ar);
        }

        static public function getFullRecord($record_id){
            $record = self::getFullRecords(['id' => $record_id, 'getfullrecord ' => true]);
            if($record){ return reset($record); }
            return false;
        }

        static public function getFullRecords(array $filter_ar = array()){
            if(!isset($filter_ar['is_active']) && !isset($filter_ar['getfullrecord'])){
                $filter_ar['is_active'] = 1;
            }

            if(isset($filter_ar['group_id']) && $filter_ar['group_id'] == 420){
                unset($filter_ar['group_id']);
            }
            //build select ar
            $select_ar[] = 'stdnts.id';
            $select_ar[] = 'stdnts.first_name';
            $select_ar[] = 'stdnts.last_name';
            $select_ar[] = 'stdnts.date_of_birth';
            $select_ar[] = 'stdnts.street_name';
            $select_ar[] = 'stdnts.house_number';
            $select_ar[] = 'stdnts.zipcode';
            $select_ar[] = 'stdnts.place';
            $select_ar[] = 'stdnts.first_name_dad';
            $select_ar[] = 'stdnts.last_name_dad';
            $select_ar[] = 'stdnts.email_dad';
            $select_ar[] = 'stdnts.telephone_dad';
            $select_ar[] = 'stdnts.first_name_mom';
            $select_ar[] = 'stdnts.last_name_mom';
            $select_ar[] = 'stdnts.email_mom';
            $select_ar[] = 'stdnts.telephone_mom';
            $select_ar[] = 'stdnts.allergies';
            $select_ar[] = 'stdnts.medicine';
            $select_ar[] = 'stdnts.contest_group';
            $select_ar[] = 'stdnts.group_id';
            $select_ar[] = 'stdnts.climbing_level';
            $select_ar[] = 'stdnts.has_rental_equipment';
            $select_ar[] = 'stdnts.registration_date';
            $select_ar[] = 'stdnts.remark';
            $select_ar[] = 'grps.description as group_name';
            $select_ar[] = 'prsnc.id as present';

            //build sql ar
            $sql_ar[] = 'SELECT '.implode(', ', $select_ar);
            $sql_ar[] = 'FROM '.DB_Students_TbNames::STUDENTS.' stdnts';
            $sql_ar[] = 'LEFT JOIN '.DB_Students_TbNames::GROUPS.' grps';
            $sql_ar[] = 'ON stdnts.group_id = grps.id';
            $sql_ar[] = 'LEFT JOIN '.DB_Students_TbNames::PRESENCE.' prsnc';
            $sql_ar[] = 'ON stdnts.id = prsnc.student_id AND prsnc.presence_date = CURRENT_DATE';
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
                $db_table_abbr = 'stdnts';
                // set SQL, based on field name
                switch ($filter_field) {
                    case 'id':
                    case 'is_active':
                    case 'group_id':
                    case 'contest_group':
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