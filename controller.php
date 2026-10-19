<?php
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
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
            case "showRegistration":
            case "register":
                new RegistrationView();
                break;
            case "showLogin":
            case "login":
                new LoginView();
                break;
            case "loginRequest":
            case "authenticate":
                handleLogin();
                break;
            case "adminDashboard":
            case "manageBlogs":
                requireAdministrator();
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails(currentUsername());
                $data['reset'] = 0;
                new AdminDashboardView($data);
                break;
            case "blogs":
                requireAuthenticatedUser();
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails(currentUsername());
                new AdminBlogManagementView($data);
                break;
            case "addComment":
                $postId = isset($_POST['postid']) ? (int) $_POST['postid'] : 0;
                if ($postId <= 0) {
                    http_response_code(400);
                    exit('Invalid post identifier.');
                }
                $DBM = new DBManager();
                $DBM->addComment(currentUserId());
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
                $DBM->addComment1(currentUserId());
                header(
                    'Location: controller.php?cmd=openblog1&bloggerid=' . $postId
                );
                exit;
            case "add":
                $DBM = new DBManager();
                $result1 = $DBM->getUserBlogDetails($_POST['username']);
                new BlogPostManagementView($result1);
                break;
            case "registerUser":
            case "registerBlogger":
                $data = handleAdduser();
                setCookie("username",$data['username'],time()+(86400*7));
                $_SESSION['user_id'] = (int) $data['id'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['is_admin'] = false;
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails($data['username']);
                new GuestPostView($data);
                break;

            case "createPost":
            case "addPost":
                requireAuthenticatedUser();
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails(currentUsername());

                $data['blogtitle'] = trim($_POST['blogtitle'] ?? '');
                $data['textarea'] = trim($_POST['textarea'] ?? '');

                if ($data['blogtitle'] === '' || $data['textarea'] === '') {
                    new AdminBlogManagementView($data);
                    break;
                }

                handleAddpost($data, currentUserId());

                // Reload the data after attempting to add the post.
                $data = $DBM->getUserBlogDetails($_COOKIE['username']);
                new AdminBlogManagementView($data);
                break;
            case "updatePost":
                requireAuthenticatedUser();
                $DBM = new DBManager();
                $DBM->updateBlogPost(
                    currentUserId(),
                    isCurrentUserAdministrator()
                );
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
                requireAuthenticatedUser();
                $DBM = new DBManager();
                $DBM->updateComment(
                    currentUserId(),
                    isCurrentUserAdministrator()
                );
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
            case "addPost1":
                requireAuthenticatedUser();
                $data = handleFirstAddpost();
                new BlogPostManagementView($data);
                break;
            case "openblog":
                requireAuthenticatedUser();
                $bloggerid = filter_input(
                    INPUT_GET,
                    'bloggerid',
                    FILTER_VALIDATE_INT
                );
                if (!$bloggerid || $bloggerid < 1) {
                    http_response_code(400);
                    exit('Invalid post identifier.');
                }
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails(currentUsername());
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
                $bloggerid = filter_input(
                    INPUT_GET,
                    'bloggerid',
                    FILTER_VALIDATE_INT
                );
                if (!$bloggerid || $bloggerid < 1) {
                    http_response_code(400);
                    exit('Invalid user identifier.');
                }
                $info['id']=$bloggerid;
                new PreviousPostsView($info);
                break;
            case "openblog6":
                requireAdministrator();
                $userid = filter_input(
                    INPUT_GET,
                    'userid',
                    FILTER_VALIDATE_INT
                );
                if (!$userid || $userid < 1) {
                    http_response_code(400);
                    exit('Invalid user identifier.');
                }
                $info['id']=$userid;
                $info['reset2'] = 1;
                new SuspendUsersView($info);
                break;
            case "delete":
                new BlogPostManagementView();
                break;
            case "delete1":
                requireAdministrator();
                handleDeleteBlogs();
                break;


            case "deleteComment":
            case "deleteComments":
                requireAuthenticatedUser();
                $postId = isset($_POST['bloggerid'])
                    ? (int) $_POST['bloggerid']
                    : 0;

                $commentIds = $_POST['deleteComments'] ?? [];
                if (isset($_POST['commentid'])) {
                    $commentIds = [$_POST['commentid']];
                }

                if ($postId <= 0 || !is_array($commentIds)) {
                    http_response_code(400);
                    exit('Invalid comment deletion request.');
                }

                $DBM = new DBManager();
                $DBM->deleteSelectedCommentsForPost(
                    $postId,
                    $commentIds,
                    currentUserId(),
                    isCurrentUserAdministrator()
                );

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


            case "managePosts":
                requireAuthenticatedUser();
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails(currentUsername());
                if (!isCurrentUserAdministrator()) {
                    $data['username'] = currentUsername();
                    $data['isBlogger'] = true;
                }
                new AdminBlogManagementView($data);
                break;
            case "deletePosts":
            case "delete2":
                requireAuthenticatedUser();
                handleDeleteBlogs1(currentUserId(), isCurrentUserAdministrator());
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails(currentUsername());
                $data['reset'] = 0;
                $returnCommand = $_POST['returncmd'] ?? 'openblog2';
                if ($returnCommand === 'openblog3') {
                    $data['username'] = currentUsername();
                    $data['isBlogger'] = true;
                    new AdminBlogManagementView($data);
                } else {
                    new AdminDashboardView($data);
                }
                break;

            case "deleteUser":
                requireAdministrator();
                handleDeleteUsers();
                new AdminUsersView([]);
                break;
            case "deleterefresh":
                $bloggerid = $_GET['blogid'];
                break;
            case "deleteBlogs":
                requireAuthenticatedUser();
                $DBM = new DBManager();
                $data = $DBM->getUserBlogDetails(currentUsername());
                $data['reset']=0;
                new DeleteBlogPostsView($data);
                break;
            case "openblog2":
                requireAuthenticatedUser();
                $bloggerid = filter_input(
                    INPUT_GET,
                    'bloggerid',
                    FILTER_VALIDATE_INT
                );
                $info['bloggerid']=$bloggerid;
                $info['reset'] = 1;
                if (!isCurrentUserAdministrator()) {
                    $DBM = new DBManager();
                    $info = array_merge(
                        $DBM->getUserBlogDetails(currentUsername()),
                        $info
                    );
                    $info['username'] = currentUsername();
                    $info['isBloggerAllBlogs'] = true;
                }
                new AdminDashboardView($info);
                break;
            case "openblog3":
                requireAuthenticatedUser();
                $DBM = new DBManager();
                $info = $DBM->getUserBlogDetails(currentUsername());
                $info['username'] = currentUsername();
                $info['isBlogger'] = true;
                $info['bloggerid'] = isset($_GET['bloggerid'])
                    ? (int) $_GET['bloggerid']
                    : 0;
                $info['reset'] = 1;
                new AdminBlogManagementView($info);
                break;
            case "bloggerAllBlogs":
                requireAuthenticatedUser();
                $DBM = new DBManager();
                $info = $DBM->getUserBlogDetails(currentUsername());
                $info['username'] = currentUsername();
                $info['isBloggerAllBlogs'] = true;
                new AdminDashboardView($info);
                break;
            case "openblog4":
                requireAdministrator();
                $info['id']=$_GET['userid'];
                $info['reset1'] = 1;
                new DeleteUsersView($info);
                break;
            case "manageUsers":
                requireAdministrator();
                new AdminUsersView([]);
                break;
            case "deleteSelectedUsers":
                requireAdministrator();
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
                requireAdministrator();
                handleSuspendUsers();
                new AdminUsersView([]);
                break;
            case "logout":
                $_SESSION = [];
                session_destroy();
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


        if ($result !== "invalid"){
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['is_admin'] = $result['username'] === 'rmiller';
                    setCookie("username",$result['username'],time()+3600 );
        }

        if ($result !== "invalid" && $result['username'] === "rmiller"){
                    $result1 = $DBM->getUserBlogDetails($result['username']);
                    $result1['reset']=0;
                    new AdminDashboardView($result1);
        }
            // else if ($result == "blogger")   {
            // // no output before setCookie
            // setCookie("username",$_POST['username'],time()+3600 );
            //         $result1 = $DBM->getUserBlogDetails($_POST['username']);
            //         new BlogPostManagementView($result1);
            // }
            else if ($result !== "invalid") {
                    // no output before setCookie
                    $result1 = $DBM->getUserBlogDetails($result['username']);
                    $result1['username'] = $result['username'];
                    $result1['isBlogger'] = true;

                    new AdminBlogManagementView($result1);
                }
            else
            {
                    new LoginView(true);
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

    function handleAddpost($data, $userId){

        $DBM = new DBManager();
        $data = $DBM->createBlogPost($data, $userId);
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

    function handleDeleteBlogs1($userId, $isAdmin)
     {
         $DBM = new DBManager();
         $info = $DBM->deleteSelectedPosts($userId, $isAdmin);
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

     function currentUserId(){
         return isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 0;
     }

     function currentUsername(){
         return $_SESSION['username'] ?? '';
     }

     function isCurrentUserAdministrator(){
         return !empty($_SESSION['is_admin']);
     }

     function requireAuthenticatedUser(){
         if (currentUserId() <= 0) {
             http_response_code(401);
             exit('Authentication required.');
         }
     }

     function requireAdministrator(){
         requireAuthenticatedUser();
         if (!isCurrentUserAdministrator()) {
             http_response_code(403);
             exit('Administrator access required.');
         }
     }
?>
