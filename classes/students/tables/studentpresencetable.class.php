<?php
    class Students_Tables_StudentPresenceTable{
        static $filter_ar = array();

        static public function get($filter_ar = array()){
            //init variables
            self::$filter_ar = $filter_ar;

            //check filter
            if(isset(self::$filter_ar['group_id']) && self::$filter_ar['group_id'] == 0){
                unset(self::$filter_ar['group_id']);
            }elseif(isset(self::$filter_ar['group_id']) && self::$filter_ar['group_id'] == 420){
                self::$filter_ar['contest_group'] = 1;
            }

            $return_ar[] = HTML::P('Presentie van de klimles op <strong>'.date('d-m-Y').'</strong>', '', 'text-center lead present_date_container');
            $return_ar[] = self::getFiltersContainer();
            $return_ar[] = self::getTable();
            $return_ar[] = self::getJquery();
            return implode('', $return_ar);
        }

        static private function getFiltersContainer(){
            //build filter content
            //group_id
            $tmp_args_ar = array();
            $tmp_args_ar['label'] = 'Groep:';  
            $tmp_args_ar['name'] = 'group_id'; 
            $tmp_args_ar['id'] = 'group_id'; 
            $tmp_args_ar['class'] = 'form-control'; 
            $tmp_args_ar['required'] = 'true'; 
            $tmp_args_ar['selected'] = (isset(self::$filter_ar['group_id']) ? self::$filter_ar['group_id'] : 0);
            $tmp_args_ar['options'] = array(0 => 'Alle', 420 => 'Wedstrijd groep') + DB_Students_Groups::getList();
            $form_elements_ar[$tmp_args_ar['name']] = HTML::Select($tmp_args_ar);

            //hidden page name
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'hidden';
            $tmp_args_ar['name'] = 'page'; 
            $tmp_args_ar['id'] = 'page'; 
            $tmp_args_ar['value'] = 'presence'; 
            $form_elements_ar[$tmp_args_ar['name']] =  HTML::Input($tmp_args_ar);

            //filter submit button
            $tmp_args_ar = array();
            $tmp_args_ar['type'] = 'submit';
            $tmp_args_ar['name'] = 'btn_submit'; 
            $tmp_args_ar['id'] = 'btn_submit'; 
            $tmp_args_ar['class'] = 'btn btn-success'; 
            $tmp_args_ar['value'] = 'Toepassen'; 
            $form_elements_ar[$tmp_args_ar['name']] =  HTML::Input($tmp_args_ar);

            $form = HTML::Form(implode('', $form_elements_ar), 'students_presence_filter', '');

            return HTML::Div($form, '', 'bg-primary text-white filter_container');
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
            $th_ar[] = HTML::Th('Huur Materiaal?');
            $th_ar[] = HTML::Th('Aanwezig?');
            $tr = HTML::Tr(implode('', $th_ar));
            return HTML::Thead($tr);
        }   

        static private function getTableData(){
            //get all students
            $records_ar = DB_Students_Students::getFullRecords(self::$filter_ar);
            // dd::show($records_ar);
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
                $args_ar['size'] = '3';
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
                $tmp_td_ar[] = HTML::Td(($record->has_rental_equipment ? FontAwesome::Icon('check', 2) : FontAwesome::Icon('remove', 2)), '', ($record->has_rental_equipment ? 'table-success' : 'table-danger'));
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
                $('#students_presence_overview_table').DataTable({
                    "lengthMenu": [ [-1, 25, 50, 100], ["All", 25, 50, 100] ]
                });

                //checkbox handling
                $('#students_presence_overview_table').on('change', '.presence_checkbox', function(e){
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

                $('#students_presence_overview_table').on('change', '.climbing_level_input', function(e){
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

                $('#students_presence_filter').on('submit', function(e){
                    e.preventDefault();
                    var filter = $(this).serialize();
                    window.location.href = '?'+filter;
                });

            });
            </script>
            <?php
            return ob_get_clean();
        }

    }
?>