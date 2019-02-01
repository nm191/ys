<?php
    class Admin_Users_Tables_UsersTable{

        static public function get(){
            $return_ar[] = self::getConfirmationDialog();
            $return_ar[] = self::getTable();
            $return_ar[] = self::getJquery();

            return HTML::Div(implode('', $return_ar), '', 'content-container');
        }

        static private function getConfirmationDialog(){
            return HTML::Div(HTML::P('Weet je zeker dat je deze gebruiker wilt verwijderen?'), 'dialog-confirm');
        }

        static private function getTable(){
            return HTML::Table(self::getTableHeader().self::getTableData(), 'students_overview_table', 'table table-hover table-sm table-striped');
        }

        static private function getTableHeader(){
            //build table header
            $th_ar = array();
            $th_ar[] = HTML::Th('ID');
            $th_ar[] = HTML::Th('Naam');
            $th_ar[] = HTML::Th('Naam Kort');
            $th_ar[] = HTML::Th('E-mail');
            $th_ar[] = HTML::Th('Opties');
            $tr = HTML::Tr(implode('', $th_ar));
            return HTML::Thead($tr);
        }   

        static private function getTableData(){
            //get all students
            $records_ar = DB_Users_Users::getFullRecords();
            $tr_ar = array();
            foreach($records_ar as $record){
                $tmp_td_ar = array();
                //build options_ar
                $options_ar = array();
                $options_ar[] = HTML::A(FontAwesome::Icon('pencil'), array('href' => '?page=add_user&user_id='.$record->id), '', 'btn btn-secondary btn-sm');
                $args_ar['data-id'] = $record->id;
                $args_ar['href'] = '#';
                $options_ar[] = HTML::A(FontAwesome::Icon('trash'), $args_ar, '', 'btn red   btn-sm btn_delete');
                $tmp_td_ar[] = HTML::Td($record->id);
                $tmp_td_ar[] = HTML::Td($record->name);
                $tmp_td_ar[] = HTML::Td($record->short_name);
                $tmp_td_ar[] = HTML::Td($record->email);
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
                                        title: "Gebruiker verwijderen",
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
                                            url: '<?= "http://".PUBLIC_ROOT."admin/users/?page=ajax_delete_user" ?>',
                                            method: 'GET',
                                            data: {user_id : id}
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