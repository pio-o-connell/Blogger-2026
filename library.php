<?php

// Abstract base view providing the shared layout and navigation for public-facing pages.
// Legacy class name: OutsideView.
    abstract class PublicBaseView {

        // Render the page header and opening document structure.
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

        // Render the navigation area for this view.
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

        // Render the blog list area for this view.
        public function bloggerList() {
            echo "
                <section id=\"bloggerlist\">
                    <h2>Latest posts</h2>
            ";

            $DBM = new DBManager();
            $DBM->displayAllBlogPosts();

            echo "
                </section>
            ";
        }

        // Render the page footer and close the document structure.
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


// Base view providing the shared layout for internal and authenticated pages.
    // Legacy class name: InsideView.
    class AuthenticatedBaseView{

        // Initialize the view and render its complete page.
        public function __construct($info){

           $this->info = $info;
            $this->top();
            $this->menu();
            $this->content($info);
            $this->bloggerList();
            $this->bottom();
        }

            // Render the page header and opening document structure.
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


            // Render the navigation area for this view.
            public function menu() {
                $username = $this->info['username'] ?? $_COOKIE['username'] ?? 'Guest';

                echo '
                <nav id="admin-menu" class="admin-navigation" aria-label="Personal blog navigation">
                    <span class="admin-menu-title">'
                        . htmlspecialchars(ucfirst($username), ENT_QUOTES, 'UTF-8') . ': Personal Blogs
                    </span>

                    <div class="menu-account">
                        <a href="controller.php?cmd=logout">Log out</a>
                    </div>
                </nav>';

                echo '<div id="menu"></div>';
            }


            // Render the main content for this view.
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


            // Render the blog list area for this view.
            public function bloggerList()
            {


                    echo "
                        <div id=\"bloggerlist\">
                            <h3> blogger list </h3>";

                    echo "</div>";
            }

            // Render the page footer and close the document structure.
            public function bottom(){
                echo "
                </div>

                </body>
                </html>
                ";
            }
    }

// Displays the public welcome page and a list of available blog posts.
    // Legacy class name: View1.
    class HomeView extends PublicBaseView{


        // Initialize the view and render its complete page.
        public function __construct(){
            $this->top();
            $this->menu();
            $this->bloggerList();
            $this->content();
            $this->bottom();
        }

        // Render the main content for this view.
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

        // Render the blog list area for this view.
        public function bloggerList() {

            echo "
                <aside id=\"bloggerlist\">
                    <h2>Explore our blogs</h2>
                    <p class=\"blog-list-intro\">
                        Meet our writers and discover their latest posts.
                    </p>
            ";

            $DBM = new DBManager();
            $DBM->displayAllBlogPosts();

            echo "
                </aside>
            ";
        }


    }

// Displays the login form for users attempting to authenticate.
    // Legacy class name: View2.
    class LoginView extends PublicBaseView{
        // Initialize the view and render its complete page.
        public function __construct()
        {
            $this->top();
            $this->menu();
            $this->content();
            $this->bottom();
        }

        // Render the main content for this view.
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

// Retrieves and displays previous posts for the relevant user or blog.
// Legacy class name: View3.
    class PreviousPostsView extends PublicBaseView {
        // Initialize the view and render its complete page.
        public function __construct($info){
                $this->top();
            //    $this->menu();
                $this->bloggerList();
                $this->content($info);
                $this->bottom();

            }

        // Render the main content for this view.
        public function content($info){
            $DBM = new DBManager();
            $data = $DBM->displayPreviousPosts($info);
        }

        // Render the blog list area for this view.
        public function bloggerList(){
            echo "
                    <div id=\"bloggerlist\">
                    <h3> blogger list </h3>";

            //        echo"  in blofferlist";
                    $DBM = new DBManager();
                    $DBM->displayBloggerLinks();
            echo "</div>
            ";
        }

        // Render the page footer and close the document structure.
        function bottom(){
            echo "
            </div>

            </body>
            </html>
            ";
        }
    }

// Allows a guest to submit a post and displays previous posts with alternative comment handling.    
    // Legacy class name: View31.
    class GuestPostView extends PublicBaseView {
        // Initialize the view and render its complete page.
        public function __construct($info){
                $this->top();
                $this->menu();
            $this->bloggerList();
                $this->content($info);
                $this->bottom();
            }

        // Render the main content for this view.
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

                                $data = $DBM->displayPreviousPostsWithAlternativeComments($info);


                        echo "</FORM>



                    </div>
                        ";

            }


        // Render the blog list area for this view.
        public function bloggerList(){

                echo "
                    <div id=\"bloggerlist\">
                        <h3> blogger list </h3>";

            //        echo"  in blofferlist";
                    $DBM = new DBManager();
                    $DBM->displayAllBlogPosts();
                echo "</div>
                ";
            }

            // Render the page footer and close the document structure.
            public function bottom(){
                echo "
                </div>

                </body>
                </html>
                ";
            }
    }

// Displays an individual blog post, including its author, title and content.
// Legacy class name: ViewSinglePost.
    class SinglePostView extends PublicBaseView{
        // Initialize the view and render its complete page.
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

// Displays the registration form for creating a Blogger account and blog.
// Legacy class name: View4.
    class RegistrationView extends PublicBaseView{
        // Initialize the view and render its complete page.
        public function __construct()
        {
            $this->top();
            $this->menu();
            $this->content();
            $this->bottom();
        }

        // Render the main content for this view.
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
                            <input type="hidden" name="cmd" value="registerBlogger">

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

// Allows an authenticated user to create posts and view their previous posts.
// Legacy class name: View5.
    class CreatePostView extends AuthenticatedBaseView {
        // Initialize the view and render its complete page.
        public function __construct($info){
                $this->top();
                $this->menu();
                $this->content($info);
                $this->bloggerList();

                $this->bottom();


            }

        // Render the main content for this view.
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
            $DBM->displayPreviousPosts($info);
            echo "</div>";



            }





        // Render the blog list area for this view.
        public function bloggerList(){

                echo "
                    <div id=\"bloggerlist\">
                        <h3> blogger list </h3>";
                    $DBM = new DBManager();
                    $DBM->retrieveblogsanddisplay();
                echo "</div>
                ";



        }

            // Render the page footer and close the document structure.
            function bottom(){
                echo "
                </div>

                </body>
                </html>
                ";
            }
    }

// Provides an alternative post-creation view with previous-post functionality.
// Legacy class name: View51.
    class BlogPostManagementView extends AuthenticatedBaseView {
        // Initialize the view and render its complete page.
        public function __construct($info){
                $this->top();
                $this->menu();

                $this->content($info);
                $this->bloggerList();

                $this->bottom();


            }

        public function menu() {
            $username = $_COOKIE['username'] ?? 'Guest';

            echo '
            <nav id="admin-menu" class="admin-navigation" aria-label="Personal blog navigation">
                <span class="admin-menu-title">'
                    . ucfirst(htmlspecialchars($username, ENT_QUOTES, 'UTF-8')) . ': Personal Blogs
                </span>

                <div class="menu-account">
                    <a href="controller.php?cmd=logout">Log out</a>
                </div>
            </nav>';

            echo '
                <div id="menu"></div>
            ';
        }


        // Render the main content for this view.
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
            $DBM->displayPreviousPosts($info);
            echo "</div>";

        }

        // Render the blog list area for this view.
        public function bloggerList(){
                echo "
                    <div id=\"bloggerlist\">
                        <h3> blogger list </h3>";

                $DBM = new DBManager();
                $DBM->displayAllBlogPosts();
                echo "</div>
                ";
        }

        // Render the page footer and close the document structure.
        function bottom(){
            echo "
                </div>

                </body>
                </html>
                ";
        }
    }

// Allows an administrator to select and delete blog posts.
// Legacy class name: View6.
    class DeleteBlogPostsView extends AuthenticatedBaseView {
        // Initialize the view and render its complete page.
        public function __construct($info){
                $this->top();
                $this->menu();
            //    $this->bloggerList();


                $this->content($info);
                $this->bloggerList();

                $this->bottom();


            }

        // Render the main content for this view.
        public function content($info){

                echo "

        <div id=\"content\">
                    <h1> Delete Blogs -- click link to view contents </h1>
                    <FORM METHOD=\"post\" ACTION=\"controller.php\">
                        <input type=\"hidden\" name=\"cmd\" value=\"delete1\">
                        <input type=\"hidden\" name=\"id\" value=\"{$info['id']}\">
                        <input type=\"hidden\" name=\"blogtitle\" value=>";

            $DBM = new DBManager();
            $DBM->displayUserPostsForDeletion($info);

            if ($info['reset'] != 0)
            {
                $DBM = new DBManager();
                $DBM->displayPostBodyInTextarea($info);

            }
            echo"         <input type=\"submit\" value=\"Delete1\">

                        </FORM>
            ";

        //      $DBM->processComments();
            echo "</div>";



            }





        // Render the blog list area for this view.
        public function bloggerList(){

                echo "
                    <div id=\"bloggerlist\">
                        <h3> blogger list </h3>";

            //        echo"  in blofferlist";
                    $DBM = new DBManager();
                    $DBM->displayAllBlogPosts();
                echo "</div>
                ";



        }

            // Render the page footer and close the document structure.
            function bottom(){
                echo "
                </div>

                </body>
                </html>
                ";
            }
    }

// Provides shared navigation and layout functionality for administrator views.
    // class AdminBaseView extends AuthenticatedBaseView{

    //     // Render navigation links for administration pages.
    //     protected function adminMenu()
    //     {
    //         echo '
    //         <nav id="admin-menu" class="admin-navigation" aria-label="Administrator navigation">
    //             <span class="admin-menu-title">Administration:All blogs</span>

    //             <div class="menu-account">
    //                 <a href="controller.php?cmd=manageUsers">Users</a>
    //                 <a href="controller.php?cmd=manageBlogs">Personal Blogs</a>
    //                 <a href="controller.php?cmd=logout">Log out</a>
    //             </div>
    //         </nav>';
    //     }

    // }
    class AdminBaseView extends AuthenticatedBaseView {

    // Render navigation links for the selected administrator page.
        protected function adminMenu($section = 'blogs')
        {
            // if ($section === 'users') {
            //     $title = 'Administration: All Users';
            //     $links = '
            //         <a href="controller.php?cmd=manageBlogs">Admin: All Blogs</a>
            //         <a href="controller.php?cmd=manageBlogs">Personal Blogs</a>
            //         <a href="controller.php?cmd=logout">Log out</a>';
            // } else {
            //     $title = 'Administration: Personal Blogs';
            //     $links = '
            //         <a href="controller.php?cmd=manageUsers">Users</a>
            //         <a href="controller.php?cmd=adminDashboard">All Blogs</a>
            //         <a href="controller.php?cmd=logout">Log out</a>';
            // }
            if ($section === 'dashboard') {
                $title = 'Administration: All Blogs';
                $links = '
                    <a href="controller.php?cmd=manageUsers">Users</a>
                    <a href="controller.php?cmd=manageBlogs">Personal Blogs</a>
                    <a href="controller.php?cmd=logout">Log out</a>';
            } elseif ($section === 'users') {
                $title = 'Administration: All Users';
                $links = '
                    <a href="controller.php?cmd=adminDashboard">Admin: All Blogs</a>
                    <a href="controller.php?cmd=manageBlogs">Personal Blogs</a>
                    <a href="controller.php?cmd=logout">Log out</a>';
            } else {
                $title = 'Administration: Personal Blogs';
                $links = '
                    <a href="controller.php?cmd=manageUsers">Users</a>
                    <a href="controller.php?cmd=adminDashboard">All Blogs</a>
                    <a href="controller.php?cmd=logout">Log out</a>';
            }

            echo '
            <nav id="admin-menu" class="admin-navigation" aria-label="Administrator navigation">
                <span class="admin-menu-title">' . $title . '</span>
                <div class="menu-account">' . $links . '</div>
            </nav>';
        }
    }

// Displays the administration dashboard for managing blog posts and their comments.    
    class AdminDashboardView extends AdminBaseView{

        // Initialize the view and render its complete page.
        public function __construct($info){
            $DBM = new DBManager();

            // Default to the most recent post when none is selected.
            if (empty($info['bloggerid'])) {
                $info['bloggerid'] = $DBM->getLatestPostId();
            }

            $this->top('admin-dashboard');
          //  $this->adminMenu();
            $this->adminMenu('dashboard');
            $this->content($info);
            $this->postComments($info);
            // $this->recentPosts();
            $this->bottom();
        }
        
        // Left panel: Manage blog posts
        public function content($info){
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
            $DBM->displayAdminBlogPosts($info);
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


        // Right panel: Selected blog post and its comments
        public function postComments($info){
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

            $originator = htmlspecialchars(
                $post['username'] ?? 'Unknown',
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

                    <p class="post-meta">
                        By ' . $originator . '
                    </p>

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
                // Separate form for deleting comments.
                echo '
                    <form method="post" action="controller.php"
                        class="delete-comments-form">

                        <input type="hidden"
                            name="cmd"
                            value="deleteComments">

                        <input type="hidden"
                            name="bloggerid"
                            value="' . $postId . '">
                ';

                foreach ($comments as $comment) {
                    $commentId = (int) $comment['id'];

                    $author = htmlspecialchars(
                        $comment['author'] ?? 'Unknown',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $commentBody = htmlspecialchars(
                        $comment['body'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    echo '
                        <article class="blog-post comment-item">

                            <div class="comment-header">
                                <p class="post-meta">
                                    By ' . $author . '
                                </p>

                                <label class="delete-comment-choice">
                                    <input type="checkbox"
                                        name="deleteComments[]"
                                        value="' . $commentId . '">
                                    Delete this comment
                                </label>
                            </div>

                            <div class="post-excerpt">'
                                . nl2br($commentBody) .
                            '</div>

                        </article>
                    ';
                }

                echo '
                        <button type="submit">
                            Delete selected comments
                        </button>

                    </form>
                ';
            }

            echo '</section>';
        }

        // Right panel: Recent blog posts
        public function recentPosts(){
            echo '
                <section id="bloggerlist">
                    <div class="page-heading">

                    </div>
            ';

            $DBM = new DBManager();
            $DBM->displayAllBlogPosts();

            echo '
                </section>
            ';
        }

        // Render the page footer and close the document structure.
        public function bottom(){
            echo '
                </div>
                </body>
                </html>
            ';
        }
    }

// Allows posts to be created and previous posts to be displayed within the administration interface.
    // Legacy class name: AdminViewMessages.
    class AdminBlogManagementView extends AdminBaseView{
        // Initialize the view and render its complete page.
        public function __construct($info)
        {
            $this->top('admin-dashboard');
        //    $this->adminMenu();
            $this->adminMenu('blogs');
            $this->content($info);
            $this->bottom();
        }

        // Render the main content for this view.
        public function content($info)
        {
            echo '
            <h2>Manage Blogs</h2>

            <form method="post" action="controller.php">
                <input type="hidden" name="cmd" value="addPost">

                <label for="blogtitle">Post title</label>
                <input
                    type="text"
                    id="blogtitle"
                    name="blogtitle"
                    required
                >

                <label for="textarea">Post content</label>
                <textarea
                    id="textarea"
                    name="textarea"
                    required
                ></textarea>

                <input type="submit" value="Publish post">
            </form>

            <h3>Previous posts</h3>
            ';

            // Reuse the existing method used by BlogPostManagementView
            // (formerly View51).
            //DBManager::displayPreviousPosts($info);
            $DBM = new DBManager();
            $DBM->displayPreviousPosts($info);
        }
    }

// Allows an administrator to suspend, restore or delete user accounts.
    class AdminUsersView extends AdminBaseView{
        // Initialize the view and render its complete page.
        public function __construct($info)
        {
            $this->top('admin-dashboard');
         //   $this->adminMenu();
            $this->adminMenu('users');
            $this->content($info);
            $this->bottom();
        }

        // Render the main content for this view.
        public function content($info)
        {
            $DBM = new DBManager();

            echo '
            <div id="content">
                <h1>Manage Users</h1>

                <section class="admin-user-section">
                    <h2>Suspend or Restore Users</h2>

                    <form method="post" action="controller.php">
                        <input type="hidden" name="cmd" value="Suspend">
            ';

            $DBM->displayUsersForSuspension($info);

            if (!empty($info['reset2'])) {
                $DBM->displayUserDetails($info);
            }

            echo '
                        <button type="submit">Update user status</button>
                    </form>
                </section>

                <section class="admin-user-section">
                    <h2>Delete Users</h2>

                    <form method="post" action="controller.php">
                        <input type="hidden" name="cmd" value="deleteUser">
            ';

            $DBM->displayUsersForDeletion($info);

            if (!empty($info['reset1'])) {
                $DBM->displayUserDetails($info);
            }

            echo '
                        <button type="submit">Delete selected users</button>
                    </form>
                </section>
            </div>
            ';
        }
    }

// Allows an administrator to suspend or restore user accounts using the legacy interface.
    // Legacy class name: View8.
    class SuspendUsersView extends AuthenticatedBaseView {
        // Initialize the view and render its complete page.
        public function __construct($info){
                $this->top();
                $this->menu();
            //    $this->bloggerList();


                $this->content($info);
                $this->bloggerList();

                $this->bottom();


            }

        // Render the main content for this view.
        public function content($info){

                echo "

                <div id=\"content\">
                            <h1> Administrator -- Suspend Users </h1>
                            <FORM METHOD=\"post\" ACTION=\"controller.php\">
                                <input type=\"hidden\" name=\"cmd\" value=\"Suspend\">
                                <input type=\"hidden\" name=\"id\" value=>
                                <input type=\"hidden\" name=\"blogtitle\" value=>";


                        $DBM = new DBManager();
                        $DBM->displayUsersForSuspension($info);
                        if ($info['reset2'] != 0)
                        {
                        $DBM = new DBManager();
                        $DBM->displayUserDetails($info);

                        }


                        echo"     <input type=\"submit\" value=\"send data\">

                        </FORM>
                    ";

                echo "</div>";
            }

        // Render the blog list area for this view.
        public function bloggerList(){

                echo "
                    <div id=\"bloggerlist\">
                        <h3> blogger list </h3>";

                    $DBM = new DBManager();
                    $DBM->displayAllBlogPosts();
                echo "</div>
                ";
        }

            // Render the page footer and close the document structure.
            public function bottom(){
                echo "
                </div>

                </body>
                </html>
                ";
            }
    }

// Allows an administrator to delete user accounts using the legacy interface.
    // Legacy class name: View9.
    class DeleteUsersView extends AuthenticatedBaseView {
        // Initialize the view and render its complete page.
        public function __construct($info){
                $this->top();
                $this->menu();
                $this->content($info);
                $this->bloggerList();

                $this->bottom();


            }

        // Render the main content for this view.
        public function content($info){

                echo "

        <div id=\"content\">
                    <h1> Administrator  Delete Users</h1>
                    <FORM METHOD=\"post\" ACTION=\"controller.php\">
                        <input type=\"hidden\" name=\"cmd\" value=\"deleteUser\">
                        <input type=\"hidden\" name=\"id\" value=>
                        <input type=\"hidden\" name=\"blogtitle\" value=>";


                $DBM = new DBManager();
                $DBM->displayUsersForDeletion($info);

                if ($info['reset1'] != 0)
                {
                $DBM = new DBManager();
                $DBM->displayUserDetails($info);

                }

        echo "   <input type=\"submit\" value=\"delete users\">   </FORM>
            ";

            echo "</div>";

            }


        // Render the blog list area for this view.
        public function bloggerList(){

                echo "
                    <div id=\"bloggerlist\">
                        <h3> blogger list </h3>";

                    $DBM = new DBManager();
                    $DBM->displayAllBlogPosts();
                echo "</div>
                ";



        }

            // Render the page footer and close the document structure.
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

            // Connect to the Blogger database.
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


            // Validate login credentials and identify the account type.
            // Legacy function name: processLogin
            public function authenticateUser($username, $password){

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


            // Build the blog context for a username.
            // Legacy function name: getBlogindex
            public function getUserBlogDetails($username){

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
                        $data['username'] = $username;
                    }

                }
                $data['reset']= 1;
                return $data;
            }

            // Create a new blogger account and return its context.
            // Legacy function name: addBlogger
            public function registerBlogger(){

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


            // Create a blog post for an existing blogger.
            // Legacy function name: processBlog
            public function createBlogPost($info){
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

            // Create the first blog post for a blogger.
            // Legacy function name: processFirstBlog
            public function createInitialBlogPost(){
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

            // Find the newest blog post identifier.
            // Legacy function name: getMostRecentPostId
            public function getLatestPostId(){
                $query = $this->db->query(
                    'SELECT id FROM post ORDER BY id DESC LIMIT 1'
                );

                $postId = $query->fetchColumn();

                return $postId === false ? 0 : (int) $postId;
            }

            // Retrieve one blog post by its identifier.
            public function getPostById($postId){
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

            // Retrieve comments belonging to a blog post.
            public function getCommentsForPost($postId){
                $postId = (int) $postId;

                if ($postId <= 0) {
                    return [];
                }

                $query = $this->db->prepare(
                    'SELECT id, body, author
                    FROM comments
                    WHERE postid = :post_id
                    ORDER BY id ASC'
                );

                $query->execute(['post_id' => $postId]);

                return $query->fetchAll(PDO::FETCH_ASSOC);
            }

            // Render the public list of blog posts.
            // Legacy function name: retrieveallblogsanddisplay
            public function displayAllBlogPosts() {

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


            // Render blog posts for the public outer view.
            // Legacy function name: outerretrieveallblogsanddisplay
            public function displayBloggerLinks(){


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


            // Render posts belonging to a selected user.
            // Legacy function name: retrieveuserblogsanddisplay
            public function displayUserPostsForDeletion($info){

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


                    echo "<input type=\"radio\" name=\"$dummy1\" value=\"Y\" checked>";
                    echo "<input type=\"radio\"name=\"$dummy1\" value=\"N\">";
                    echo "<a href=\"controller.php?cmd=openblog&amp;bloggerid={$blogger['id']}\"> $dummy</a><br>";
                    }
                }
            }


            // Render a blogger post list for the guest posting view.
            // Legacy function name: retrieveallblogsanddisplay1
            public function displayPostsForDeletion($info){
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

            // Render previous posts for a selected blogger.
            // Legacy function name: displayPreviousBlogs
            public function displayPreviousPosts($info)
            {
                $this->renderPreviousPostsWithComments($info, 'addComment');
            }


            // Render previous posts for the guest posting view.
            // Legacy function name: displayPreviousBlogs1
            public function displayPreviousPostsWithAlternativeComments($info)
            {
                $this->renderPreviousPostsWithComments($info, 'addComment1');
            }


            // Render a reusable previous-post list.
            // Legacy function name: renderPreviousBlogs
            private function renderPreviousPostsWithComments($info, $command){
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


            // Render blog posts in the administration list.
            // Legacy function name: retrieveAdminBlogPosts
            public function displayAdminBlogPosts($info = []){
                $query = $this->db->query(
                    'SELECT post.id, post.title, post.body, user.username
                    FROM post
                    INNER JOIN user ON post.bloggerid = user.id
                    ORDER BY post.id DESC'
                );

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

                        $originator = htmlspecialchars(
                            $post['username'] ?? 'Unknown',
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

                                    <div class="delete-blog-originator">
                                        By ' . $originator . '
                                    </div>

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

            // Load and render the body of a selected post.
            // Legacy function name: retrievebody
            public function displayPostBodyInTextarea($data){
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

            // Read post details for display.
            // Legacy function name: getDetailsanddisplay
            public function buildPostBloggerDetails(){
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


            // Render users for administration.
            // Legacy function name: retrieveallusersdisplay
            public function displayUsersForDeletion($info){
                $user = array();

                $query = "SELECT * FROM user";
                $resultSet = $this->db->query($query);

                echo "Delete users <br>";
                echo "Y\tN <br>";

                for ($i = 0; $i < $resultSet->rowCount(); $i++) {

                    $user = $resultSet->fetch();

                    $userDisplay = "User #{$user['id']} — {$user['username']} — {$user['email']}";
                    $radioName = "b" . $i;

                    echo $radioName;
                    echo "<input type=\"radio\" name=\"$radioName\" value=\"Y\">";
                    echo "<input type=\"radio\" name=\"$radioName\" value=\"N\" checked>";
                    echo "<a href=\"controller.php?cmd=openblog4&amp;userid={$user['id']}\"> $userDisplay</a><br>";
                }
            }


            // Render users for suspension management.
            // Legacy function name: retrieveallusersdisplay1
            public function displayUsersForSuspension($info){


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

            // Load and render details for a selected user.
            // Legacy function name: retrieveuserdetails
            public function displayUserDetails($data){
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


            // Render the administration user list.
            // Legacy function name: displayUsers
            public function displayUserCheckboxes($info){

                $query = "select DISTINCT * from user";
                $resultSet = $this->db->query($query);
                for($i=0;$i<$resultSet->rowCount();$i++){
                    $user = $resultSet->fetch();

                echo "<input type=checkbox name={$user['username']} value={$user['username']}> {$user['username']}<br>";
                }
                return $resultSet;
            }

            // Delete the selected blog posts.
            // Legacy function name: deleteBloogs
            function deleteSelectedUserPosts(){
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

            // Delete selected comments from a blog post.
            // Legacy function name: deleteCommentsForPost
            public function deleteSelectedCommentsForPost($postId, $commentIds){
                $postId = (int) $postId;

                if ($postId <= 0 || !is_array($commentIds)) {
                    return 0;
                }

                $commentIds = array_values(array_unique(array_filter(
                    array_map('intval', $commentIds),
                    function ($id) {
                        return $id > 0;
                    }
                )));

                if (empty($commentIds)) {
                    return 0;
                }

                $placeholders = implode(
                    ',',
                    array_fill(0, count($commentIds), '?')
                );

                $sql = "DELETE FROM comments
                        WHERE postid = ?
                        AND id IN ($placeholders)";

                $statement = $this->db->prepare($sql);
                $statement->execute(
                    array_merge([$postId], $commentIds)
                );

                return $statement->rowCount();
            }


            // Delete blog posts selected in the administration form.
            // Legacy function name: deleteBloogs1
            public function deleteSelectedPosts(){
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

            // Delete the selected users.
            // Legacy function name: deleteUsers
            function deleteSelectedUsers(){

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


                // Update user suspension selections.
            // Legacy function name: SuspendUsers

            function updateUserSuspensionStatus (){

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
