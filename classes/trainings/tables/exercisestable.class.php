<?php
    class Trainings_Tables_ExercisesTable{

        static public function get(){
            $return_ar[] = self::getConfirmationDialog();
            $return_ar[] = self::getTable();
            $return_ar[] = self::getJquery();

            return HTML::Div(implode('', $return_ar), '', 'content-container');
        }

        static private function getConfirmationDialog(){
            return HTML::Div(HTML::P('Weet je zeker dat je deze training wilt verwijderen?'), 'dialog-confirm');
        }

        static private function getTable(){
            return HTML::Table(self::getTableData(), 'exercises_overview_table', 'table highlight');
        }

        private static function getColumnNames(){
            $return_ar['name'] = 'Oefening';
            $return_ar['theme'] = 'Thema';
            $return_ar['exercise_type'] = 'Soort';
            $return_ar['length'] = 'Duur (minuten)';
            $return_ar['options'] = 'Opties ';
            return $return_ar;
        } 

        static private function getTableData(){
            //get all students
            $records_ar = DB_Trainings_Exercises::getFullRecords();

            // get column names
            $column_names = self::getColumnNames();
            $th_ar = [];
            foreach($column_names as $column_name){
                $th_ar[] = HTML::Th($column_name);
            }
            $table_head = HTML::Thead(HTML::Tr(implode('', $th_ar)));

            $tr_ar = [];
            foreach($records_ar as $record){
                $tmp_td_ar = [];
                foreach($column_names as $field_name => $column_name){
                    $cell_value = (isset($record->$field_name) ? $record->$field_name : '');
                    switch($field_name){
                        case 'options':
                            $options_ar = [];
                            $options_ar[] = HTML::A(FontAwesome::Icon('pencil'), array('href' => '?page=add_student&student_id='.$record->id), '', 'btn btn-secondary btn-sm');
                            $args_ar['data-id'] = $record->id;
                            $args_ar['href'] = '#';
                            $options_ar[] = HTML::A(FontAwesome::Icon('trash'), $args_ar, '', 'btn red btn-sm btn_delete');
                            $cell_value = implode('', $options_ar);
                            break;
                    }

                    $tmp_td_ar[] = HTML::Td($cell_value);
                }
               
                $tr_ar[] = HTML::Tr(implode('', $tmp_td_ar));
            }
            return $table_head.HTML::Tbody(implode('', $tr_ar));
        }

        static private function getJquery(){
            ob_start();
            ?>
            <script>
            $(document).ready(function(){
                var $Table = $('#exercises_overview_table').DataTable({
                    "lengthMenu": [ [-1, 25, 50, 100], ["All", 25, 50, 100] ],
                    "fixedHeader": true
                });

                $Table.fixedHeader.headerOffset( 56 );
                var delete_button = $('.btn_delete');
                $('#exercises_overview_table').on('click', '.btn_delete', function(e){
                    e.preventDefault();
                    var id = $(this).data('id');
                        table_row = $(this).parents('tr');
                    $("#dialog-confirm").dialog({
                        title: "Training verwijderen",
                        resizable: false,
                        height: "auto",
                        width: 400,
                        modal: true,
                        buttons: {
                            "Verwijder": function(){
                                deleteStudent();
                                $(this).dialog("close");
                            },
                            "Annuleren" : function(){
                                $(this).dialog("close");
                            }
                        }

                    });

                    function deleteStudent(){
                        $.ajax({
                            url: '<?= "http://".PUBLIC_ROOT."trainings/?page=ajax_delete_training" ?>',
                            method: 'GET',
                            data: {record_id : id}
                        }).done(function(data){
                            if(data){
                                table_row.hide('highlight', function(){table_row.remove();});
                            }else{
                                console.log('error');
                            }
                        });
                    }
                });

            });
            </script>
            <?php
            return ob_get_clean();
        }
    }
?>