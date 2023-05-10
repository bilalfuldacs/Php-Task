<html>
  <head>
    <title>Page Title</title>
       <link rel="stylesheet" href="../Styles/style.css">
    </style>
  </head>
  <body>
    <img class="logo" src="../images/logo.svg" alt="Logo">
    <!-- Your other HTML content here -->
  </body>
</html>
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the home page
    header('Location:../index.php');
    exit;
}
if(isset($_SESSION['news']) && $_SESSION['news'] > 0) {
    $news = $_SESSION['news'];
    echo "<div class='main'>";
    if(isset($_SESSION['empty'])){
    echo '<div class="error-box"><h2>'.$_SESSION['empty']."</h2></div>";
         unset($_SESSION['empty']);
    }
    if(isset($_SESSION['news_delete'])){
        echo '<div class="error-box"><h2>'.$_SESSION['news_delete']."</h2></div>";
        unset($_SESSION['news_delete']);
    }
    if(isset($_SESSION['news_create'])){
    echo '<div class="error-box"><h2>'.$_SESSION['news_create'].'</h2></div>';
           unset($_SESSION['news_create']);
    }
    if(isset($_SESSION['news_update'])){
       echo '<div class="error-box"><h2>'.$_SESSION['news_update'].'</h2></div>';
      unset($_SESSION['news_update']);
    }
    if(!empty($news)){
    foreach($news as $article){
        echo '<ul class="news-list">';
echo "<h3> All News </h3>";
     echo '<li class="news-article">';
echo '<div class="news-content">';
echo '<p class="news-title"><strong>' . $article['title'] . '</strong>' . '<span style="margin-left: 50px;"></span>' . $article['description'] . '</p>';
echo '</div>';
echo '<div class="news-actions">';
echo '<button type="button" class="edit-btn" onclick="editNews('.$article['id'].')" style="background-color: transparent; border: none;">✏️</button>';
echo '<form action="../Includes/News.php" method="POST">';
echo '<input type="hidden" name="news_id" value="'.$article['id'].'">';
echo '<button type="submit" name="delete_news" style="background-color: transparent; border: none;">&#10006</button>';
echo '</form>';
echo '</div>';
echo '</li>';
    }
    echo '</ul>';
    echo '</div>';
}
 
echo '</ul>';


}

echo '</div>';
?>
<br><div class="main">
 <h3 id="create_news_heading" value="create news">Create news</h3>
</div>
    <div class="container">
 <form id="news-form" method="POST" action="../Includes/News.php">

    <input type="text" id="title" placeholder="title" name="title"><br>
   
    <textarea id="description" placeholder="description" name="description"></textarea><br><br>
    <input type="hidden" id="news-id" name="news_id" value="">
    <input type="submit"class="button" id="create-news-btn" name="create_news" value="Create">
    <button type="submit"class="button" id="save-news-btn" name="update_news" style="display: none;">Save</button>
  </form>
  <form action="../Includes/logout.php">
      <button class="button" type="submit" >Log out</button>

  </form>
</div>


<script>function editNews(newsId) {
  // search id of news
  const news = <?= json_encode($news) ?>;
  const article = news.find(article => article.id === newsId);

  // Find the create news heading and update its text
  const createNewsHeading = document.getElementById('create_news_heading');
  createNewsHeading.textContent = 'Edit News';

  // Fill the article data properly
  document.getElementById('title').value = article.title;
  document.getElementById('description').value = article.description;
  document.getElementById('news-id').value = article.id;

  // changing create button to save 
  const createBtn = document.getElementById('create-news-btn');
  createBtn.style.display = 'none';
  const saveBtn = document.getElementById('save-news-btn');
  saveBtn.style.display = 'inline-block';
  saveBtn.method = 'POST';
  saveBtn.value = 'Save'; // Change the value attribute

  // Check if the create news heading already has a cross sign
  let crossSign = createNewsHeading.nextSibling;
  if (crossSign && crossSign.tagName === 'SPAN') {
    // If it does, remove it
    crossSign.remove();
  }

  // Add a cross sign
  crossSign = document.createElement('span');
  crossSign.innerHTML = '&#x2716;'; // Unicode character for cross
  crossSign.style.color = 'red';
  crossSign.style.cursor = 'pointer';
  crossSign.style.float = 'right';
  createNewsHeading.parentNode.insertBefore(crossSign, createNewsHeading);

  // Change the button text
  saveBtn.textContent = 'Save';

  // Set the form action to the news update script
  document.getElementById('news-form').action = '../Includes/News.php';

  // Add event listener to the cross sign to reset the form
  crossSign.addEventListener('click', (event) => {
    event.preventDefault();

    // Find the create news heading and update its text
    const createNewsHeading = document.getElementById('create_news_heading');
    createNewsHeading.textContent = 'Create News';

    // Reset the form
    document.getElementById('news-form').reset();
    createBtn.style.display = 'inline-block';
    saveBtn.style.display = 'none';

    // Remove the cross sign
    crossSign.remove();
  });
}



</script>
