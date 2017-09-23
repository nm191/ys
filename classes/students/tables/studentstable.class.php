<?php
    class Students_Tables_StudentsTable{

        static public function get(){
            $return_ar[] = self::getConfirmationDialog();
            $return_ar[] = self::getTable();
            $return_ar[] = self::getJquery();

            return implode('', $return_ar);
        }

        static private function getConfirmationDialog(){
            return HTML::Div(HTML::P('Weet je zeker dat je deze leerling wilt verwijderen?'), 'dialog-confirm');
        }

        static private function getTable(){
            return HTML::Table(self::getTableHeader().self::getTableData(), 'students_overview_table', 'table table-hover table-sm table-striped');
        }

        static private function getTableHeader(){
            //build table header
            $th_ar = array();
            $th_ar[] = HTML::Th('ID');
            $th_ar[] = HTML::Th('Voornaam');
            $th_ar[] = HTML::Th('Achternaam');
            $th_ar[] = HTML::Th('Groep');
            $th_ar[] = HTML::Th('Wedstrijdgroep?');
            $th_ar[] = HTML::Th('Opties');
            $tr = HTML::Tr(implode('', $th_ar));
            return HTML::Thead($tr);
        }   

        static private function getTableData(){
            //get all students
            $records_ar = DB_Students_Students::getFullRecords();
            $tr_ar = array();
            foreach($records_ar as $record){
                $tmp_td_ar = array();
                //build options_ar
                $options_ar = array();
                $options_ar[] = HTML::A(FontAwesome::Icon('pencil'), array('href' => '?page=add_student&student_id='.$record->id), '', 'btn btn-secondary btn-sm');
                $args_ar['data-id'] = $record->id;
                $args_ar['href'] = '#';
                $options_ar[] = HTML::A(FontAwesome::Icon('trash'), $args_ar, '', 'btn btn-danger btn-sm btn_delete');
                $tmp_td_ar[] = HTML::Td($record->id);
                $tmp_td_ar[] = HTML::Td($record->first_name);
                $tmp_td_ar[] = HTML::Td($record->last_name);
                $tmp_td_ar[] = HTML::Td($record->group_name);
                $tmp_td_ar[] = HTML::Td(($record->contest_group ? 'Ja' : 'Nee'));
                $tmp_td_ar[] = HTML::Td(HTML::Div(implode('', $options_ar),'', 'btn-group'));
                $tr_ar[] = HTML::Tr(implode('', $tmp_td_ar));
            }
            return implode('', $tr_ar);
        }

        static private function getJquery(){
            ob_start();
            ?>
            <script>
            $(document).ready(function(){
                 $('#students_overview_table').DataTable({
                     "initComplete" : function(){
                            var delete_button = $('.btn_delete');
                                delete_button.on('click', function(e){
                                    e.preventDefault();
                                    var id = $(this).data('id');
                                        table_row = $(this).parents('tr');
                                    $("#dialog-confirm").dialog({
                                        title: "Leerling verwijderen",
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
                                            url: '<?= "http://".PUBLIC_ROOT."students/?page=ajax_delete_student" ?>',
                                            method: 'GET',
                                            data: {student_id : id}
                                        }).done(function(data){
                                            if(data){
                                                table_row.hide('highlight', function(){table_row.remove();});
                                            }else{
                                                console.log('error');
                                            }
                                        });
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