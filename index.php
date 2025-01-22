<?php

require_once 'classes/CourseManagement.php';
$courseManagement = new CourseManagement();
$courses = $courseManagement->getAllCourses();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 
    - primary meta tags
  -->
    <title>Youdemi</title>
    <meta name="title" content="Youdemi">
    <meta name="description" content="This is a education html template made by codewithsadee">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- 
    - custom font link
  -->
    <link rel="stylesheet" href="./assets/font/font.css">

    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- 
    - preload images
  -->
    <link rel="preload" as="image" href="./assets/images/hero-banner.png">
    <link rel="preload" as="image" href="./assets/images/hero-bg.png">

</head>

<body>

    <!-- 
    - PRELOADER
  -->

    <div class="preloader" data-preloader>
        <div class="circle" data-circle></div>
    </div>





    <!-- 
    - #HEADER
  -->

    <header class="header " data-header>
        <div class="container">

            <a href="#" class="logo">
                <img src="./assets/images/logo.svg" width="145" height="27" alt="Youdemi home">
            </a>

            <nav class="navbar" data-navbar>

                <div class="navbar-top">
                    <a href="#" class="logo">
                        <img src="./assets/images/logo.svg" width="145" height="27" alt="Youdemi home">
                    </a>

                    <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
                        <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                    </button>
                </div>

                <ul class="navbar-list">

                    <li class="navbar-item">
                        <a href="#" class="navbar-link title-sm" data-nav-link>Home</a>
                    </li>

                    <li class="navbar-item">
                        <a href="#" class="navbar-link title-sm" data-nav-link>Courses</a>
                    </li>

                    <li class="navbar-item">
                        <a href="#" class="navbar-link title-sm" data-nav-link>Blog</a>
                    </li>

                    <li class="navbar-item">
                        <a href="#" class="navbar-link title-sm" data-nav-link>Contacts</a>
                    </li>

                </ul>

            </nav>

            <a href="auth/login.php" class="btn btn-secondary">Se connecter</a>
            <a href="auth/register.php" class="btn btn-secondary">Créer un nouveau compte</a>

            <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
                <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
            </button>

            <div class="overlay" data-overlay data-nav-toggler></div>

        </div>
    </header>





    <main>
        <article>

            <!-- 
        - #HERO
      -->

            <section class="section hero has-bg-image" aria-labelledby="hero-label"
                style="background-image: url('./assets/images/hero-bg.png')">
                <div class="container">

                    <div class="hero-content">

                        <h1 class="headline-lg" id="hero-label">
                            Better <span class="span">Learning Future</span> Starts With Youdemi
                        </h1>

                        <p class="title-md has-before">
                            It is long established fact that reader distracted by the readable content.
                        </p>

                        <div class="btn-group">
                            <a href="/login" class="btn btn-primary">Se connecter</a>

                            <a href="/register" class="btn btn-secondary">Créer un nouveau compte</a>
                        </div>

                    </div>

                    <figure class="hero-banner">
                        <!-- <img src="./assets/images/hero-banner.png" width="590" height="620" alt="hero banner" class="w-100"> -->
                        <img src="https://static.medias24.com/content/uploads/2019/11/IMG-20191127-WA00071.jpg?x42630" width="590" height="620" alt="hero banner" class="w-100">
                    </figure>

                </div>
            </section>





            <!-- 
        - #CATEGORY
      -->

            <!-- <section class="section category has-bg-image" aria-labelledby="category-label"
        style="background-image: url('./assets/images/category-bg.png')">
        <div class="container">

          <p class="title-sm text-center section-subtitle" id="category-label">Course Categories</p>

          <h2 class="headline-md text-center section-title">
            Browse Top <span class="span has-after">Categories</span>
          </h2>

          <ul class="grid-list">

            <li>
              <div class="card category-card">

                <div class="card-icon">
                  <img src="./assets/images/category-1.svg" width="72" height="72" loading="lazy"
                    alt="Data Science icon">
                </div>

                <div>
                  <h3 class="title-lg">Data Science</h3>

                  <p class="title-sm">68 Courses</p>
                </div>

                <a href="#" class="layer-link" aria-label="Data Science Category"></a>

              </div>
            </li>

            <li>
              <div class="card category-card">

                <div class="card-icon">
                  <img src="./assets/images/category-2.svg" width="72" height="72" loading="lazy"
                    alt="UI/UX Design icon">
                </div>

                <div>
                  <h3 class="title-lg">UI/UX Design</h3>

                  <p class="title-sm">68 Courses</p>
                </div>

                <a href="#" class="layer-link" aria-label="UI/UX Design Category"></a>

              </div>
            </li>

            <li>
              <div class="card category-card">

                <div class="card-icon">
                  <img src="./assets/images/category-3.svg" width="72" height="72" loading="lazy"
                    alt="Modern Physics icon">
                </div>

                <div>
                  <h3 class="title-lg">Modern Physics</h3>

                  <p class="title-sm">68 Courses</p>
                </div>

                <a href="#" class="layer-link" aria-label="Modern Physics Category"></a>

              </div>
            </li>

            <li>
              <div class="card category-card">

                <div class="card-icon">
                  <img src="./assets/images/category-4.svg" width="72" height="72" loading="lazy"
                    alt="Music Production icon">
                </div>

                <div>
                  <h3 class="title-lg">Music Production</h3>

                  <p class="title-sm">68 Courses</p>
                </div>

                <a href="#" class="layer-link" aria-label="Music Production Category"></a>

              </div>
            </li>

            <li>
              <div class="card category-card">

                <div class="card-icon">
                  <img src="./assets/images/category-5.svg" width="72" height="72" loading="lazy"
                    alt="Data Science icon">
                </div>

                <div>
                  <h3 class="title-lg">Data Science</h3>

                  <p class="title-sm">68 Courses</p>
                </div>

                <a href="#" class="layer-link" aria-label="Data Science Category"></a>

              </div>
            </li>

            <li>
              <div class="card category-card">

                <div class="card-icon">
                  <img src="./assets/images/category-6.svg" width="72" height="72" loading="lazy" alt="Finances icon">
                </div>

                <div>
                  <h3 class="title-lg">Finances</h3>

                  <p class="title-sm">68 Courses</p>
                </div>

                <a href="#" class="layer-link" aria-label="Finances Category"></a>

              </div>
            </li>

          </ul>

          <a href="#" class="btn btn-primary">View All Categories</a>

        </div>
      </section> -->





            <!-- 
        - #ABOUT
      -->

            <!-- <section class="section about" aria-labelledby="about-label">
        <div class="container">

          <figure class="about-banner">
            <img src="./assets/images/about-banner.png" width="775" height="685" loading="lazy" alt="about banner"
              class="w-100">
          </figure>

          <div class="about-content">

            <p class="title-sm section-subtitle" id="about-label">About Youdemi</p>

            <h2 class="headline-md section-title">
              We Provide The Best Online <span class="span has-after">Education</span>
            </h2>

            <p class="title-sm section-text">
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour.
            </p>

            <ul class="progress-list">

              <li>
                <div class="progress-label-wrapper">
                  <p class="title-sm">Business Studies</p>

                  <p class="title-sm">86%</p>
                </div>

                <div class="progress">
                  <div class="progress-fill red"></div>
                </div>
              </li>

              <li>
                <div class="progress-label-wrapper">
                  <p class="title-sm">Marketing</p>

                  <p class="title-sm">67%</p>
                </div>

                <div class="progress">
                  <div class="progress-fill green"></div>
                </div>
              </li>

              <li>
                <div class="progress-label-wrapper">
                  <p class="title-sm">Design & Development</p>

                  <p class="title-sm">95%</p>
                </div>

                <div class="progress">
                  <div class="progress-fill yellow"></div>
                </div>
              </li>

            </ul>

          </div>

        </div>
      </section> -->





            <!-- 
        - #COURSE
      -->

            <section class="section course" aria-labelledby="course-label">
                <div class="container">
                    <h2 class="headline-md section-title text-center">
                        Découvrez nos <span class="span has-after">Cours</span>
                    </h2>

                    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($courses as $course): 
        $tags = $courseManagement->getCourseTags($course['id']);
    ?>
        <li class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <!-- Course Image -->
            <figure class="relative">
                <?php if ($course['photo_cover']): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($course['photo_cover']) ?>" 
                         alt="<?php echo htmlspecialchars($course['title']) ?>" 
                         class="w-full h-48 object-cover rounded-t-lg">
                <?php endif; ?>

                <!-- Category Badge -->
                <?php if ($course['category_name']): ?>
                    <div class="absolute top-4 left-4 bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                        <?php echo htmlspecialchars($course['category_name']) ?>
                    </div>
                <?php endif; ?>
            </figure>

            <!-- Card Content -->
            <div class="p-6">
                <!-- Tags -->
                <?php if (!empty($tags)): ?>
                    <div class="flex flex-wrap gap-2 mb-3">
                        <?php foreach ($tags as $tag): ?>
                            <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                <?php echo htmlspecialchars($tag['name']) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Course Title -->
                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    <?php echo htmlspecialchars($course['title']) ?>
                </h3>

                <!-- Teacher Name -->
                <div class="flex items-center text-gray-600 text-sm mb-3">
                    <i class="fas fa-user-tie mr-2"></i>
                    <span><?php echo htmlspecialchars($course['teacher_name'] ?? 'Professeur') ?></span>
                </div>

                <!-- Course Description -->
                <p class="text-gray-700 text-sm mb-4 line-clamp-2">
                    <?php echo htmlspecialchars($course['description']) ?>
                </p>

                <!-- Course Stats -->
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center text-yellow-400">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                        <span class="text-gray-600 text-xs ml-2">(5.0)</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm">
                        <i class="fas fa-users mr-1"></i>
                        <span>0 étudiants</span>
                    </div>
                </div>

                <!-- Action Button -->
                <a href="auth/login.php" 
                   class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold text-sm py-2 rounded-lg transition-colors">
                    S'inscrire au cours
                </a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

                </div>
            </section>





            <!-- 
        - #CTA
      -->

            <!-- <section class="cta" aria-labelledby="cta-label">
        <div class="container">

          <h2 class="headline-md section-title" id="cta-label">
            Education Is About Creating Leaders For Tomorrow
          </h2>

          <a href="#" class="btn btn-tertiary">Register Today</a>

        </div>
      </section> -->

        </article>
    </main>





    <!-- 
    - #FOOTER
  -->

    <!-- <footer class="footer has-bg-image" style="background-image: url('./assets/images/footer-bg.png')">

    <div class="section footer-top">
      <div class="container">

        <div class="footer-brand">

          <a href="#" class="logo">
            <img src="./assets/images/logo-footer.svg" width="145" height="27" alt="Youdemi home">
          </a>

          <p class="title-sm footer-text">
            Lorem ipsum amet, consectetur adipiscing elit. Suspendis varius enim eros elementum tristique. Duis cursus.
          </p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <img src="./assets/images/facebook.svg" width="40" height="40" loading="lazy" alt="facebook">
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <img src="./assets/images/twitter.svg" width="40" height="40" loading="lazy" alt="twitter">
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <img src="./assets/images/pinterest.svg" width="40" height="40" loading="lazy" alt="pinterest">
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <img src="./assets/images/instagram.svg" width="40" height="40" loading="lazy" alt="instagram">
              </a>
            </li>

          </ul>

        </div>

        <ul class="footer-list">

          <li>
            <p class="headline-sm footer-list-title">Links</p>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">Home</a>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">About Us</a>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">Pricing</a>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">Courses</a>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">Contact Us</a>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">Blog</a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <p class="headline-sm footer-list-title">Legal</p>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">Legal</a>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">Tearms of Use</a>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">Tearm & Condition</a>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">Payment Method</a>
          </li>

          <li>
            <a href="#" class="title-sm footer-link">Privacy Policy</a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>

            <p class="headline-sm footer-list-title">Instagram Post</p>

            <ul class="grid-list">

              <li>
                <img src="./assets/images/ins-1.png" width="80" height="80" loading="lazy" alt="instagram post"
                  class="img-cover">
              </li>

              <li>
                <img src="./assets/images/ins-2.png" width="80" height="80" loading="lazy" alt="instagram post"
                  class="img-cover">
              </li>

              <li>
                <img src="./assets/images/ins-3.png" width="80" height="80" loading="lazy" alt="instagram post"
                  class="img-cover">
              </li>

              <li>
                <img src="./assets/images/ins-4.png" width="80" height="80" loading="lazy" alt="instagram post"
                  class="img-cover">
              </li>

              <li>
                <img src="./assets/images/ins-5.png" width="80" height="80" loading="lazy" alt="instagram post"
                  class="img-cover">
              </li>

              <li>
                <img src="./assets/images/ins-6.png" width="80" height="80" loading="lazy" alt="instagram post"
                  class="img-cover">
              </li>

            </ul>

          </li>

        </ul>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          © Copyright 2022 | Youdemi Template | All Rights Reserved by codewithsadee
        </p>

      </div>
    </div>

  </footer>
 -->




    <!-- 
   - custom js link
  -->
    <script src="./assets/js/script.js"></script>

    <!-- 
    - ionicon
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>