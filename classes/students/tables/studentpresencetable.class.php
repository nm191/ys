<?php
    class Students_Tables_StudentPresenceTable{

        static public function get(){

            $return_ar[] = HTML::P('Presentie van de klimles op <strong>'.date('d-m-Y').'</strong>', '', 'text-center lead present_date_container');
            $return_ar[] = self::getTable();
            $return_ar[] = self::getJquery();
            return implode('', $return_ar);
        }
        
        static private function getTable(){
            return HTML::Table(self::getTableHeader().self::getTableData(), 'students_presence_overview_table', 'table table-hover table-sm table-striped');
        }

        static private function getTableHeader(){
            //build table header
            $th_ar = array();
            $th_ar[] = HTML::Th('ID');
            $th_ar[] = HTML::Th('Naam');
            $th_ar[] = HTML::Th('Groep');
            $th_ar[] = HTML::Th('Klimniveau');
            $th_ar[] = HTML::Th('Aanwezig?');
            $tr = HTML::Tr(implode('', $th_ar));
            return HTML::Thead($tr);
        }   

        static private function getTableData(){
            //get all students
            $records_ar = DB_Students_Students::getFullRecords();
            $tr_ar = array();
            foreach($records_ar as $record){
                $args_ar = $tmp_td_ar = array();
                //build checkbox
                $args_ar['type'] = 'checkbox';
                $args_ar['class'] = 'presence_checkbox';
                if($record->present != null){
                    $args_ar['checked'] = true;
                }
                $args_ar['data-student_id'] = $record->id;
                $checkbox = HTML::Input($args_ar);

                //build climbing_level input
                $arg_ar = [];
                $args_ar['type'] = 'text';
                $args_ar['class'] = 'climbing_level_input';
                $args_ar['size'] = '1';
                $args_ar['maxlength'] = '10';
                if($record->climbing_level != null){
                    $args_ar['value'] = $record->climbing_level;
                }
                $args_ar['data-student_id'] = $record->id;
                $args_ar['data-field_name'] = 'climbing_level';
                $climbing_level = HTML::Input($args_ar);

                $tmp_td_ar[] = HTML::Td($record->id);
                $tmp_td_ar[] = HTML::Td($record->first_name.' '.$record->last_name);
                $tmp_td_ar[] = HTML::Td($record->group_name);
                $tmp_td_ar[] = HTML::Td($climbing_level);
                $tmp_td_ar[] = HTML::Td($checkbox);
                $tr_ar[] = HTML::Tr(implode('', $tmp_td_ar), '', ($record->present ? 'table-success' : ''));
            }
            return implode('', $tr_ar);
        }

        static private function getJquery(){
            ob_start();
            ?>
            <script>
            $(document).ready(function(){
                 $('#students_presence_overview_table').DataTable();

                //checkbox handling
                $('.presence_checkbox').on('change', function(e){
                    e.preventDefault();
                    var student_id = $(this).data('student_id');
                        td = $(this).parents('td');
                        $(this).before('<?= FontAwesome::Icon('spinner', 1, false, 'pulse'); ?>');
                    $.ajax({
                        method: 'POST',
                        url: '<?= "http://".PUBLIC_ROOT."students/?page=ajax_set_student_presence_value" ?>',
                        data: {
                            student_id: student_id
                        }
                    }).done(function(result){
                        $('i.fa-spinner').remove();
                        if(result == 'inserted'){
                            td.addClass('table-success');
                            td.removeClass('table-danger');
                        }else{
                            td.addClass('table-danger');
                            td.removeClass('table-success');
                        }
                        // $('.result_container').html(result);
                    });
                });

                $('.climbing_level_input').on('change', function(e){
                    e.preventDefault();
                    var student_id = $(this).data('student_id');
                        field_name = $(this).data('field_name');
                        field_value = $(this).val();
                        td = $(this).parents('td');
                        $(this).before('<?= FontAwesome::Icon('spinner', 1, false, 'pulse'); ?>');
                    $.ajax({
                        method: 'POST',
                        url: '<?= "http://".PUBLIC_ROOT."students/?page=ajax_set_student_field_value" ?>',
                        data: {
                            student_id: student_id,
                            field_name: field_name,
                            field_value: field_value
                        }
                    }).done(function(result){
                        $('i.fa-spinner').remove();
                        if(result){
                            td.addClass('table-success');
                            td.removeClass('table-danger');
                        }else{
                            td.addClass('table-danger');
                            td.removeClass('table-success');
                        }
                        // $('.result_container').html(result);
                    });
                });

            });
            </script>
            <?php
            return ob_get_clean();
        }

    }
?>