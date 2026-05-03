<?php
require_once 'includes/db.php';

// Fetch active notices
$stmt = $pdo->query("SELECT * FROM notices WHERE is_active = 1 ORDER BY date DESC LIMIT 5");
$notices = $stmt->fetchAll();

// Fetch featured courses (limit 3)
$stmt_courses = $pdo->query("SELECT * FROM courses ORDER BY id DESC LIMIT 3");
$courses = $stmt_courses->fetchAll();

include 'includes/header.php';
?>

<!-- Hero Carousel -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active hero-slide" style="background-image: linear-gradient(rgba(30, 41, 59, 0.7), rgba(30, 41, 59, 0.7)), url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
            <div class="carousel-caption d-flex flex-column h-100 justify-content-center align-items-center">
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Welcome to EduCollege</h1>
                <p class="lead mb-5 fs-4 animate__animated animate__fadeInUp">Empowering minds, shaping futures. Discover a world of opportunities.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="courses.php" class="btn btn-primary btn-lg rounded-pill px-5">Explore Courses</a>
                    <a href="admission.php" class="btn btn-outline-light btn-lg rounded-pill px-5">Apply Now</a>
                </div>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="carousel-item hero-slide" style="background-image: linear-gradient(rgba(30, 41, 59, 0.7), rgba(30, 41, 59, 0.7)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
            <div class="carousel-caption d-flex flex-column h-100 justify-content-center align-items-center">
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">World-Class Facilities</h1>
                <p class="lead mb-5 fs-4 animate__animated animate__fadeInUp">Experience learning with state-of-the-art labs, libraries, and smart classrooms.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="gallery.php" class="btn btn-primary btn-lg rounded-pill px-5">View Gallery</a>
                </div>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="carousel-item hero-slide" style="background-image: linear-gradient(rgba(30, 41, 59, 0.7), rgba(30, 41, 59, 0.7)), url('https://images.unsplash.com/photo-1511629091441-ee46146481b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
            <div class="carousel-caption d-flex flex-column h-100 justify-content-center align-items-center">
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Vibrant Campus Life</h1>
                <p class="lead mb-5 fs-4 animate__animated animate__fadeInUp">Join clubs, participate in sports, and build lifelong friendships.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="about.php" class="btn btn-outline-light btn-lg rounded-pill px-5">About Us</a>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Auto-scrolling Notices -->
<div class="container notice-section">
    <div class="d-flex align-items-center notice-container bg-white shadow-sm rounded overflow-hidden">
        <div class="notice-label bg-primary text-white px-4 py-3 fw-bold d-flex align-items-center z-2 position-relative">
            <i class="fas fa-bullhorn me-2"></i> Latest Updates
        </div>
        <div class="notice-marquee-wrapper flex-grow-1 overflow-hidden position-relative z-1">
            <div class="notice-marquee-content py-3">
                <?php if(count($notices) > 0): ?>
                    <?php foreach($notices as $notice): ?>
                        <span class="mx-4 text-dark fw-medium">&bull; <?php echo htmlspecialchars($notice['title']); ?> <small class="text-muted">(<?php echo date('M d, Y', strtotime($notice['date'])); ?>)</small></span>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="mx-4 text-dark fw-medium">No new notices at this time.</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Highlights / Quick Links -->
<section class="py-5 mt-4">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="p-4 bg-white rounded shadow-sm h-100 border-bottom border-primary border-3">
                    <i class="fas fa-book-open fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Programs</h5>
                    <p class="text-muted small">Wide range of undergraduate and graduate programs.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded shadow-sm h-100 border-bottom border-primary border-3">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Expert Faculty</h5>
                    <p class="text-muted small">Learn from industry experts and experienced professors.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded shadow-sm h-100 border-bottom border-primary border-3">
                    <i class="fas fa-globe fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Global Network</h5>
                    <p class="text-muted small">Connect with alumni and partners worldwide.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded shadow-sm h-100 border-bottom border-primary border-3">
                    <i class="fas fa-medal fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Top Rankings</h5>
                    <p class="text-muted small">Consistently ranked among the top educational institutions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Our Featured Courses</h2>
            <div class="mx-auto bg-primary mt-2" style="height: 4px; width: 60px; border-radius: 2px;"></div>
        </div>
        <div class="row g-4">
            <?php foreach($courses as $course): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="assets/images/<?php echo htmlspecialchars($course['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($course['title']); ?>" onerror="this.src='https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo htmlspecialchars($course['title']); ?></h5>
                        <p class="card-text text-muted small"><?php echo htmlspecialchars(substr($course['description'], 0, 100)) . '...'; ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-light text-dark border"><i class="far fa-clock me-1"></i><?php echo htmlspecialchars($course['duration']); ?></span>
                            <a href="course-detail.php?id=<?php echo $course['id']; ?>" class="btn btn-sm btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <a href="courses.php" class="btn btn-primary px-4 py-2 rounded-pill">View All Courses <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Students studying" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-6 px-lg-5">
                <h2 class="fw-bold text-dark mb-4">Why Choose EduCollege?</h2>
                <p class="text-muted mb-4">We provide a supportive and inclusive environment where students from diverse backgrounds can thrive. Our curriculum is designed to meet the demands of the modern workforce.</p>
                <ul class="list-unstyled mb-4">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-primary mt-1 me-3 fs-5"></i>
                        <div>
                            <strong class="d-block text-dark">Industry-Aligned Curriculum</strong>
                            <span class="text-muted small">Our courses are regularly updated to match industry standards.</span>
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-primary mt-1 me-3 fs-5"></i>
                        <div>
                            <strong class="d-block text-dark">Exceptional Placement Record</strong>
                            <span class="text-muted small">Over 95% of our graduates find employment within 6 months.</span>
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-primary mt-1 me-3 fs-5"></i>
                        <div>
                            <strong class="d-block text-dark">Global Alumni Network</strong>
                            <span class="text-muted small">Connect with successful professionals across the globe.</span>
                        </div>
                    </li>
                </ul>
                <a href="about.php" class="btn btn-outline-primary px-4 rounded-pill">Learn More About Us</a>
            </div>
        </div>
    </div>
</section>

<!-- Quick Inquiry Form -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 bg-primary text-white p-5 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold mb-3">Have Questions?</h3>
                            <p class="mb-4">Drop us a message and our admission team will get back to you shortly.</p>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-phone-alt me-3 fs-4"></i>
                                <span>+1 234 567 890</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope me-3 fs-4"></i>
                                <span>admission@college.edu</span>
                            </div>
                        </div>
                        <div class="col-md-7 p-5">
                            <h4 class="fw-bold text-dark mb-4">Quick Inquiry</h4>
                            <form action="contact.php" method="POST">
                                <div class="mb-3">
                                    <input type="text" name="name" class="form-control bg-light" placeholder="Your Name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control bg-light" placeholder="Your Email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="tel" name="phone" class="form-control bg-light" placeholder="Your Phone Number">
                                </div>
                                <div class="mb-4">
                                    <textarea name="message" class="form-control bg-light" rows="3" placeholder="How can we help?" required></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary w-100 rounded-pill fw-bold">Send Inquiry <i class="fas fa-paper-plane ms-2"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
