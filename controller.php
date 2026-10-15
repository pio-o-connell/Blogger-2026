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
                new View1(); 
                break;
            case "register":
                new View4();
                break;
            case "login":
                new View2();
                break;
            case "loginRequest":
                handleLogin();               
                break;
            case "addComment":       
                $dummy = $_POST['postid'];
                 $DBM = new DBManager();
                 $result1 = $DBM->addComment();
                  $result1['id'] =$dummy;
                 new View3($result1);
                break;
            case "addComment1":
                $DBM = new DBManager();
                $dummy = $_POST['postid'];
                $result1 = $DBM->addComment1();
                 $result1['id'] =$dummy;
                 new View31($result1);           
                break;
            case "add":
                $DBM = new DBManager();
                $result1 = $DBM->getBlogindex($_POST['username']);               
                new View51($result1);           
                break;
            case "addBlogger":
                $data = handleAdduser();           
                setCookie("username",$data['username'],time()+(86400*7));
                $DBM = new DBManager();
                $data = $DBM->getBlogindex($_COOKIE['username']);
                new View31($data);   
                break;
            case "addPost":
                echo $_POST['textarea'];               
                $DBM = new DBManager();
                $data = $DBM->getBlogindex($_COOKIE['username']);
                 handleAddpost($data);
               new View51($data);           
                break;
            case "addPost1":              
                $data = handleFirstAddpost();
                new View51($data);
                break;              
            case "openblog":
                $bloggerid = $_GET['bloggerid'];              
                $DBM = new DBManager();
                $data = $DBM->getBlogindex($_COOKIE['username']);
                $data['reset']=1;
                $data['bloggerid']= $bloggerid;
                new View6($data);
                break;
            case "openblog1":
                $postId = isset($_GET['bloggerid'])
                    ? (int) $_GET['bloggerid']
                    : 0;

                $DBM = new DBManager();
                $post = $DBM->getPostById($postId);
                new ViewSinglePost($post);
                break;  
            case "openblog9":
                $bloggerid = $_GET['bloggerid'];
                $info['id']=$bloggerid;
                new View3($info);
                break;
            case "openblog6":
                $userid=  $_GET['userid'];
                $info['id']=$userid;
                $info['reset2'] = 1;
                new View8($info);               
                break;
            case "delete":
                new View51();
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
                $DBM->deleteCommentsForPost($postId, $commentIds);

                // Return to the same post in the admin dashboard.
                header(
                    'Location: controller.php?cmd=openblog2&bloggerid='
                    . $postId
                );
                exit;

            case "delete2":
                handleDeleteBlogs1();
                $DBM = new DBManager();
                $data = $DBM->getBlogindex($_COOKIE['username']);
                $data['reset'] = 0;
                new AdminDashboardView($data);
                break;

            case "deleteUser":
                handleDeleteUsers();
                $DBM = new DBManager();
                $data = $DBM->getBlogindex($_COOKIE['username']);
                $data['reset1']=0;
                new View9($data);
                break;
            case "deleterefresh":
                $bloggerid = $_GET['blogid'];
                break;
            case "deleteBlogs":
                $DBM = new DBManager();
                $data = $DBM->getBlogindex($_COOKIE['username']);
                $data['reset']=0;
                new View6($data);
                break;
            case "openblog2":
                $bloggerid=  $_GET['bloggerid'];
                $info['bloggerid']=$bloggerid;
                $info['reset'] = 1;
                new AdminDashboardView($info);
                break;
            case "openblog4":
                $info['id']=$_GET['userid'];
                $info['reset1'] = 1;
                new View9($info);               
                break;
            case "deleteUsers":
                $DBM = new DBManager();
                $result1 = $DBM->getBlogindex($_COOKIE['username']);
                $result1['reset1'] = 0;
                new View9($result1);
                break;
            case "suspendBloogers":
                $result1 = $DBM->getBlogindex($_COOKIE['username']);
                new View8($result1);
                break;
            case "suspendUsers":
                $DBM = new DBManager();
                $result1 = $DBM->getBlogindex($_COOKIE['username']);
                $result1['reset2']=0;
                new View8($result1);
               
                break;
            case "Suspend":
                handleSuspendUsers();
                $DBM = new DBManager();
                $result1 = $DBM->getBlogindex($_COOKIE['username']);
                $result1['reset2']=0;
                new View8($result1);
                break;
            case "logout":
                if(isset($_COOKIE['username'])) {
                    unset($_COOKIE['username']);
                    setcookie("username", "", time() - 3600); // empty value and old timestamp
                }
                new View1();
                break;
            case "add":
                break;
            
                
                
                
        }
   
   }
   
   
  
   
   
   
   function handleLogin(){
           
       
       $DBM = new DBManager();
            
       $result = $DBM->processLogin($_POST['username'],$_POST['password']);
       
 
       if ($result == "rmiller"){
                setCookie("username",$_POST['username'],time()+3600 );
                $result1 = $DBM->getBlogindex($_POST['username']);
                $result1['reset']=0;
                new AdminDashboardView($result1);
       }
        else if ($result == "blogger")   {
           // no output before setCookie
           setCookie("username",$_POST['username'],time()+3600 );
                $result1 = $DBM->getBlogindex($_POST['username']);
                
                new View51($result1);
           
        }else{
           
                new View2();
           
       }
       
       }  
       
       
     function handleAdduser(){    
       $DBM = new DBManager();
       $data = $DBM->addBlogger(); 
   
       return $data;
   }
   
    function handleViewBlogDetails(){
        $DBM = new DBManager();
        $data = $DBM->retrieveblogsandnotdisplay(); 
        return $data;
    }
   
   
   
    function handleAddpost($data){
        
        $DBM = new DBManager();
        $data = $DBM->processBlog($data);
        
        return $data;
    }
     function handleFirstAddpost(){
       
        $DBM = new DBManager();       
       return $DBM->processFirstBlog();
       
    }
    
     function handleDeleteBlogs()
     {
         $DBM = new DBManager();
         $info = $DBM->deleteBloogs();
         return $info;
     }
     
    function handleDeleteBlogs1()
     {
         $DBM = new DBManager();
         $info = $DBM->deleteBloogs1();
         return $info;
     }
     
     function handleDeleteUsers()
     {
       $DBM = new DBManager();
         $info = $DBM->deleteUsers();
         return $info;  
     }
    
     function handleSuspendUsers()
     {
        
         $DBM = new DBManager();
         $info = $DBM->SuspendUsers();
         return $info;   
         
     }
?>   