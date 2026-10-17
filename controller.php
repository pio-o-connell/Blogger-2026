<?php
   include("library.php");

   main();



   function main(){


        $cmd = "";

        if (isset($_POST['cmd'])){
            $cmd = $_POST['cmd'];
        }
        else if (isset($_GET['cmd'])){
            $cmd = $_GET['cmd'];
        }

        switch($cmd){
            case "":
                new HomeView();
                break;
            case "register":
                new RegistrationView();
                break;
            case "login":
                new LoginView();
                break;
            case "loginRequest":
                handleLogin();
                break;
            case "adminDashboard":
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails($_COOKIE['username']);
                $data['reset'] = 0;
                new AdminDashboardView($data);
                break;
            case "blogs":
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails($_COOKIE['username']);
                new AdminBlogManagementView($data);
                break;
            case "addComment":
                $postId = isset($_POST['postid']) ? (int) $_POST['postid'] : 0;
                if ($postId <= 0) {
                    http_response_code(400);
                    exit('Invalid post identifier.');
                }
                $DBM = new DBManager();
                $DBM->addComment();
                header(
                    'Location: controller.php?cmd=openblog1&bloggerid=' . $postId
                );
                exit;
            case "addComment1":
                $postId = isset($_POST['postid']) ? (int) $_POST['postid'] : 0;
                if ($postId <= 0) {
                    http_response_code(400);
                    exit('Invalid post identifier.');
                }
                $DBM = new DBManager();
                $DBM->addComment1();
                header(
                    'Location: controller.php?cmd=openblog1&bloggerid=' . $postId
                );
                exit;
            case "add":
                $DBM = new DBManager();
                $result1 = $DBM->getUserBlogDetails($_POST['username']);
                new BlogPostManagementView($result1);
                break;
            case "registerBlogger":
                $data = handleAdduser();
                setCookie("username",$data['username'],time()+(86400*7));
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails($_COOKIE['username']);
                new GuestPostView($data);
                break;

            case "addPost":
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails($_COOKIE['username']);

                $data['blogtitle'] = trim($_POST['blogtitle'] ?? '');
                $data['textarea'] = trim($_POST['textarea'] ?? '');

                if ($data['blogtitle'] === '' || $data['textarea'] === '') {
                    new AdminBlogManagementView($data);
                    break;
                }

                handleAddpost($data);

                // Reload the data after attempting to add the post.
                $data = $DBM->getUserBlogDetails($_COOKIE['username']);
                new AdminBlogManagementView($data);
                break;
            case "updatePost":
                $DBM = new DBManager();
                $DBM->updateBlogPost();
                $postId = isset($_POST['postid']) ? (int) $_POST['postid'] : 0;
                $returnCommand = $_POST['returncmd'] ?? 'openblog2';
                if (!in_array($returnCommand, ['openblog2', 'openblog3'], true)) {
                    $returnCommand = 'openblog2';
                }
                header(
                    'Location: controller.php?cmd=' . $returnCommand .
                    '&bloggerid='
                    . $postId
                );
                exit;
            case "updateComment":
                $DBM = new DBManager();
                $DBM->updateComment();
                $postId = isset($_POST['postid']) ? (int) $_POST['postid'] : 0;
                header(
                    'Location: controller.php?cmd=openblog2&bloggerid='
                    . $postId
                );
                exit;
            case "addPost1":
                $data = handleFirstAddpost();
                new BlogPostManagementView($data);
                break;
            case "openblog":
                $bloggerid = $_GET['bloggerid'];
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails($_COOKIE['username']);
                $data['reset']=1;
                $data['bloggerid']= $bloggerid;
                new DeleteBlogPostsView($data);
                break;
            case "openblog1":
                $postId = isset($_GET['bloggerid'])
                    ? (int) $_GET['bloggerid']
                    : 0;

                $DBM = new DBManager();
                $post = $DBM->getPostById($postId);
                new SinglePostView($post);
                break;
            case "openblog9":
                $bloggerid = $_GET['bloggerid'];
                $info['id']=$bloggerid;
                new PreviousPostsView($info);
                break;
            case "openblog6":
                $userid=  $_GET['userid'];
                $info['id']=$userid;
                $info['reset2'] = 1;
                new SuspendUsersView($info);
                break;
            case "delete":
                new BlogPostManagementView();
                break;
            case "delete1":
                handleDeleteBlogs();
                break;


            case "deleteComments":
                $postId = isset($_POST['bloggerid'])
                    ? (int) $_POST['bloggerid']
                    : 0;

                $commentIds = $_POST['deleteComments'] ?? [];

                if ($postId <= 0 || !is_array($commentIds)) {
                    http_response_code(400);
                    exit('Invalid comment deletion request.');
                }

                $DBM = new DBManager();
                $DBM->deleteSelectedCommentsForPost($postId, $commentIds);

                $returnCommand = $_POST['returncmd'] ?? 'openblog2';
                if (!in_array($returnCommand, ['openblog2', 'openblog3'], true)) {
                    $returnCommand = 'openblog2';
                }
                header(
                    'Location: controller.php?cmd=' . $returnCommand .
                    '&bloggerid='
                    . $postId
                );
                exit;


            case "manageBlogs": // specifically for admin to view personal blogs
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails($_COOKIE['username']);
                if ($_COOKIE['username'] !== 'rmiller') {
                    $data['username'] = $_COOKIE['username'];
                    $data['isBlogger'] = true;
                }
                new AdminBlogManagementView($data);
                break;
            case "delete2":
                handleDeleteBlogs1();
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails($_COOKIE['username']);
                $data['reset'] = 0;
                $returnCommand = $_POST['returncmd'] ?? 'openblog2';
                if ($returnCommand === 'openblog3') {
                    $data['username'] = $_COOKIE['username'];
                    $data['isBlogger'] = true;
                    new AdminBlogManagementView($data);
                } else {
                    new AdminDashboardView($data);
                }
                break;

            case "deleteUser":
                handleDeleteUsers();
                new AdminUsersView([]);
                break;
            case "deleterefresh":
                $bloggerid = $_GET['blogid'];
                break;
            case "deleteBlogs":
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails($_COOKIE['username']);
                $data['reset']=0;
                new DeleteBlogPostsView($data);
                break;
            case "openblog2":
                $bloggerid=  $_GET['bloggerid'];
                $info['bloggerid']=$bloggerid;
                $info['reset'] = 1;
                if (($_COOKIE['username'] ?? '') !== 'rmiller') {
                    $DBM = new DBManager();
                    $info = array_merge(
                        $DBM->getUserBlogDetails($_COOKIE['username']),
                        $info
                    );
                    $info['username'] = $_COOKIE['username'];
                    $info['isBloggerAllBlogs'] = true;
                }
                new AdminDashboardView($info);
                break;
            case "openblog3":
                $DBM = new DBManager();
                $info = $DBM->getUserBlogDetails($_COOKIE['username']);
                $info['username'] = $_COOKIE['username'];
                $info['isBlogger'] = true;
                $info['bloggerid'] = isset($_GET['bloggerid'])
                    ? (int) $_GET['bloggerid']
                    : 0;
                $info['reset'] = 1;
                new AdminBlogManagementView($info);
                break;
            case "bloggerAllBlogs":
                $DBM = new DBManager();
                $info = $DBM->getUserBlogDetails($_COOKIE['username']);
                $info['username'] = $_COOKIE['username'];
                $info['isBloggerAllBlogs'] = true;
                new AdminDashboardView($info);
                break;
            case "openblog4":
                $info['id']=$_GET['userid'];
                $info['reset1'] = 1;
                new DeleteUsersView($info);
                break;
            case "manageUsers":
                new AdminUsersView([]);
                break;
            case "deleteSelectedUsers":
                $DBM = new DBManager();
                $result1 = $DBM->getUserBlogDetails($_COOKIE['username']);
                $result1['reset1'] = 0;
                new DeleteUsersView($result1);
                break;
            case "suspendBloogers":
                $result1 = $DBM->getUserBlogDetails($_COOKIE['username']);
                new SuspendUsersView($result1);
                break;
            case "suspendUsers":
                $DBM = new DBManager();
                $result1 = $DBM->getUserBlogDetails($_COOKIE['username']);
                $result1['reset2']=0;
                new SuspendUsersView($result1);

                break;
            case "Suspend":
                handleSuspendUsers();
                new AdminUsersView([]);
                break;
            case "logout":
                if(isset($_COOKIE['username'])) {
                    unset($_COOKIE['username']);
                    setcookie("username", "", time() - 3600); // empty value and old timestamp
                }
                new HomeView();
                break;
            case "add":
                break;

        }

   }

   function handleLogin(){

        $DBM = new DBManager();

        $result = $DBM->authenticateUser($_POST['username'],$_POST['password']);


        if ($result == "rmiller"){
                    setCookie("username",$_POST['username'],time()+3600 );
                    $result1 = $DBM->getUserBlogDetails($_POST['username']);
                    $result1['reset']=0;
                    new AdminDashboardView($result1);
        }
            // else if ($result == "blogger")   {
            // // no output before setCookie
            // setCookie("username",$_POST['username'],time()+3600 );
            //         $result1 = $DBM->getUserBlogDetails($_POST['username']);
            //         new BlogPostManagementView($result1);
            // }
            else if ($result == "blogger") {
                    // no output before setCookie
                    setCookie("username", $_POST['username'], time() + 3600);

                    $result1 = $DBM->getUserBlogDetails($_POST['username']);
                    $result1['username'] = $_POST['username'];
                    $result1['isBlogger'] = true;

                    new AdminBlogManagementView($result1);
                }
            else
            {
                    new LoginView();
            }

    }

    function handleAdduser(){
        $DBM = new DBManager();
        $data = $DBM->registerBlogger();

        return $data;
    }

    function handleViewBlogDetails(){
        $DBM = new DBManager();
        $data = $DBM->retrieveblogsandnotdisplay();
        return $data;
    }

    function handleAddpost($data){

        $DBM = new DBManager();
        $data = $DBM->createBlogPost($data);
        return $data;
    }

     function handleFirstAddpost(){
        $DBM = new DBManager();
       return $DBM->createInitialBlogPost();
    }

     function handleDeleteBlogs()
     {
         $DBM = new DBManager();
         $info = $DBM->deleteSelectedUserPosts();
         return $info;
     }

    function handleDeleteBlogs1()
     {
         $DBM = new DBManager();
         $info = $DBM->deleteSelectedPosts();
         return $info;
     }

     function handleDeleteUsers()
     {
        $DBM = new DBManager();
        $info = $DBM->deleteSelectedUsers();
        return $info;
     }

     function handleSuspendUsers()
     {
         $DBM = new DBManager();
         $info = $DBM->updateUserSuspensionStatus();
         return $info;
     }
?>
