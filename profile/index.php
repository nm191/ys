<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/ys/classes/config.php');

    //get current page name / set default page name
    if(isset($_GET['page'])){
        $current_page_name = $_GET['page'];
        unset($_GET['page']);
    }else{
        $current_page_name = 'profile';
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
    
    $filter_ar = [];
    foreach($_GET as $field_name => $field_value){
        $filter_ar[$field_name] = $field_value;
    }
    
    $show_tabmenu = true;
    switch($current_page_name){
        case 'profile':
            $page_content_ar[] = Admin_Users_Forms_UserForm::get($models_ar['user']);
            break;
        default:
            $page_content_ar[] = ErrorPages::get404();
            break;
    }
?>


<?php
    include '../includes/header.php';
    echo implode('', $page_content_ar);
    include '../includes/footer.php';
?>