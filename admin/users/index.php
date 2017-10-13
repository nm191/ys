<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/ys/classes/config.php');

    //get current page name / set default page name
    if(isset($_GET['page'])){
        $current_page_name = $_GET['page'];
    }else{
        $current_page_name = 'user_overview';
    }

    $get_params_to_models_ar = array('user' => 'Admin_Users_Models_UserModel');
    $models_ar = [];
    
    foreach($get_params_to_models_ar as $param_name => $model_name){
        if(isset($_GET[$param_name.'_id'])){
            $models_ar[$param_name] = new $model_name($_GET[$param_name.'_id']);
        }else{
            $models_ar[$param_name] = new $model_name(0);
        }
    }

    
    $show_tabmenu = true;
    switch($current_page_name){
        case 'add_user':
            $page_content_ar[] = Admin_Users_Forms_UserForm::get($models_ar['user']);
            break;
        case 'user_overview':
            $page_content_ar[] = Admin_Users_Tables_UsersTable::get();
            break;
        case 'ajax_delete_user':
            if(!isset($_GET['user_id'])){die(false);}
            die(DB_Users_Users::delete($_GET['user_id']));
            break;
        case 'ajax_handle_form_post':
            if(empty($_POST)){
                die(Bootstrap::Alert('Error: geen data meegegeven', 'danger'));
            }
            $id = DB_Users_Users::store($_POST);
            if($id){
                die(Bootstrap::Alert('Gelukt! De gegevens zijn successvol toegevoegd!', 'success'));
            }else{
                die(Bootstrap::Alert('Helaas! Er ging iets mis met het opslaan van de gegevens.', 'danger'));
            }
            break;
        default:
            $page_content_ar[] = ErrorPages::get404();
            break;
    }
?>


<?php
    include '../../includes/header.php';
    if($show_tabmenu){
        echo Admin_Users_Tabmenu::get($current_page_name);
    }
    echo implode('', $page_content_ar);
    include '../../includes/footer.php';
?>