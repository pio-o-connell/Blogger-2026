<?php


abstract class OutsideView {

    public function top() {
    echo "
    <!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>Blogger | Ideas worth sharing</title>
        <link rel=\"stylesheet\" href=\"myStyles.css\">
    </head>

    <body>
        <div id=\"main\">

            <header id=\"header\">
                <a class=\"site-logo\" href=\"controller.php\">
                    <img src=\"icon.jpg\" alt=\"Blogger logo\">
                </a>
                <p class=\"site-tagline\">Ideas worth sharing.</p>
            </header>

        ";
    }

    public function menu() {
        echo "
            <nav id=\"menu\" aria-label=\"Main navigation\">

              <span class=\"home-text\">Home</span>

                <div class=\"menu-account\">
                    <a href=\"controller.php?cmd=login\">Login</a>
                    <a class=\"register-link\" href=\"controller.php?cmd=register\">Register</a>
                </div>
            </nav>
        ";
    }

    public function bloggerList() {
        echo "
            <section id=\"bloggerlist\">
                <h2>Latest posts</h2>
        ";

        $DBM = new DBManager();
        $DBM->retrieveallblogsanddisplay();

        echo "
            </section>
        ";
    }

    public function bottom() {
        echo "
                <footer id=\"footer\">
                    <p>Blogger &copy; 2026</p>
                </footer>

            </div>
        </body>
        </html>
        ";
    }
}



 class InsideView{
       
     public function __construct($info){
            $this->top();
            $this->menu();
            $this->content($info);
            $this->bloggerList();       
            $this->bottom();           
        }
    
            public function top($mainClass = '') {
                $classAttribute = $mainClass !== ''
                    ? ' class="' . htmlspecialchars($mainClass, ENT_QUOTES, 'UTF-8') . '"'
                    : '';

                echo "
                <!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                    <title>Blogger | Ideas worth sharing</title>
                    <link rel=\"stylesheet\" href=\"insidestyles.css\">
                </head>
                <body>
                    <div id=\"main\"$classAttribute>
                        <header id=\"header\">
                            <a class=\"site-logo\" href=\"controller.php\">
                                <img src=\"icon.jpg\" alt=\"Blogger logo\">
                            </a>
                            <p class=\"site-tagline\">Ideas worth sharing.</p>
                        </header>
                ";
            }

        
            public function menu() {
                echo "
                    <div id=\"menu\"></div>
                ";
            }         
        

            public function content($info){

                echo " 

                    <div id=\"content\">
                                <h1> Add a post!!</h1>
                                <FORM METHOD=\"post\" ACTION=\"controller.php\">

                                
                                        <input type=\"hidden\" name=\"cmd\" value=\"addPost\">
                                    // <textarea>
                                    <textarea name=\"textarea\" ROWS=6 COLS=50>
                                        Add post here!
                                        </textarea>

                                            
                        
                                <input type=\"submit\" value=\"addPost\">
                            </FORM>
                            
                                
                            </div>
                            ";       
                        }

        
            public function bloggerList()
            {

                
                    echo "
                        <div id=\"bloggerlist\">               
                            <h3> blogger list </h3>";
        
                    echo "</div>";               
            }
        
            public function bottom(){
                echo "
                </div>

                </body>
                </html>        
                ";
            }       
}    
    

// splash screen view
    class View1 extends OutsideView{
            
        
            public function __construct(){
                $this->top();
                $this->menu();
                $this->bloggerList();   
                $this->content();               
                $this->bottom();               
            }
        
            public function content() {

                echo "
                    <section id=\"content\">

                        <p class=\"post-meta\">WELCOME TO BLOGGER</p>

                        <h1>Ideas worth sharing.</h1>

                        <p>
                            A place to share your thoughts, experiences and ideas
                            with the world.
                        </p>

                        <p>
                            Discover posts from our community, explore different
                            perspectives, and find something interesting to read.
                        </p>

                        <div class=\"welcome-actions\">
                            <a class=\"read-more\" href=\"controller.php?cmd=register\">
                                Start your own blog &rarr;
                            </a>

                            <a class=\"read-more\" href=\"controller.php?cmd=login\">
                                Sign in &rarr;
                            </a>
                        </div>

                    </section>
                ";

            }

            public function bloggerList() {

                echo "
                    <aside id=\"bloggerlist\">
                        <h2>Explore our blogs</h2>
                        <p class=\"blog-list-intro\">
                            Meet our writers and discover their latest posts.
                        </p>
                ";

                $DBM = new DBManager();
                $DBM->retrieveallblogsanddisplay();

                echo "
                    </aside>
                ";
            }

            
        }



    class View2 extends OutsideView
    {
        public function __construct()
        {
            $this->top();
            $this->menu();
            $this->content();
            $this->bottom();
        }

        public function content()
        {
            echo '
                <main id="content" class="auth-page">
                    <section class="auth-panel">

                        <p class="auth-eyebrow">BLOGGER.COM</p>

                        <h1>Welcome back</h1>

                        <p class="auth-intro">
                            Log in to your account to continue reading
                            and sharing your thoughts.
                        </p>

                        <form method="post" action="controller.php">
                            <input type="hidden"
                                name="cmd"
                                value="loginRequest">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    autocomplete="username"
                                    placeholder="Enter your username"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    autocomplete="current-password"
                                    placeholder="Enter your password"
                                    required
                                >
                            </div>

                            <button type="submit" class="auth-button">
                                Log in
                            </button>
                        </form>

                        <p class="auth-footer">
                            New to Blogger?
                            <a href="controller.php?cmd=register">
                                Create an account
                            </a>
                        </p>

                    </section>
                </main>
            ';
        }
    }





class View3 extends OutsideView {
    public function __construct($info){
            $this->top();
        //    $this->menu();
        //    $this->bloggerList();
            
 
            
            $this->bloggerList();
            $this->content($info);
            
            $this->bottom();

            
        }
        
    public function content($info){

                    $DBM = new DBManager();           
                    $data = $DBM->displayPreviousBlogs($info);
                    
    }
       
    public function bloggerList(){
        
        echo "
                <div id=\"bloggerlist\">
                <h3> blogger list </h3>";
                
        //        echo"  in blofferlist";
                $DBM = new DBManager();
                $DBM->outerretrieveallblogsanddisplay();
        echo "</div>
        ";
    }
    
    function bottom(){
        echo "
        </div>

        </body>
        </html>        
        ";
    }    
}  

class View31 extends OutsideView {
    public function __construct($info){
            $this->top();
            $this->menu();
           $this->bloggerList();
            $this->content($info);
            $this->bottom();           
        }
        
       public function content($info){

           echo " 

            <div id=\"content\">
                        <h1> Welcome Guest  </h1>
                        <FORM METHOD=\"post\" ACTION=\"controller.php\">
                            <input type=\"hidden\" name=\"cmd\" value=\"addPost1\">
                            <input type=\"hidden\" name=\"id\" value=\"{$info['id']}\">
                            <input type=\"hidden\" name=\"blogtitle\" > "; 
                            
                        echo " <textarea name=\"textarea\" ROWS=6 COLS=50> Add post here!
                                                                        </textarea>
                            <input type=\"submit\" value=\"send data\">";
                            $DBM = new DBManager();
                        
                            $data = $DBM->displayPreviousBlogs1($info);
                            
                            
                    echo "</FORM>  
                            
                    
                        
                </div>
                    ";
           
        }

        
       public function bloggerList(){
           
            echo "
                 <div id=\"bloggerlist\">
                    <h3> blogger list </h3>";
                    
          //        echo"  in blofferlist";
                  $DBM = new DBManager();
                  $DBM->retrieveallblogsanddisplay();
            echo "</div>
            ";
        }
        
        public function bottom(){
            echo "
            </div>

            </body>
            </html>        
            ";
        }    
}   


class ViewSinglePost extends OutsideView
{
    public function __construct($post)
    {
        $this->top();
        $this->menu();

        echo '<main id="content">';

        if (!$post) {
            echo '<h1>Post not found</h1>';
            echo '<p>This post may have been removed.</p>';
            echo '<p><a class="read-more" href="controller.php">Back to home</a></p>';
        } else {
            $title = htmlspecialchars(
                $post['title'] ?? '',
                ENT_QUOTES,
                'UTF-8'
            );

            $body = htmlspecialchars(
                $post['body'] ?? '',
                ENT_QUOTES,
                'UTF-8'
            );

            $blogTitle = htmlspecialchars(
                $post['blogtitle'] ?? '',
                ENT_QUOTES,
                'UTF-8'
            );

            $username = htmlspecialchars(
                $post['username'] ?? '',
                ENT_QUOTES,
                'UTF-8'
            );

            echo '<article class="blog-post single-post">';
            echo '<p class="post-meta">' .
                 $blogTitle . ' · by ' . $username .
                 '</p>';

            echo '<h1>' . $title . '</h1>';

            echo '<div class="post-body">' .
                 nl2br($body) .
                 '</div>';

            echo '<p><a class="read-more" href="controller.php">' .
                 '&larr; Back to all posts</a></p>';

            echo '</article>';
        }

        echo '</main>';

        $this->bottom();
    }
}









// Registration view
class View4 extends OutsideView
{
    public function __construct()
    {
        $this->top();
        $this->menu();
        $this->content();
        $this->bottom();
    }

    public function content()
    {
        echo '
            <main id="content" class="auth-page">
                <section class="auth-panel">
                    <h1>Create your account</h1>
                    <p class="auth-intro">
                        Join Blogger and share your ideas.
                    </p>

                    <form method="post" action="controller.php">
                        <input type="hidden" name="cmd" value="addBlogger">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                autocomplete="username"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                autocomplete="new-password"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                autocomplete="email"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="blogtitle">Blog title</label>
                            <input
                                type="text"
                                id="blogtitle"
                                name="blogtitle"
                                required
                            >
                        </div>

                        <button type="submit" class="auth-button">
                            Create account
                        </button>
                    </form>

                    <p class="auth-footer">
                        Already registered?
                        <a href="controller.php?cmd=login">Log in</a>
                    </p>
                </section>
            </main>
        ';
    }
}
   
class View5 extends InsideView {
    public function __construct($info){
            $this->top();
            $this->menu(); 
            $this->content($info);
            $this->bloggerList();
            
            $this->bottom();

            
        }
        
       public function content($info){

            echo "  $info[blogtitle] $info[id]

	<div id=\"content\">
                  <h1> $info[blogtitle]  </h1>
                  <FORM METHOD=\"post\" ACTION=\"controller.php\">
                    <input type=\"hidden\" name=\"cmd\" value=\"addPost\">
                    <input type=\"hidden\" name=\"id\" value=$info[id]>
                    <input type=\"hidden\" name=\"blogtitle\" value=$info[blogtitle]>
                    
                       <textarea name=\"textarea\" ROWS=6 COLS=50> Add post here!
                        </textarea>
                    <input type=\"submit\" value=\"send data\">
                    
            </FORM>
           ";
 
          
          $DBM = new DBManager();
          $DBM->displayPreviousBlogs($info);   
           echo "</div>";
            
            
  
        }

    
    
  
        
       public function bloggerList(){
           
            echo "
                 <div id=\"bloggerlist\">
                    <h3> blogger list </h3>";
                  $DBM = new DBManager();
                  $DBM->retrieveblogsanddisplay();
            echo "</div>
            ";

           
           
       }
        
        function bottom(){
            echo "
            </div>

            </body>
            </html>        
            ";
        }    
}
class View51 extends InsideView {
    public function __construct($info){
            $this->top();
            $this->menu();
        //    $this->bloggerList();
            
 
            $this->content($info);
            $this->bloggerList();
            
            $this->bottom();

            
        }
        
       public function content($info){

         
        echo "
	<div id=\"content\">
                  <h1>   </h1>
                  <FORM METHOD=\"post\" ACTION=\"controller.php\">
                    <input type=\"hidden\" name=\"cmd\" value=\"addPost\">
                    <input type=\"hidden\" name=\"id\" value=\"{$info['id']}\">
                    <tr>
                        <td>Blog title:</td>
                        <td><input type=\"text\" name=\"blogtitle\"></td>
                    </tr>
                    
                       <textarea name=\"textarea\" ROWS=6 COLS=50> Add post here!
                        </textarea>
                    <input type=\"submit\" value=\"send data\">
                    
            </FORM>
           ";
                    
         
           $DBM = new DBManager();
           $DBM->displayPreviousBlogs($info);
  //         $DBM->processComments();   
           echo "</div>";
            
            
  
        }

    
       public function bloggerList(){
           
            echo "
                 <div id=\"bloggerlist\">
                    <h3> blogger list </h3>";
                    
          //        echo"  in blofferlist";
                  $DBM = new DBManager();
                  $DBM->retrieveallblogsanddisplay();
            echo "</div>
            ";

           
           
       }
        
        function bottom(){
            echo "
            </div>

            </body>
            </html>        
            ";
        }    
}


// delete blogs
class View6 extends InsideView {
    public function __construct($info){
            $this->top();
            $this->menu();
        //    $this->bloggerList();
            
 
            $this->content($info);
            $this->bloggerList();
            
            $this->bottom();

            
        }
        
       public function content($info){

            echo " 

	<div id=\"content\">
                  <h1> Delete Blogs -- click link to view contents </h1>
                  <FORM METHOD=\"post\" ACTION=\"controller.php\">
                    <input type=\"hidden\" name=\"cmd\" value=\"delete1\">
                    <input type=\"hidden\" name=\"id\" value=\"{$info['id']}\">
                    <input type=\"hidden\" name=\"blogtitle\" value=>";
           
           $DBM = new DBManager();
           $DBM->retrieveuserblogsanddisplay($info);
           
           if ($info['reset'] != 0)
           {
               $DBM = new DBManager();
               $DBM->retrievebody($info);
                    
           }            
           echo"         <input type=\"submit\" value=\"Delete1\">
                    
                    </FORM>
           ";
         
     //      $DBM->processComments();   
           echo "</div>";
            
            
  
        }

    
    
    
        
       public function bloggerList(){
           
            echo "
                 <div id=\"bloggerlist\">
                    <h3> blogger list </h3>";
                    
          //        echo"  in blofferlist";
                  $DBM = new DBManager();
                  $DBM->retrieveallblogsanddisplay();
            echo "</div>
            ";

           
           
       }
        
        function bottom(){
            echo "
            </div>

            </body>
            </html>        
            ";
        }    
}


class View7 extends InsideView
{
    // public function __construct($info)
    // {
    //     $this->top('admin-view7');
    //     $this->adminMenu();
    //     $this->content($info);
    //    // $this->postComments();
    //     $this->postComments($info);
    //    // $this->recentPosts();
    //     $this->bottom();
    // }
    public function __construct($info)
    {
        $DBM = new DBManager();

        // Default to the most recent post when none is selected.
        if (empty($info['bloggerid'])) {
            $info['bloggerid'] = $DBM->getMostRecentPostId();
        }

        $this->top('admin-view7');
        $this->adminMenu();
        $this->content($info);
        $this->postComments($info);
        // $this->recentPosts();
        $this->bottom();
    }
    // Horizontal administration navigation
    public function adminMenu()
    {
        echo '
            <nav id="admin-menu" class="admin-navigation"
                 aria-label="Administration navigation">

                <span class="admin-menu-title">Admin</span>

                <div class="menu-account">
                    <a href="controller.php?cmd=users">Users</a>
                    <a href="controller.php?cmd=blogs">Blogs</a>
                    <a href="controller.php?cmd=logout">Log out</a>
                </div>

            </nav>
        ';
    }

    // Left panel: Manage blog posts
    public function content($info)
    {
        echo '
            <main id="content" class="admin-delete-page">
                <header class="page-heading">
                    
                </header>

                <section class="admin-delete-panel">
                    <form method="post" action="controller.php">
                        <input type="hidden" name="cmd" value="delete2">

                        <div class="admin-delete-options">
        ';

        $DBM = new DBManager();
     //   $DBM->retrieveallblogsanddisplay1($info);
        $DBM->retrieveAdminBlogPosts($info);
        // if (isset($info['reset']) && $info['reset'] != 0) {
        //     $DBM->retrievebody($info);
        // }

        echo '
                        </div>

                        <div class="admin-form-actions">
                            <p class="delete-blog-notice">
                                Posts marked Delete will be submitted
                                for removal.
                            </p>

                            <button type="submit" class="auth-button">
                                Submit changes
                            </button>
                        </div>
                    </form>
                </section>
            </main>
        ';
    }

    // Right panel: Comments for the selected blog post
    // public function postComments()
    // {
    //     echo '
    //         <section id="bloggerlist">
    //             <div class="page-heading">

    //             </div>
    //     ';

    //     // Retrieve and display comments for the selected post here.

    //     echo '
    //         </section>
    //     ';
    // }
    // Right panel: Comments for the selected blog post
    
    // public function postComments($info)
    // {
    //     $postId = isset($info['bloggerid'])
    //         ? (int) $info['bloggerid']
    //         : 0;

    //     echo '
    //         <section id="bloggerlist">
    //             <div class="page-heading">
    //                 <h2>Post comments</h2>
    //             </div>
    //     ';

    //     if ($postId <= 0) {
    //         echo '<p class="blog-list-intro">
    //                 Select a blog post from the left to view its comments.
    //             </p>';
    //     } else {
    //         $DBM = new DBManager();
    //         $comments = $DBM->getCommentsForPost($postId);

    //         echo '<p class="blog-list-intro">
    //                 Comments for post #' . $postId . '
    //             </p>';

    //         if (empty($comments)) {
    //             echo '<p>No comments have been added to this post yet.</p>';
    //         } else {
    //             foreach ($comments as $comment) {
    //                 $commentId = (int) $comment['id'];
    //                 $body = htmlspecialchars(
    //                     $comment['body'] ?? '',
    //                     ENT_QUOTES,
    //                     'UTF-8'
    //                 );

    //                 echo '
    //                     <article class="blog-post">
    //                         <p class="post-meta">Comment #' . $commentId . '</p>
    //                         <p class="post-excerpt">' . nl2br($body) . '</p>
    //                     </article>
    //                 ';
    //             }
    //         }
    //     }

    //     echo '</section>';
    // }
    // Right panel: Selected blog post and its comments
    public function postComments($info)
    {
        $postId = isset($info['bloggerid'])
            ? (int) $info['bloggerid']
            : 0;

        echo '
            <section id="bloggerlist">
                <div class="page-heading">
                    <h2>Selected blog post</h2>
                </div>
        ';

        if ($postId <= 0) {
            echo '
                <p class="blog-list-intro">
                    No blog posts are available yet.
                </p>
            ';
            echo '</section>';
            return;
        }

        $DBM = new DBManager();
        $post = $DBM->getPostById($postId);

        if (!$post) {
            echo '
                <p class="blog-list-intro">
                    The selected blog post could not be found.
                </p>
            ';
            echo '</section>';
            return;
        }

        $title = htmlspecialchars(
            $post['title'] ?? '',
            ENT_QUOTES,
            'UTF-8'
        );

        $body = htmlspecialchars(
            $post['body'] ?? '',
            ENT_QUOTES,
            'UTF-8'
        );

        echo '
            <article class="blog-post">
                <h3>' . $title . '</h3>
                <div class="post-excerpt">'
                    . nl2br($body) .
                '</div>
            </article>

            <div class="page-heading">
                <h2>Comments</h2>
            </div>
        ';

        $comments = $DBM->getCommentsForPost($postId);

        if (empty($comments)) {
            echo '
                <p class="blog-list-intro">
                    No comments have been added to this post yet.
                </p>
            ';
        } else {
            foreach ($comments as $comment) {
                $commentId = (int) $comment['id'];

                $commentBody = htmlspecialchars(
                    $comment['body'] ?? '',
                    ENT_QUOTES,
                    'UTF-8'
                );

                echo '
                    <article class="blog-post">
                        <p class="post-meta">
                            Comment #' . $commentId . '
                        </p>

                        <div class="post-excerpt">'
                            . nl2br($commentBody) .
                        '</div>
                    </article>
                ';
            }
        }

        echo '</section>';
    }

    // Right panel: Recent blog posts
    public function recentPosts()
    {
        echo '
            <section id="bloggerlist">
                <div class="page-heading">
                    
                </div>
        ';

        $DBM = new DBManager();
        $DBM->retrieveallblogsanddisplay();

        echo '
            </section>
        ';
    }

    public function bottom()
    {
        echo '
            </div>
            </body>
            </html>
        ';
    }
}



class View8 extends InsideView {
    public function __construct($info){
            $this->top();
            $this->menu();
        //    $this->bloggerList();
            
 
            $this->content($info);
            $this->bloggerList();
            
            $this->bottom();

            
        }
        
       public function content($info){

            echo " 

            <div id=\"content\">
                        <h1> Administrator -- Suspend Users </h1>
                        <FORM METHOD=\"post\" ACTION=\"controller.php\">
                            <input type=\"hidden\" name=\"cmd\" value=\"Suspend\">
                            <input type=\"hidden\" name=\"id\" value=>
                            <input type=\"hidden\" name=\"blogtitle\" value=>";
                            
        
                    $DBM = new DBManager();                   
                    $DBM->retrieveallusersdisplay1($info);                   
                    if ($info['reset2'] != 0)
                    {
                    $DBM = new DBManager();
                    $DBM->retrieveuserdetails($info);
                            
                    }           

                            
                    echo"     <input type=\"submit\" value=\"send data\">
                            
                    </FORM>
                ";
           
            echo "</div>"; 
        }
       
       public function bloggerList(){
           
            echo "
                 <div id=\"bloggerlist\">
                    <h3> blogger list </h3>";

                  $DBM = new DBManager();
                  $DBM->retrieveallblogsanddisplay();
            echo "</div>
            ";                     
       }
        
        public function bottom(){
            echo "
            </div>

            </body>
            </html>        
            ";
        }    
}

class View9 extends InsideView {
    public function __construct($info){
            $this->top();
            $this->menu();
            $this->content($info);
            $this->bloggerList();
            
            $this->bottom();

            
        }
        
       public function content($info){

            echo " 

	<div id=\"content\">
                  <h1> Administrator  Delete Users</h1>
                  <FORM METHOD=\"post\" ACTION=\"controller.php\">
                    <input type=\"hidden\" name=\"cmd\" value=\"deleteUser\">
                    <input type=\"hidden\" name=\"id\" value=>
                    <input type=\"hidden\" name=\"blogtitle\" value=>";
                    
                    
              $DBM = new DBManager();
              $DBM->retrieveallusersdisplay($info);
            
              if ($info['reset1'] != 0)
               {
               $DBM = new DBManager();
               $DBM->retrieveuserdetails($info);
                    
               }           

      echo "   <input type=\"submit\" value=\"delete users\">   </FORM>
           ";

           echo "</div>";
            
            
  
        }

    
    

        
       public function bloggerList(){
           
            echo "
                 <div id=\"bloggerlist\">
                    <h3> blogger list </h3>";
                    
                  $DBM = new DBManager();
                  $DBM->retrieveallblogsanddisplay();
            echo "</div>
            ";

           
           
       }
        
        function bottom(){
            echo "
            </div>

            </body>
            </html>        
            ";
        }    
}


class DBManager{
        
        private $db;
        
        
        public function __construct(){
            

           
            $address = 'mysql:host=127.0.0.1;port=3307;dbname=blogger';
            $username = 'root';
            $password = 'Spring57Local!';
         
           try {
            $this->db = new PDO($address, $username, $password);
    
           }catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo $error_message;
                exit();
           }           
        }
        
        public function processLogin($username, $password){
            
            // get the login details and query database
            
            
            $query = "select * from user";
            
            $resultSet = $this->db->query($query);
    
            while($row = $resultSet->fetch()){
        
                if ( ($row['username']==$username)&& ($row['password']==$password)){
                    if ($username == "rmiller"){
                        return "rmiller";
                    }
                    else{
                        return "blogger";      
                    }
                }
            }
 
            return "invalid";
        }  
        
        public function getBlogindex($username)
        {
            
         $query1 = "select * from user";
            
                
                $resultSet = $this->db->query($query1);
               
                $id=0;
                
                for($i=0;$i<$resultSet->rowCount();$i++){
                    
             
                    $blogger = $resultSet->fetch();
                    
                   
                    if ($username == $blogger['username']){
                       
                        $id = $blogger['id'];
                        $blogtitle = $blogger['blogtitle'];
                //        $textarea = $blogger['textarea'];
                      
                        $data['id']= $id;
                        $data['textarea']= " ";
                        $data['blogtitle'] = $blogtitle;
                        $date['username'] = $username;
                    }
                    
                }
                $data['reset']= 1;
              
                return $data;   
        }

        public function addBlogger(){
                
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                $blogtitle = $_POST['blogtitle'];
                $suspend = 0;

                $blogger = array();
                $data = array();
                $data['blogtitle']=$blogtitle;
    
                $query = "INSERT INTO user (username, password,blogtitle,email,suspend)
                            VALUE ('$username','$password','$blogtitle','$email','$suspend')";
                $this->db->exec($query);               
                
                $query1 = "select * from user";
            
                
                $resultSet = $this->db->query($query1);
               
                $id=0;
                for($i=0;$i<$resultSet->rowCount();$i++){
                    
                
                    $blogger = $resultSet->fetch();
                    
                   
                    if ($username == $blogger['username']){
                       
                        $id = $blogger['id'];
                        
                        $data['id']= $id;
                    }
                    
                }
              
               
                
                $data['blogtitle']= $blogtitle;
                $data['username']=$username;
                $data['id']=$id;
          //      return $id;
                return $data;
              
                }

        public function getMostRecentPostId()
        {
            $query = $this->db->query(
                'SELECT id FROM post ORDER BY id DESC LIMIT 1'
            );

            $postId = $query->fetchColumn();

            return $postId === false ? 0 : (int) $postId;
        }
                
        public function retrieveAdminBlogPosts($info = [])
        {
            $query = $this->db->prepare(
                'SELECT id, title, body
                FROM post
                ORDER BY id DESC'
            );

            $query->execute();
            $posts = $query->fetchAll(PDO::FETCH_ASSOC);

            echo '
                <div class="delete-blog-list">
                    <div class="delete-blog-heading">
                        <span>Blog post</span>
                        <span>Delete</span>
                    </div>
            ';

            if (empty($posts)) {
                echo '
                    <div class="delete-blog-row">
                        <p>No blog posts found.</p>
                    </div>
                ';
            } else {
                foreach ($posts as $post) {
                    $postId = (int) $post['id'];

                    $title = htmlspecialchars(
                        $post['title'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $body = trim(strip_tags($post['body'] ?? ''));
                    $preview = preg_split('/\R/', $body)[0] ?? '';

                    if (strlen($preview) > 120) {
                        $preview = substr($preview, 0, 120) . '...';
                    }

                    $preview = htmlspecialchars(
                        $preview,
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    echo '
                        <div class="delete-blog-row">
                            <div class="delete-blog-details">
                                <a class="delete-blog-title"
                                href="controller.php?cmd=openblog2&amp;bloggerid='
                                . $postId . '">'
                                . $title .
                                '</a>

                                <div class="delete-blog-preview">'
                                    . $preview .
                                '</div>
                            </div>

                            <label class="delete-blog-choice">
                                <input type="checkbox"
                                    name="deletePosts[]"
                                    value="' . $postId . '">
                                <span class="visually-hidden">Delete</span>
                            </label>
                        </div>
                    ';
                }
            }

            echo '</div>';
        }



            
            public function addComment()
            {
                $postId = (int) ($_POST['id'] ?? 0);
                $comment = trim($_POST['comments'] ?? '');

                if ($postId <= 0 || $comment === '') {
                    return;
                }

                $query = "
                    INSERT INTO comments (postid, body, author)
                    VALUES (:postid, :body, :author)
                ";

                $statement = $this->db->prepare($query);
                $statement->execute([
                    'postid' => $postId,
                    'body' => $comment,
                    'author' => 'Guest'
                ]);
            }

            public function addComment1()
            {
                $postId = (int) ($_POST['id'] ?? 0);
                $comment = trim($_POST['comments'] ?? '');
                $author = $_COOKIE['username'] ?? 'Guest';

                if ($postId <= 0 || $comment === '') {
                    return;
                }

                $query = "
                    INSERT INTO comments (postid, body, author)
                    VALUES (:postid, :body, :author)
                ";

                $statement = $this->db->prepare($query);
                $statement->execute([
                    'postid' => $postId,
                    'body' => $comment,
                    'author' => $author
                ]);
            }

            public function getCommentsForPost($postId)
            {
                $postId = (int) $postId;

                if ($postId <= 0) {
                    return [];
                }

                $query = $this->db->prepare(
                    'SELECT id, body
                    FROM comments
                    WHERE postid = :post_id
                    ORDER BY id ASC'
                );

                $query->execute(['post_id' => $postId]);

                return $query->fetchAll(PDO::FETCH_ASSOC);
            }

            public function retrieveallblogsanddisplay() {

                $query = "
                    SELECT
                        post.id,
                        post.bloggerid,
                        post.title,
                        post.body,
                        user.username,
                        user.blogtitle
                    FROM post
                    INNER JOIN user
                        ON post.bloggerid = user.id
                    ORDER BY post.id DESC
                ";

                $resultSet = $this->db->query($query);

                while ($blogger = $resultSet->fetch(PDO::FETCH_ASSOC)) {

                    $postId = (int) $blogger['id'];
                    $username = htmlspecialchars(
                        $blogger['username'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    $blogTitle = htmlspecialchars(
                        $blogger['blogtitle'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    $title = htmlspecialchars(
                        $blogger['title'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    $body = htmlspecialchars(
                        $blogger['body'],
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    echo "
                        <article class=\"blog-post\">
                            <p class=\"post-meta\">
                                {$blogTitle} · by {$username}
                            </p>

                            <h3>
                                <a href=\"controller.php?cmd=openblog1&amp;bloggerid={$postId}\">
                                    {$title}
                                </a>
                            </h3>

                            <p class=\"post-excerpt\">{$body}</p>

                            <a class=\"read-more\"
                            href=\"controller.php?cmd=openblog1&amp;bloggerid={$postId}\">
                                Read post &rarr;
                            </a>
                        </article>
                    ";
                }
            }
          
            public function getPostById($postId)
            {
                $query = "
                    SELECT
                        post.id,
                        post.title,
                        post.body,
                        user.username,
                        user.blogtitle
                    FROM post
                    INNER JOIN user ON post.bloggerid = user.id
                    WHERE post.id = :post_id
                    LIMIT 1
                ";

                $statement = $this->db->prepare($query);
                $statement->execute(['post_id' => (int) $postId]);

                return $statement->fetch(PDO::FETCH_ASSOC);
            }
 
           
           public function outerretrieveallblogsanddisplay(){
               
               
                    $blogger = array();
                    $dummy = array();
                    // get the blogs from the database
                    $query = "select * from post";
                     $resultSet = $this->db->query($query);
               
                    
                    for($i=0;$i<$resultSet->rowCount();$i++){
                    
            
                    $blogger = $resultSet->fetch();
             
                    $dummy = "blooger"."{$blogger['bloggerid']} <br>";
           

                    echo "<a href=\"controller.php?cmd=openblog9&amp;bloggerid={$blogger['bloggerid']}\"> $dummy</a>";
                    
                    
                         

                    }
           }
          
           public function retrieveuserblogsanddisplay($info){
               
                    
                    $blogger = array();
                    $dummy = array();
                    // get the blogs from the database
                    $query = "select * from post";
                    $resultSet = $this->db->query($query);
                    
                    echo "Delete blogs <br>";
                    echo " Y\tN <br>";
                    for($i=0;$i<$resultSet->rowCount();$i++){
                    
            
                    $blogger = $resultSet->fetch();
             
                    if ($info['id'] == $blogger['bloggerid']){
                    $dummy = "blog #"."{$blogger['id']}  "."{$blogger['title']}  <br>";
                    $dummy1= "b".$i;

 //
                  echo "<input type=\"radio\" name=\"$dummy1\" value=\"Y\" checked>";
                  echo "<input type=\"radio\"name=\"$dummy1\" value=\"N\">";
                   echo "<a href=\"controller.php?cmd=openblog&amp;bloggerid={$blogger['id']}\"> $dummy</a><br>";
                   
                   
                    }
                    }
           }
                   
     
            public function retrieveallblogsanddisplay1($info)
            {
                $query = "SELECT * FROM post";
                $resultSet = $this->db->query($query);

                echo '
                    <div class="delete-blog-list">
                        <div class="delete-blog-heading">
                            <span>Blog post</span>
                            <span>Delete</span>
                        </div>
                ';

                while ($blogger = $resultSet->fetch()) {

                    // Use the actual database ID, not the list position.
                    $postId = (int) $blogger['id'];

                    // Prepare the first line of the blog body.
                    $body = $blogger['body'] ?? '';

                    // Convert HTML line breaks and paragraph endings to new lines.
                    $body = preg_replace('/<br\s*\/?>/i', "\n", $body);
                    $body = preg_replace(
                        '/<\/(p|div|li|h[1-6])\s*>/i',
                        "\n",
                        $body
                    );

                    // Remove HTML markup and split into lines.
                    $body = html_entity_decode(
                        strip_tags($body),
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $lines = preg_split('/\R+/', trim($body));
                    $firstLine = trim($lines[0] ?? '');

                    if (strlen($firstLine) > 160) {
                        $firstLine = substr($firstLine, 0, 157) . '...';
                    }

                    $title = htmlspecialchars(
                        $blogger['title'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $preview = htmlspecialchars(
                        $firstLine,
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    echo '
                        <div class="delete-blog-row">

                            <div class="delete-blog-details">
                                <div class="delete-blog-title">
                                    ' . $title . '
                                </div>

                                <div class="delete-blog-preview">'
                                    . ($preview !== '' ? $preview : 'No preview available.')
                                . '</div>
                            </div>

                            <label class="delete-blog-choice">
                                <input type="checkbox"
                                    name="deletePosts[]"
                                    value="' . $postId . '">
                                <span class="visually-hidden">Delete</span>
                            </label>

                        </div>
                    ';
                }

                echo '</div>';
            }

           
            public function retrieveallusersdisplay1($info){
                
                
                $user = array();
                $dummy = array();
                // get the blogs from the database
                $query = "select * from user";
                $resultSet = $this->db->query($query);
                
                echo "Suspend users <br>";
                echo " Y\tN <br>";
                for($i=0;$i<$resultSet->rowCount();$i++){
                
        
                    $user = $resultSet->fetch();
            

                    $dummy = "user #"."{$user['id']}"."{$user['username']}"."{$user['password']}" ."{$user['email']}"."<br>";
                    $dummy1= "b".$i;


                    if ($user['suspend']){
                    echo "<input type=\"radio\" name=\"$dummy1\" value=\"Y\" checked >";
                    echo "<input type=\"radio\"name=\"$dummy1\" value=\"N\" >";
                    }
                    else {
                    echo "<input type=\"radio\" name=\"$dummy1\" value=\"Y\" >";
                    echo "<input type=\"radio\"name=\"$dummy1\" value=\"N\" checked>";  
                    }
                    echo "<a href=\"controller.php?cmd=openblog6&amp;userid={$user['id']}\"> $dummy</a><br>";
                    
                    

                        }
            }
           
           
           
           
           
           
          public function retrievebody($data){
             $query = "select * from post";
             $resultSet = $this->db->query($query);
             
             
             
             
             for($i=0;$i<$resultSet->rowCount();$i++){
              $blogger = $resultSet->fetch();  
              if($blogger['id'] == $data['bloggerid'])
              {echo " <textarea name=\"textarea\" ROWS=6 COLS=50>".
              $blogger['body']." </textarea>" ; 
              
             }       
              
          }
          }
          
          
          
          
          public function retrieveuserdetails($data){
             echo "in retrieve id .. ".$data['id'];
              $query = "select * from user";
             $resultSet = $this->db->query($query);
             
             
             
             
             for($i=0;$i<$resultSet->rowCount();$i++){
              $user = $resultSet->fetch();  
             if($user['id'] == $data['id']){
              echo " <textarea name=\"textarea\" ROWS=6 COLS=50>";
              echo "UserId : {$user['id']}
                  Username : {$user['username']}
              UserPassword : {$user['password']}
                     Email : {$user['email']}";
              echo " </textarea>" ; 
              
             }       
              

          }
             } 
          
           
           public function getDetailsanddisplay(){
                    $blogger = array();
                    $dummy = array();
                    // get the blogs from the database
                    $query = "select * from post";
                    $resultSet = $this->db->query($query);
               
                    
                    for($i=0;$i<$resultSet->rowCount();$i++){
                    
            
                    $blogger = $resultSet->fetch();
             
                    $dummy = "blooger"."{$blogger['bloggerid']} <br>";
            

                   
                    }
           }
           

           
           
           
            public function processBlog($info){
                $data = array();
                
                $blogtitle = $info['blogtitle'];
                $textarea = $info['textarea'];
                $id=$info['id'];
                $data['blogtitle']= $info['blogtitle'];
                $data['textarea']=$info['textarea'];
                $data['id']=$info['id'];
                
                
               
                    
                echo "proces blog feck $id $blogtitle $textarea"
                        ;
              
                $query ="INSERT into post(bloggerid,title,body)
                           VALUES ( '$id','$blogtitle','$textarea')";
                $this->db->exec($query); 
                 return $data;
            }
            
            public function processFirstBlog(){
                $data = array();
                        
                $blogtitle = $_POST['blogtitle'];
               $textarea = $_POST['textarea'];
               $id=$_POST['id'];
               $data['id'] =$id;
               $data['textarea']=$textarea;
               $data['blogtitle'] =$_POST['blogtitle'];
                   

                
              
                $query ="INSERT into post(bloggerid,title,body)
                           VALUES ( '$id','$blogtitle','$textarea')";
                $this->db->exec($query); 
                return $data;
            }
            
            
            
            
            
            
            

            public function displayUsers($info){
                
                $query = "select DISTINCT * from user";
                $resultSet = $this->db->query($query);
                for($i=0;$i<$resultSet->rowCount();$i++){
                    $user = $resultSet->fetch();

                echo "<input type=checkbox name={$user['username']} value={$user['username']}> {$user['username']}<br>";
                }
                return $resultSet;
            }
            
 
            
            public function displayPreviousBlogs($info)
            {
                $this->renderPreviousBlogs($info, 'addComment');
            }

            public function displayPreviousBlogs1($info)
            {
                $this->renderPreviousBlogs($info, 'addComment1');
            }

            private function renderPreviousBlogs($info, $command)
            {
                $userId = (int) $info['id'];

                $query = "
                    SELECT id, bloggerid, title, body
                    FROM post
                    WHERE bloggerid = :user_id
                    ORDER BY id DESC
                ";

                $statement = $this->db->prepare($query);
                $statement->execute(['user_id' => $userId]);

                $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

                if (!$posts) {
                    echo '<p class="empty-state">No previous posts yet.</p>';
                    return;
                }

                $commentQuery = $this->db->prepare("
                    SELECT id, body
                    FROM comments
                    WHERE postid = :post_id
                    ORDER BY id ASC
                ");

                echo '<section class="previous-posts">';
                echo '<h2>Previous posts</h2>';

                foreach ($posts as $post) {
                    $postId = (int) $post['id'];
                    $title = htmlspecialchars(
                        $post['title'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    $body = htmlspecialchars(
                        $post['body'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    echo '<article class="blog-post">';
                    echo '<h3>' . $title . '</h3>';
                    echo '<p class="post-excerpt">' .
                        nl2br($body) .
                        '</p>';

                    echo '<form method="post" action="controller.php">';
                    echo '<input type="hidden" name="cmd" value="' .
                        htmlspecialchars($command, ENT_QUOTES, 'UTF-8') .
                        '">';

                    echo '<input type="hidden" name="id" value="' .
                        $postId . '">';
                    echo '<input type="hidden" name="postid" value="' .
                        $postId . '">';
                    echo '<label for="comment-' . $postId . '">Add a comment</label>';
                    echo '<textarea id="comment-' . $postId .
                        '" name="comments" rows="3" placeholder="Write a comment..." required></textarea>';
                    echo '<button type="submit">Save comment</button>';
                    echo '</form>';

                    $commentQuery->execute(['post_id' => $postId]);
                    $comments = $commentQuery->fetchAll(PDO::FETCH_ASSOC);

                    if ($comments) {
                        echo '<div class="post-comments">';
                        echo '<h4>Comments</h4>';

                        foreach ($comments as $comment) {
                            $commentId = (int) $comment['id'];
                            $commentBody = htmlspecialchars(
                                $comment['body'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            );

                            echo '<p class="comment">';
                            echo '<span class="comment-label">Comment #' .
                                $commentId . '</span> ';

                            echo '</p>';
                        }

                        echo '</div>';
                    }

                    echo '</article>';
                }

                echo '</section>';
            }

            function deleteBloogs(){

            
            $query = "select * from post";
            $resultSet = $this->db->query($query);
 
                    
           for($i=0;$i<$resultSet->rowCount();$i++){
                 $post = $resultSet->fetch();
                 if ($post['bloggerid'] == $_POST['id'] )
                     if ($_POST['b'.$i] == "Y") {

                      $dummy1 = $post['id'];
                      $query1 = "delete post from post where id = $dummy1";
                      $resultSet1 = $this->db->query($query1);
                     }
                     else {
   
                      }         
                               
                           
                  }
            }
              
            
 


            
            public function deleteBloogs1()
            {
                // Nothing selected: leave all posts untouched.
                if (
                    !isset($_POST['deletePosts']) ||
                    !is_array($_POST['deletePosts'])
                ) {
                    return;
                }

                // Validate and collect positive integer IDs.
                $postIds = [];

                foreach ($_POST['deletePosts'] as $submittedId) {
                    $id = filter_var(
                        $submittedId,
                        FILTER_VALIDATE_INT,
                        ['options' => ['min_range' => 1]]
                    );

                    if ($id !== false) {
                        $postIds[] = $id;
                    }
                }

                // Remove duplicate IDs.
                $postIds = array_unique($postIds);

                if (empty($postIds)) {
                    return;
                }

                // Use a prepared statement for safe deletion.
                $statement = $this->db->prepare(
                    "DELETE FROM post WHERE id = ?"
                );

                foreach ($postIds as $id) {
                    $statement->execute([$id]);
                }
            }


            function deleteUsers(){
            

            
            $query = "select * from user";
            $resultSet = $this->db->query($query);
            $dummy = $_POST['b7'];

                    
           for($i=0;$i<$resultSet->rowCount();$i++){
                 $user = $resultSet->fetch();

                     if ($_POST['b'.$i] == "Y") {

                          $dummy1 = $user['id'];
                       $query1 = "delete user from user where id = $dummy1";
                        $resultSet1 = $this->db->query($query1);
                     }
                     else {

                      }         
                               
                           
                  }
            }
            
            
            function SuspendUsers (){
                $query = "select * from user";
            $resultSet = $this->db->query($query);
            $dummy = $_POST['b7'];

                    
           for($i=0;$i<$resultSet->rowCount();$i++){
                 $user = $resultSet->fetch();

                     if ($_POST['b'.$i] == "Y") {

                      $dummy1 = $user['id'];
                      $query1 = "update user set suspend=1  where id = $dummy1";
                     
                     }
                     else {

                        $dummy1 = $user['id'];
                        $query1 = "update user set suspend=0  where id = $dummy1";
                      }         
                       $resultSet1 = $this->db->query($query1);         
                           
                  }
            }
            
            
            
            
            
            
            
}     
      
      
 ?>