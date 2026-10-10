<?php





// abstract class OutsideView{
        

//     //     function top(){
            
            
//     //         echo "
            
//     //         <html>

//     //         <head>

// 	// <link rel=\"stylesheet\" href=\"mystyles.css\">
//     //         </head>

//     //         <body>

// 	// <div id=\"main\">
// 	// 	<div id=\"header\">
// 	// 		<h1>Header</h1>
// 	// 	</div>
            
//     //         ";
            
//     //     }
        
//         public function top() {
//             echo "
//                 <header id=\"header\">
//                     <a class=\"site-logo\" href=\"controller.php\">
//                         <img src=\"icon.jpeg\" alt=\"Blogger logo\">
//                     </a>
//                     <p class=\"site-tagline\">Ideas worth sharing.</p>
//                 </header>
//             ";
//         }



//        public function menu(){
//             echo "
//                  <div id=\"menu\">
//                 <a href=\"controller.php?cmd=login\">Login</a> &nbsp;                
//                        <a href=\"controller.php?cmd=register\">Register</a>
//             </div>


//             ";
            
            
//         }
        
//        public function bloggerList(){
//             echo "
//                  <div id=\"bloggerlist\">
//                     <h3> blogger list </h3>";
                 
//                    $DBM = new DBManager();
//                    $DBM->retrieveallblogsanddisplay();  
            
//             echo "</div>"
//             ;
           
           
//        }
        
//         function bottom(){
//             echo "
//             </div>

//             </body>
//             </html>        
//             ";
//         }
        
       

 
    
        

        
//     }




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
                <a href=\"controller.php\">Home</a>

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

    
    
     function top(){
            
            
            echo "
            
            <html>

            <head>

	<link rel=\"stylesheet\" href=\"insidestyles.css\">
            </head>

            <body>

	<div id=\"main\">
		<div id=\"header\">
			<h1>Header</h1>
		</div>
            
            ";
            
        }
        
       public function menu(){
            echo "
                 <div id=\"menu\">
                <a href=\"controller.php?cmd=login\">Add</a> <br>               
                       <a href=\"controller.php?cmd=register\">Delete</a><br>
                       <a href=\"controller.php?cmd=register\">logout</a><br>
                       
            </div>


            ";
            
            
        }
        
       public function bloggerList(){
           
           
            echo "
                 <div id=\"bloggerlist\">               
                    <h3> blogger list </h3>";
          //echo "in bloggerlist";
           // $DBM = new DBManager();
          //  $DBM->retrieveblogs();
 // get the blogs from the database
 /*               $query = "select * from post";
                $resultSet = $this->db->query($query);
               
    
                for($i=0;$i<$resultSet->rowCount();$i++){
                    
                    echo " here at least";
                    $blogger = $resultSet->fetch();
                    
                    echo "<a href=\"controller.php?cmd=openblog\"> blogger['bloggerid']</a><br>";
                    
         //           if ($username == $blogger['username']){
                       
                  }
*/

                
            echo "</div>";

           
           
       }
        
        function bottom(){
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
        

        // public function content(){

        //     echo "

        //     <div id=\"content\">
        //                 <h1> Welcome to blogger.com </h1>
                        
        //                 blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  
        //                 blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  
        //                 blah blah  blah blah  blah blah  blah blah  blah blah  
        //                 blah blah  blah blah  blah blah  blah blah  blah blah  
        //                 blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  
        //                 blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  
        //                 blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  
        //                 blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  blah blah  
                        
        //             </div>
        //             ";
        
        // }
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

        // public function bloggerList(){
           
        //     echo "
        //          <div id=\"bloggerlist\">
        //             <h3> blogger list </h3>";
                    
        //   //        echo"  in blofferlist";
        //           $DBM = new DBManager();
        //           $DBM->outerretrieveallblogsanddisplay();
        //     echo "</div>
        //     ";
        // }
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
// // login view    
// class View2 extends OutsideView{
        
    
//         public function __construct(){
//             $this->top();
//             $this->menu();
//             $this->bloggerList();
            
 
//             $this->content();
            
            
//             $this->bottom();

            
//         }
        

//         public function content(){

//             echo "

// 	<div id=\"content\">
//                   <h1> login </h1>
//                    <FORM METHOD=\"post\" ACTION=\"controller.php\">

                 
//                         <input type=\"hidden\" name=\"cmd\" value=\"loginRequest\">
                
//                 Username: <input type=\"text\" name=\"username\"> <br>
//                 Password: <input type=\"password\" name=\"password\"> <br>
//                 <input type=\"submit\"\ value=\"loginRequest\">
//             </FORM>

                
//             </div>
//             ";
  
//         }
        
//         public function bloggerList(){
           
//             echo "
//                  <div id=\"bloggerlist\">
//                     <h3> blogger list </h3>";
                    
//           //        echo"  in blofferlist";
//                   $DBM = new DBManager();
//                   $DBM->outerretrieveallblogsanddisplay();
//             echo "</div>
//             ";
//         }
    
        

        
//     }

// Login view
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
                    <h1>Welcome back</h1>
                    <p class="auth-intro">Log in to your Blogger account.</p>

                    <form method="post" action="controller.php">
                        <input type="hidden" name="cmd" value="loginRequest">

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
                                autocomplete="current-password"
                                required
                            >
                        </div>

                        <button type="submit" class="auth-button">Log in</button>
                    </form>

                    <p class="auth-footer">
                        New to Blogger?
                        <a href="controller.php?cmd=register">Create an account</a>
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

        /*   echo " 

	<div id=\"content\">
                  <h1> Welcome Guest  </h1>
                  <FORM METHOD=\"post\" ACTION=\"controller.php\">
                    <input type=\"hidden\" name=\"cmd\" value=\"10\">
                    <input type=\"hidden\" name=\"id\" value=\"{$info['id']}\">
                    <input type=\"hidden\" name=\"blogtitle\" > "; */
                    
            /*     echo " <textarea name=\"textarea\" ROWS=6 COLS=50> Add post here!
                                                                   </textarea>
                    <input type=\"submit\" value=\"send data\">";*/
                     $DBM = new DBManager();
                
                     $data = $DBM->displayPreviousBlogs($info);
                    
                    
      /*      echo "</FORM>  
                       
              
                
           </div>
            ";*/
           
                    


             
  
        }

    
    
     function top(){
            
            
            echo "
            
            <html>

            <head>

	<link rel=\"stylesheet\" href=\"insidestyles.css\">
            </head>

            <body>

	<div id=\"main\">
		<div id=\"header\">
			<h1>Blogger.com</h1>
		</div>
            
            ";
            
        }
        
       public function menu(){
            echo "
                 <div id=\"menu\">
                <a href=\"controller.php?cmd=add\">Add</a> <br>               
                       <a href=\"controller.php?cmd=delete\">Delete</a><br>
                       <a href=\"controller.php?cmd=logout\">logout</a><br>
                       
            </div>


            ";
            
            
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
        //    $this->bloggerList();
            
 
            
           $this->bloggerList();
            $this->content($info);
        //    $this->bloggerList();
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

    
    
     function top(){
            
            
            echo "
            
            <html>

            <head>

	<link rel=\"stylesheet\" href=\"insidestyles.css\">
            </head>

            <body>

	<div id=\"main\">
		<div id=\"header\">
			<h1>Blogger.com</h1>
		</div>
            
            ";
            
        }
        
       public function menu(){
            echo "
                 <div id=\"menu\">
                <a href=\"controller.php?cmd=add\">Add</a> <br>               
                       <a href=\"controller.php?cmd=delete\">Delete</a><br>
                       <a href=\"controller.php?cmd=logout\">logout</a><br>
                       
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
        
        function bottom(){
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







/*class View31 extends OutsideView {
    public function __construct($info){
            $this->top();
         //
           $this->menu();
        //    $this->bloggerList();
            
 
            
            
            $this->content($info);
            $this->bloggerList();
            
            $this->bottom();

            
        }
        
   /*    public function content($info){

           echo " 

	<div id=\"content\">
                  <h1> Welcome  to blooger#{$info['id']} 's blogs </h1>
                  <FORM METHOD=\"post\" ACTION=\"controller.php\">
                    <input type=\"hidden\" name=\"cmd\" value=\"addPost\">
                    <input type=\"hidden\" name=\"id\" value=\"{$info['id']}\">
                    <input type=\"hidden\" name=\"blogtitle\" >";
                    
                       <textarea name=\"textarea\" ROWS=6 COLS=50> Add post here!
                        </textarea>
                    <input type=\"submit\" value=\"send data\">";
            
                    $DBM = new DBManager();
                
                     $data = $DBM->displayPreviousBlogs($info);



echo"

</FORM>
               
                
            </div>
            ";
  
        }
     public function content($info){

          echo " 

	<div id=\"content\">
                  <h1> Welcome Guest  </h1>
                  <FORM METHOD=\"post\" ACTION=\"controller.php\">
                    <input type=\"hidden\" name=\"cmd\" value=\"10\">
                    <input type=\"hidden\" name=\"id\" value=\"{$info['id']}\">
                    <input type=\"hidden\" name=\"blogtitle\" > "; 
                    
                 echo " <textarea name=\"textarea\" ROWS=6 COLS=50> Add post here!
                                                                   </textarea>
                    <input type=\"submit\" value=\"send data\">";
                     $DBM = new DBManager();
                
                     $data = $DBM->displayPreviousBlogs($info);
                    
                    
           echo "</FORM>  
                       
              
                
           </div>
            ";
           
                    


             
  
        }
    
    
     function top(){
            
            
            echo "
            
            <html>

            <head>

	<link rel=\"stylesheet\" href=\"insidestyles.css\">
            </head>

            <body>

	<div id=\"main\">
		<div id=\"header\">
			<h1>Blogger.com</h1>
		</div>
            
            ";
            
        }
        
       public function menu(){
            echo "
                 <div id=\"menu\">
                <a href=\"controller.php?cmd=add\">Add</a> <br>               
                       <a href=\"controller.php?cmd=delete\">Delete</a><br>
                       <a href=\"controller.php?cmd=logout\">Back</a><br>
                       
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
        
        function bottom(){
            echo "
            </div>

            </body>
            </html>        
            ";
        }    
}     */  
// register view   


// class View4 extends OutsideView{
        
    
//         public function __construct(){
//             $this->top();
//             $this->menu();
//             $this->bloggerList();
            
 
//             $this->content();
            
            
//             $this->bottom();

            
//         }
        

//         public function content(){

//             echo "

// 	<div id=\"content\">
//                   <h1> Register </h1>
//                     <form action=\"controller.php\" method=\"post\">
//                 <input type=\"hidden\" name=\"cmd\" value=\"addBlogger\">
//                 <table>
//                     <tr>
//                         <td>username:</td>
//                         <td><input type=\"text\" name=\"username\"> </td>

//                     </tr>
//                     <tr>
//                         <td>password:</td>
//                         <td><input type=\"password\" name=\"password\"></td>
//                     </tr>
//                     <tr>
//                         <td>e-mail address:</td>
//                         <td><input type=\"email\" name=\"email\"></td>
//                     </tr>
//                     <tr>
//                         <td>Blog title:</td>
//                         <td><input type=\"text\" name=\"blogtitle\"></td>
//                     </tr>
//                     <tr>
//                         <td><input type=\"submit\" value=\"Add User\"></td>
//                         <td></td>

//                     </tr> 
                    
                
//             </div>
//             </form>
//             ";
  
//         }

//            public function bloggerList(){
           
//             echo "
//                  <div id=\"bloggerlist\">
//                     <h3> blogger list </h3>";
                    
//           //        echo"  in blofferlist";
//                   $DBM = new DBManager();
//                   $DBM->outerretrieveallblogsanddisplay();
//             echo "</div>
//             ";
//         }
        

        
//     }  

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
        //    $this->bloggerList();
            
 
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

    
    
     function top(){
            
            
            echo "
            
            <html>

            <head>

	<link rel=\"stylesheet\" href=\"insidestyles.css\">
            </head>

            <body>

	<div id=\"main\">
		<div id=\"header\">
			<h1>Blogger.com</h1>
		</div>
            
            ";
            
        }
        
       public function menu(){
            echo "
                 <div id=\"menu\">
                <a href=\"controller.php?cmd=add\">Add</a> <br>               
                       <a href=\"controller.php?cmd=deleteBlogs\">Delete</a><br>
                       <a href=\"controller.php?cmd=logout\">logout</a><br>
                       
            </div>


            ";
            
            
        }
        
       public function bloggerList(){
           
            echo "
                 <div id=\"bloggerlist\">
                    <h3> blogger list </h3>";
                    
          //        echo"  in blofferlist";
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

    
    
     function top(){
            
            
            echo "
            
            <html>

            <head>

	<link rel=\"stylesheet\" href=\"insidestyles.css\">
            </head>

            <body>

	<div id=\"main\">
		<div id=\"header\">
			<h1>Blogger.com</h1>
		</div>
            
            ";
            
        }
        
       public function menu(){
            echo "
                 <div id=\"menu\">
                <a href=\"controller.php?cmd=add\">Add</a> <br>               
                       <a href=\"controller.php?cmd=deleteBlogs\">Delete</a><br>
                       <a href=\"controller.php?cmd=logout\">logout</a><br>
                       
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
           {/*echo "</tr>
                    
                       <textarea name=\"textarea\" ROWS=6 COLS=50> Add post here!
                        </textarea>" ; */
           //    echo "here".$info['bloggerid'];
               $DBM = new DBManager();
               $DBM->retrievebody($info);
                    
           }            
           echo"         <input type=\"submit\" value=\"Delete1\">
                    
                    </FORM>
           ";
         
     //      $DBM->processComments();   
           echo "</div>";
            
            
  
        }

    
    
     function top(){
            
            
            echo "
            
            <html>

            <head>

	<link rel=\"stylesheet\" href=\"insidestyles.css\">
            </head>

            <body>

	<div id=\"main\">
		<div id=\"header\">
			<h1>Blogger.com</h1>
		</div>
            
            ";
            
        }
        
       public function menu(){
            echo "
                 <div id=\"menu\">
                <a href=\"controller.php?cmd=add\">Add</a> <br>               
                       <a href=\"controller.php?cmd=deleteBlogs\">Delete</a><br>
                       <a href=\"controller.php?cmd=logout\">logout</a><br>
                       
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
        
        function bottom(){
            echo "
            </div>

            </body>
            </html>        
            ";
        }    
}
class View7 extends InsideView {
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
                  <h1> Administrator  -Delete Blogs</h1>
                  <FORM METHOD=\"post\" ACTION=\"controller.php\">
                    <input type=\"hidden\" name=\"cmd\" value=\"delete2\">
                   
                    <input type=\"hidden\" name=\"blogtitle\" value=>";
              $DBM = new DBManager();
              $DBM->retrieveallblogsanddisplay1($info);
              
              if ($info['reset'] != 0)
           {/*echo "</tr>
                    
                       <textarea name=\"textarea\" ROWS=6 COLS=50> Add post here!
                        </textarea>" ; */
           //    echo "here".$info['bloggerid'];
               $DBM = new DBManager();
               $DBM->retrievebody($info);
                    
           }             
               echo"     <input type=\"submit\" value=\"send data\">
                    
            </FORM>
           ";
            
           echo "</div>";
            
            
  
        }

    
    
     function top(){
            
            
            echo "
            
            <html>

            <head>

	<link rel=\"stylesheet\" href=\"insidestyles.css\">
            </head>

            <body>

	<div id=\"main\">
		<div id=\"header\">
			<h1>Blogger.com</h1>
		</div>
            
            ";
            
        }
        
       public function menu(){
            echo "
                 <div id=\"menu\">             
                       <a href=\"controller.php?cmd=deleteUsers\">Delete <br> Users</a><br>
                       <a href=\"controller.php?cmd=suspendUsers\">Suspend<br> Users</a><br>
                       <a href=\"controller.php?cmd=logout\">logout</a><br>
                       
            </div>


            ";
            
            
        }
        
       public function bloggerList(){
           
            echo "<div id=\"bloggerlist\">
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
                    
    //                  $DBM = new DBManager();
    //                 $DBM->displayBloggers($info) ;
                $DBM = new DBManager();
           //     $DBM->displayUsers($info); 
             
                $DBM->retrieveallusersdisplay1($info);
            
              if ($info['reset2'] != 0)
               {/*echo "</tr>
                    
                       <textarea name=\"textarea\" ROWS=6 COLS=50> Add post here!
                        </textarea>" ; */
           //    echo "here".$info['bloggerid'];
               $DBM = new DBManager();
               $DBM->retrieveuserdetails($info);
                    
               }           

                     
                     echo"     <input type=\"submit\" value=\"send data\">
                    
            </FORM>
           ";
           
           echo "</div>";
            
            
  
        }

    
    
     function top(){
            
            
            echo "
            
            <html>

            <head>

	<link rel=\"stylesheet\" href=\"insidestyles.css\">
            </head>

            <body>

	<div id=\"main\">
		<div id=\"header\">
			<h1>Blogger.com</h1>
		</div>
            
            ";
            
        }
        
       public function menu(){
            echo "
                 <div id=\"menu\">
                <a href=\"controller.php?cmd=add\">Suspend</a> <br>               
                       <a href=\"controller.php?cmd=deleteUsers\">Delete<br>User</a><br>
                       <a href=\"controller.php?cmd=suspendUsers\">Suspend<br>User</a><br>
                       <a href=\"controller.php?cmd=logout\">logout</a><br>
                       
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
        
        function bottom(){
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
        //    $this->bloggerList();
            
 
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
               {/*echo "</tr>
                    
                       <textarea name=\"textarea\" ROWS=6 COLS=50> Add post here!
                        </textarea>" ; */
           //    echo "here".$info['bloggerid'];
               $DBM = new DBManager();
               $DBM->retrieveuserdetails($info);
                    
               }           

      echo "   <input type=\"submit\" value=\"delete users\">   </FORM>
           ";
       //    $DBM = new DBManager();
      //     $DBM->processComments();   
           echo "</div>";
            
            
  
        }

    
    
     function top(){
            
            
            echo "
            
            <html>

            <head>

	<link rel=\"stylesheet\" href=\"insidestyles.css\">
            </head>

            <body>

	<div id=\"main\">
		<div id=\"header\">
			<h1>Blogger.com</h1>
		</div>
            
            ";
            
        }
        
       public function menu(){
            echo "
                 <div id=\"menu\">
                <a href=\"controller.php?cmd=add\">Add</a> <br>               
                       <a href=\"controller.php?cmd=deleteUsers\">Delete<br>Users</a><br>
                       <a href=\"controller.php?cmd=suspendUsers\">Suspend<br>Users</a><br>
                       <a href=\"controller.php?cmd=logout\">logout</a><br>
                       
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
            
          // $address = 'mysql:host=localhost:3306;dbname=blogger';
        //    $address = 'mysql:host=localhost:3306;dbname=blogger';
        //    $username = 'root';
        //    $password = '';
           
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
 //               $body = "bejaysus";
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
                
            //   public function addComment(){  
            //       echo $_POST['id'];
            //       echo $_POST['comments'];
            //       $dummy ="Guest";
            //       $userid = $_POST['id'];
            //     $comments = $_POST['comments'];
                
            //     $query = "INSERT INTO comments (postid,body,author)
            //                 VALUE ('$userid','$comments','$dummy')";
            //     $this->db->exec($query);   
                  
            //   }
              
              
              
            //   public function addComment1(){  
            //       echo $_POST['id'];
            //       echo $_POST['comments'];
            //       $dummy = $_COOKIE['username'];
            //       $userid = $_POST['id'];
            //     $comments = $_POST['comments'];
                
            //     $query = "INSERT INTO comments (postid,body,author)
            //                 VALUE ('$userid','$comments','$dummy')";
            //     $this->db->exec($query);   
                  
            //   }

  /*         public function retrieveblogsandnotdisplay(){
               
               
                    $blogger = array();
                    $dummy = array();
                    // get the blogs from the database
                    $query = "select * from post";
                     $resultSet = $this->db->query($query);
               
                    
                    for($i=0;$i<$resultSet->rowCount();$i++){
                    
            
                    $blogger = $resultSet->fetch();
             //     
                    $dummy = "blooger"."{$blogger['bloggerid']} <br>";
            //
            
                    
                    
                    
                         

                    }
           }*/
           
           
        //      public function retrieveallblogsanddisplay(){
               
               
        //             $blogger = array();
        //             $dummy = array();
        //             // get the blogs from the database
        //             $query = "select * from post";
        //              $resultSet = $this->db->query($query);
               
                    
        //             for($i=0;$i<$resultSet->rowCount();$i++){
                    
            
        //             $blogger = $resultSet->fetch();
             
        //             $dummy = "blooger"."{$blogger['bloggerid']} <br>";
           
        //     //         echo "<a href=\"controller.php?cmd=openblog\">$dummy </a>";
                  
        //             echo "<a href=\"controller.php?cmd=openblog1&amp;bloggerid={$blogger['bloggerid']}\"> $dummy</a>";
        //            // echo "<input type=\"checkbox\" name=\"{$blogger['bloggerid']}\" value=\"{$blogger['bloggerid']}\"";
                    
                    
                    
                         

        //             }
        //    }


            
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
           
            //         echo "<a href=\"controller.php?cmd=openblog\">$dummy </a>";
                  
                 //   echo "<a href=\"controller.php?cmd=openbloga&amp;bloggerid={$blogger['bloggerid']}\"> $dummy</a>";
                   // echo "<input type=\"checkbox\" name=\"{$blogger['bloggerid']}\" value=\"{$blogger['bloggerid']}\"";
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
                //    echo $dummy1;
            //         echo "<a href=\"controller.php?cmd=openblog\">$dummy </a>";
                 //  echo "{$blogger['id']}  herer";
               //     echo "<a href=\"controller.php?cmd=deleterefesh&amp;blogid={$blogger['id']}\"> $dummy</a>";
               //    echo "<a href=\"controller.php?cmd=openblog&amp;bloggerid={$blogger['id']}\"> $dummy</a>";
                  // echo "<input type=\"checkbox\" name=\"$dummy1\" value=\"{$blogger['id']}\" checked>";
 //
                  echo "<input type=\"radio\" name=\"$dummy1\" value=\"Y\" checked>";
                  echo "<input type=\"radio\"name=\"$dummy1\" value=\"N\">";
                   echo "<a href=\"controller.php?cmd=openblog&amp;bloggerid={$blogger['id']}\"> $dummy</a><br>";
                   
                   
                    }
                    }
           }
                   
           
           
           
                public function retrieveallblogsanddisplay1($info){
               
                    
                    $blogger = array();
                    $dummy = array();
                    // get the blogs from the database
                    $query = "select * from post";
                    $resultSet = $this->db->query($query);
                    
                    echo "Delete blogs <br>";
                    echo " Y\tN <br>";
                    for($i=0;$i<$resultSet->rowCount();$i++){
                    
            
                    $blogger = $resultSet->fetch();
             
                 //   if ($info['id'] == $blogger['bloggerid']){
                    $dummy = "blog #"."{$blogger['id']}  "."{$blogger['title']}  <br>";
                    $dummy1= "b".$i;
              //      echo $dummy1;
            //         echo "<a href=\"controller.php?cmd=openblog\">$dummy </a>";
                 //  echo "{$blogger['id']}  herer";
               //     echo "<a href=\"controller.php?cmd=deleterefesh&amp;blogid={$blogger['id']}\"> $dummy</a>";
               //    echo "<a href=\"controller.php?cmd=openblog&amp;bloggerid={$blogger['id']}\"> $dummy</a>";
                  // echo "<input type=\"checkbox\" name=\"$dummy1\" value=\"{$blogger['id']}\" checked>";
 //
                  echo "<input type=\"radio\" name=\"$dummy1\" value=\"Y\" >";
                  echo "<input type=\"radio\"name=\"$dummy1\" value=\"N\" checked>";
                   echo "<a href=\"controller.php?cmd=openblog2&amp;bloggerid={$blogger['id']}\"> $dummy</a><br>";
                   
                   
              //      }
                    
                    
                         

                    }
           }
           
           
           public function retrieveallusersdisplay($info){
               
                    
                    $user = array();
                    $dummy = array();
                    // get the blogs from the database
                    $query = "select * from user";
                    $resultSet = $this->db->query($query);
                    
                    echo "Delete users <br>";
                    echo " Y\tN <br>";
                    for($i=0;$i<$resultSet->rowCount();$i++){
                    
            
                    $user = $resultSet->fetch();
             
     //               if ($info['id'] == $blogger['bloggerid']){
                    $dummy = "user #"."{$user['id']}"."{$user['username']}"."{$user['password']}" ."{$user['email']}"."<br>";
                    $dummy1= "b".$i;
              //      echo $dummy1;
            //         echo "<a href=\"controller.php?cmd=openblog\">$dummy </a>";
                 //  echo "{$blogger['id']}  herer";
               //     echo "<a href=\"controller.php?cmd=deleterefesh&amp;blogid={$blogger['id']}\"> $dummy</a>";
               //    echo "<a href=\"controller.php?cmd=openblog&amp;bloggerid={$blogger['id']}\"> $dummy</a>";
                  // echo "<input type=\"checkbox\" name=\"$dummy1\" value=\"{$blogger['id']}\" checked>";
 //
                  echo "<input type=\"radio\" name=\"$dummy1\" value=\"Y\" >";
                  echo "<input type=\"radio\"name=\"$dummy1\" value=\"N\" checked>";
                   echo "<a href=\"controller.php?cmd=openblog4&amp;userid={$user['id']}\"> $dummy</a><br>";
                   
                   
                //    }
                    }
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
             
     //               if ($info['id'] == $blogger['bloggerid']){
                     $dummy = "user #"."{$user['id']}"."{$user['username']}"."{$user['password']}" ."{$user['email']}"."<br>";
                     $dummy1= "b".$i;
              //        echo $dummy1;
            //         echo "<a href=\"controller.php?cmd=openblog\">$dummy </a>";
                 //  echo "{$blogger['id']}  herer";
               //     echo "<a href=\"controller.php?cmd=deleterefesh&amp;blogid={$blogger['id']}\"> $dummy</a>";
               //    echo "<a href=\"controller.php?cmd=openblog&amp;bloggerid={$blogger['id']}\"> $dummy</a>";
                  // echo "<input type=\"checkbox\" name=\"$dummy1\" value=\"{$blogger['id']}\" checked>";
 
                      if ($user['suspend']){
                        echo "<input type=\"radio\" name=\"$dummy1\" value=\"Y\" checked >";
                        echo "<input type=\"radio\"name=\"$dummy1\" value=\"N\" >";
                      }
                      else {
                        echo "<input type=\"radio\" name=\"$dummy1\" value=\"Y\" >";
                        echo "<input type=\"radio\"name=\"$dummy1\" value=\"N\" checked>";  
                      }
                      echo "<a href=\"controller.php?cmd=openblog6&amp;userid={$user['id']}\"> $dummy</a><br>";
                   
                   
                //    }
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
              
     //     }
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
            
            //        echo $dummy;
                   
                    }
           }
           
   /*        public function getDetailsandnotdisplay(){
                    $blogger = array();
                    $dummy = array();
                    // get the blogs from the database
                    $query = "select * from post";
                    $resultSet = $this->db->query($query);
               
                    
                    for($i=0;$i<$resultSet->rowCount();$i++){
                    
            //        echo "retrieveblogs";
                    $blogger = $resultSet->fetch();
             //       echo "{$blogger['blogid']} <br>";
                    $dummy = "blooger"."{$blogger['bloggerid']} <br>";
            //
            //        echo $dummy;
                    }
           }
            */
           
           
           
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
                   
      //          echo "we are in first blog";
                // echo $_POST['blogtitle'];
                
              
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
               //     echo "{$user['username']} {$user['password']} <br>";  
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
                    // echo '<input type="hidden" name="id" value="' .
                    //     $postId . '">';

                    // // Keep the existing field for compatibility with the old controller.
                    // echo '<input type="hidden" name="blogcomment" value="comments">';
                    // echo '<input type="hidden" name="postid" value="' .
                    //     (int) $post['bloggerid'] . '">';
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
             //               echo $commentBody;
                            echo '</p>';
                        }

                        echo '</div>';
                    }

                    echo '</article>';
                }

                echo '</section>';
            }

            
            // public function displayPreviousBlogs($info){
            //        echo "<br><br><b>Previous Blogs <br> <br>";
            //        echo "i'm in display previous blogs";
            //        echo "info ".$info['id'];
            //         $user_id = $info['id'];
            //         $post = array();
            //         $dummy = array();
            //         $comments1 = array();
            //         $dummy1 = array();
            //         // get the blogs from the database
            //         $query = "select * from post";
            //         $resultSet = $this->db->query($query);
               
                    
            //         for($i=0;$i<$resultSet->rowCount();$i++){
                    
            //                 $post = $resultSet->fetch();
            //                 $dummy = "comment"."{$post['id']} <br>";
                     
            //                 if ($post['bloggerid'] == $user_id ){
                                
            //                  $dummy2 = $post['id'] ;
            //                  $dummy3 = $post['bloggerid'];
            //                  echo"           <div id=\"content\">                      
            //                  <FORM METHOD=\"post\" ACTION=\"controller.php\">
            //                       <input type=\"hidden\" name=\"cmd\" value=\"addComment\">
            //                        <input type=\"hidden\" name=\"id\" value=$dummy2>
            //                        <input type=\"hidden\" name=\"blogcomment\" value=comments > 
            //                         <input type=\"hidden\" name=\"postid\" value=$dummy3 > ";
                                
            //                         echo "<hr align=\"left\"width=\"100%\">";
            //                         echo "<br><br><br>Title:{$post['title']}<br>";
            //                         echo "<textarea readonly name=\"txtarea1\" ROWS=6 COLS=40> {$post['body']}
            //                         </textarea> <br><br><br>";

            //                    echo "<textarea id= {$post['bloggerid']} name=\"comments\" >Add Comment here </textarea><br>";
            //                    echo "<input type=\"submit\" value=\"Save\" >";
            //                    $query1 = "select * from comments";
            //                    $resultSet1 = $this->db->query($query1);
            //                    for($i=0;$i<$resultSet1->rowCount();$i++){
            //                       $comments1 = $resultSet1->fetch();
            //                       if ($comments1['postid']== $post['id'] ){
            //                            $dummy1 = "&nbsp&nbsp&nbsp<i>comment# "."{$comments1['id']}"."{$comments1['body']}</i> <br>";
            //                            echo $dummy1;
            //                         } 
                           
            //                  }
            //                   echo "</FORM>  
            //             </div>
            // ";
            //             }
                         
            //     }    
            // }
            
            
            // public function displayPreviousBlogs1($info){
            //        echo "<br><br><b>Previous Blogs <br> <br>";
            //        echo "i'm in display previous blogs";
            //        echo "info ".$info['id'];
            //         $user_id = $info['id'];
            //         $post = array();
            //         $dummy = array();
            //         $comments1 = array();
            //         $dummy1 = array();
            //         // get the blogs from the database
            //         $query = "select * from post";
            //         $resultSet = $this->db->query($query);
               
                    
            //         for($i=0;$i<$resultSet->rowCount();$i++){
                    
            //                 $post = $resultSet->fetch();
            //                 $dummy = "comment"."{$post['id']} <br>";
                     
            //                 if ($post['bloggerid'] == $user_id ){
                                
            //                  $dummy2 = $post['id'] ;
            //                  $dummy3 = $post['bloggerid'];
            //                  echo"           <div id=\"content\">                      
            //                  <FORM METHOD=\"post\" ACTION=\"controller.php\">
            //                       <input type=\"hidden\" name=\"cmd\" value=\"addComment1\">
            //                        <input type=\"hidden\" name=\"id\" value=$dummy2>
            //                        <input type=\"hidden\" name=\"blogcomment\" value=comments > 
            //                         <input type=\"hidden\" name=\"postid\" value=$dummy3 > ";
                                
            //                         echo "<hr align=\"left\"width=\"100%\">";
            //                         echo "<br><br><br>Title:{$post['title']}<br>";
            //                         echo "<textarea readonly name=\"txtarea1\" ROWS=6 COLS=40> {$post['body']}
            //                         </textarea> <br><br><br>";

            //                    echo "<textarea id= {$post['bloggerid']} name=\"comments\" >Add Comment here </textarea><br>";
            //                    echo "<input type=\"submit\" value=\"Save\" >";
            //                    $query1 = "select * from comments";
            //                    $resultSet1 = $this->db->query($query1);
            //                    for($i=0;$i<$resultSet1->rowCount();$i++){
            //                       $comments1 = $resultSet1->fetch();
            //                       if ($comments1['postid']== $post['id'] ){
            //                            $dummy1 = "&nbsp&nbsp&nbsp<i>comment# "."{$comments1['id']}"."{$comments1['body']}</i> <br>";
            //                            echo $dummy1;
            //                         } 
                           
            //                  }
            //                   echo "</FORM>  
            //             </div>
            // ";
            //             }
                         
            //     }    
            // }
            
            
            
            
  /*           public function displayPreviousBlogs($info){
                   echo "<br><br><b>Previous Blogs <br> <br>";
            //        echo "i'm in display previous blogs";
            //        echo "info ".$info['id'];
                    $user_id = $info['id'];
                    $post = array();
                    $dummy = array();
                    $comments1 = array();
                    $dummy1 = array();
                    // get the blogs from the database
                    $query = "select * from post";
                    $resultSet = $this->db->query($query);
               
                    
                    for($i=0;$i<$resultSet->rowCount();$i++){
                    
                            $post = $resultSet->fetch();
                            $dummy = "comment"."{$post['id']} <br>";
                     
                            if ($post['bloggerid'] == $user_id ){
                                
                                echo "<hr align=\"left\"width=\"100%\">";
                                echo "<br><br><br>Title:{$post['title']}<br>";
                                echo "<textarea name=\"textarea\" ROWS=6 COLS=40> {$post['body']}
                                </textarea> <br><br><br>";
                                $query1 = "select * from comments";
                                $resultSet1 = $this->db->query($query1);
                                for($i=0;$i<$resultSet1->rowCount();$i++){
                                     $comments1 = $resultSet1->fetch();
                                     if ($comments1['postid']== $post['id'] ){
                                         $dummy1 = "&nbsp&nbsp&nbsp<i>comment# "."{$comments1['id']}"."{$comments1['body']}</i> <br>";
                                  
                                       
                                         echo $dummy1;
                                    } 
                           
                             }
                        }
                }   
            }*/
            function deleteBloogs(){
            
           // echo $_POST['b7'];
           //e echo $_POST['id'];
            
            $query = "select * from post";
            $resultSet = $this->db->query($query);
        //    $dummy = $_POST['b7'];
      //      $query1 = "delete * from post where id = '$dummy'";
     //       $resultSet = $this->db->query($query1);   
//where \'id\' =\'$POST[\'b\'.$i]";   
                    
           for($i=0;$i<$resultSet->rowCount();$i++){
                 $post = $resultSet->fetch();
                 if ($post['bloggerid'] == $_POST['id'] )
                     if ($_POST['b'.$i] == "Y") {
     //                 echo "Removing record index".$i." value".$_POST['b'.$i]."from database <br>";
                      $dummy1 = $post['id'];
                      $query1 = "delete post from post where id = $dummy1";
                      $resultSet1 = $this->db->query($query1);
                     }
                     else {
   //                      echo " Not Removing record index".$i." value".$_POST['b'.$i]."from database <br>";  
                      }         
                               
                           
                  }
            }
              
            
            function deleteBloogs1(){
            
       //     echo $_POST['b7'];
      //      echo $_POST['id'];
            
            $query = "select * from post";
            $resultSet = $this->db->query($query);
       //     $dummy = $_POST['b7'];
      //      $query1 = "delete * from post where id = '$dummy'";
     //       $resultSet = $this->db->query($query1);   
//where \'id\' =\'$POST[\'b\'.$i]";   
                    
           for($i=0;$i<$resultSet->rowCount();$i++){
                 $post = $resultSet->fetch();
  //               if ($post['bloggerid'] == $_POST['id'] )
                     if ($_POST['b'.$i] == "Y") {
            //          echo "Removing record index".$i." value".$_POST['b'.$i]."from database <br>";
                      $dummy1 = $post['id'];
                      $query1 = "delete post from post where id = $dummy1";
                      $resultSet1 = $this->db->query($query1);
                     }
                     else {
             //            echo " Not Removing record index".$i." value".$_POST['b'.$i]."from database <br>";  
                      }         
                               
                           
                  }
            }
            
            function deleteUsers(){
            
       //     echo $_POST['b7'];
      //      echo $_POST['id'];
            
            $query = "select * from user";
            $resultSet = $this->db->query($query);
            $dummy = $_POST['b7'];
      //      $query1 = "delete * from post where id = '$dummy'";
     //       $resultSet = $this->db->query($query1);   
//where \'id\' =\'$POST[\'b\'.$i]";   
                    
           for($i=0;$i<$resultSet->rowCount();$i++){
                 $user = $resultSet->fetch();
  //               if ($post['bloggerid'] == $_POST['id'] )
                     if ($_POST['b'.$i] == "Y") {
           //               echo "Deleting record index".$i." value".$_POST['b'.$i]."from database <br>";
                          $dummy1 = $user['id'];
                       $query1 = "delete user from user where id = $dummy1";
                        $resultSet1 = $this->db->query($query1);
                     }
                     else {
            //             echo " Not Deleting record index".$i." value".$_POST['b'.$i]."from database <br>";  
                      }         
                               
                           
                  }
            }
            
            
            function SuspendUsers (){
                $query = "select * from user";
            $resultSet = $this->db->query($query);
            $dummy = $_POST['b7'];
      //      $query1 = "delete * from post where id = '$dummy'";
     //       $resultSet = $this->db->query($query1);   
//where \'id\' =\'$POST[\'b\'.$i]";   
                    
           for($i=0;$i<$resultSet->rowCount();$i++){
                 $user = $resultSet->fetch();
  //               if ($post['bloggerid'] == $_POST['id'] )
                     if ($_POST['b'.$i] == "Y") {
     //                 echo "Updating record index".$i." value".$_POST['b'.$i]."from database <br>";
                      $dummy1 = $user['id'];
                      $query1 = "update user set suspend=1  where id = $dummy1";
                     
                     }
                     else {
     //                   echo " Updating record index".$i." value".$_POST['b'.$i]."from database <br>"; 
                        $dummy1 = $user['id'];
                        $query1 = "update user set suspend=0  where id = $dummy1";
                      }         
                       $resultSet1 = $this->db->query($query1);         
                           
                  }
            }
            
            
            
            
            
            
            
}     
      
      
 ?>