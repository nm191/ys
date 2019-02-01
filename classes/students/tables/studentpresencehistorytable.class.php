<?php
    class Students_Tables_StudentPresenceHistoryTable{
        static private $filter_ar = array();
        static private $presence_records = array();
        static private $student_records = array();

        static public function get(array $filter_ar = array()){
            // init variables
            self::$filter_ar = $filter_ar; 
            self::$presence_records = DB_Students_StudentPresence::getPresenceHistory(); 
            self::$student_records = DB_Students_Students::getFullRecords(); 

            // fill return array
            $return_ar[] = self::getTable();
            $return_ar[] = self::getJquery();

            return HTML::Div(implode('', $return_ar), '', 'content-container');
        }

        static private function getTable(){
            return HTML::Table(self::getTableHeader().self::getTableData(), 'student_presence_history_table', 'table table-hover table-sm');
        }

        static private function getTableData(){
            foreach(self::$student_records as $student){
                $tmp_td_ar = [];
                $tmp_td_ar[] = HTML::Td($student->first_name.' '.$student->last_name);
                $tmp_td_ar[] = HTML::Td($student->group_name);
                foreach(self::$presence_records as $date => $students_ar){
                    if(in_array($student->id, $students_ar)){
                        $cell_value = 'Aanwezig';
                    }else{
                        $cell_value = 'Afwezig';
                    }
                    $tmp_td_ar[] = HTML::Td($cell_value, '', ($cell_value == 'Aanwezig' ? 'green' : 'red'));
                }
                $tr_ar[] = HTML::Tr(implode('', $tmp_td_ar));
            }
            return implode('', $tr_ar);
        }

        static private function getTableHeader(){
            $th_ar[] = HTML::Th('Naam');
            $th_ar[] = HTML::Th('Groep');
            foreach(self::$presence_records as $date => $students_ar){
                $th_ar[] = HTML::Th(date('D d-m-Y', strtotime($date)));
            }
            return HTML::Thead(HTML::Tr(implode('', $th_ar)));
        }

        static private function getJquery(){
            ob_start();
            ?>
                <script>
                    $(document).ready(function(){
                        $('#student_presence_history_table').DataTable({
                            "lengthMenu": [ [-1, 25, 50, 100], ["All", 25, 50, 100] ],
                            "order": [[ 1, "asc" ]]
                        });
                    });
                </script>
            <?php
            return ob_get_clean();
        }
    }
?>