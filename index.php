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
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
            aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active hero-slide"
            style="background-image: linear-gradient(rgba(30, 41, 59, 0.7), rgba(30, 41, 59, 0.7)), url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
            <div class="carousel-caption d-flex flex-column h-100 justify-content-center align-items-center">
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Welcome to EduCollege</h1>
                <p class="lead mb-5 fs-4 animate__animated animate__fadeInUp">Empowering minds, shaping futures.
                    Discover a world of opportunities.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="courses.php" class="btn btn-primary btn-lg rounded-pill px-5">Explore Courses</a>
                    <a href="admission.php" class="btn btn-outline-light btn-lg rounded-pill px-5">Apply Now</a>
                </div>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="carousel-item hero-slide"
            style="background-image: linear-gradient(rgba(30, 41, 59, 0.7), rgba(30, 41, 59, 0.7)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
            <div class="carousel-caption d-flex flex-column h-100 justify-content-center align-items-center">
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">World-Class Facilities</h1>
                <p class="lead mb-5 fs-4 animate__animated animate__fadeInUp">Experience learning with state-of-the-art
                    labs, libraries, and smart classrooms.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="gallery.php" class="btn btn-primary btn-lg rounded-pill px-5">View Gallery</a>
                </div>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="carousel-item hero-slide"
            style="background-image: linear-gradient(rgba(30, 41, 59, 0.7), rgba(30, 41, 59, 0.7)), url('https://images.unsplash.com/photo-1511629091441-ee46146481b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
            <div class="carousel-caption d-flex flex-column h-100 justify-content-center align-items-center">
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Vibrant Campus Life</h1>
                <p class="lead mb-5 fs-4 animate__animated animate__fadeInUp">Join clubs, participate in sports, and
                    build lifelong friendships.</p>
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
        <div
            class="notice-label bg-primary text-white px-4 py-3 fw-bold d-flex align-items-center z-2 position-relative">
            <i class="fas fa-bullhorn me-2"></i> Latest Updates
        </div>
        <div class="notice-marquee-wrapper flex-grow-1 overflow-hidden position-relative z-1">
            <div class="notice-marquee-content py-3">
                <?php if (count($notices) > 0): ?>
                    <?php foreach ($notices as $notice): ?>
                        <span class="mx-4 text-dark fw-medium">&bull; <?php echo htmlspecialchars($notice['title']); ?> <small
                                class="text-muted">(<?php echo date('M d, Y', strtotime($notice['date'])); ?>)</small></span>
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
            <?php if (count($courses) > 0): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="assets/images/<?php echo htmlspecialchars($course['image']); ?>" class="card-img-top"
                                alt="<?php echo htmlspecialchars($course['title']); ?>"
                                onerror="this.src='https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($course['title']); ?></h5>
                                <p class="card-text text-muted small">
                                    <?php echo htmlspecialchars(substr($course['description'], 0, 100)) . '...'; ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="badge bg-light text-dark border"><i
                                            class="far fa-clock me-1"></i><?php echo htmlspecialchars($course['duration']); ?></span>
                                    <a href="course-detail.php?id=<?php echo $course['id']; ?>"
                                        class="btn btn-sm btn-outline-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Placeholder Courses if DB is empty -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            class="card-img-top" alt="Computer Science">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">B.Sc. Computer Science</h5>
                            <p class="card-text text-muted small">Learn programming, data structures, and software
                                engineering from industry experts.</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-light text-dark border"><i class="far fa-clock me-1"></i>4
                                    Years</span>
                                <a href="courses.php" class="btn btn-sm btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            class="card-img-top" alt="Business Administration">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Business Administration</h5>
                            <p class="card-text text-muted small">Master the fundamentals of business, finance, and
                                management in our comprehensive BBA program.</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-light text-dark border"><i class="far fa-clock me-1"></i>3
                                    Years</span>
                                <a href="courses.php" class="btn btn-sm btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            class="card-img-top" alt="Data Science">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">M.Sc. Data Science</h5>
                            <p class="card-text text-muted small">Dive deep into machine learning, big data analytics, and
                                artificial intelligence.</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-light text-dark border"><i class="far fa-clock me-1"></i>2
                                    Years</span>
                                <a href="courses.php" class="btn btn-sm btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5">
            <a href="courses.php" class="btn btn-primary px-4 py-2 rounded-pill">View All Courses <i
                    class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Students studying" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-6 px-lg-5">
                <h2 class="fw-bold text-dark mb-4">Why Choose EduCollege?</h2>
                <p class="text-muted mb-4">We provide a supportive and inclusive environment where students from diverse
                    backgrounds can thrive. Our curriculum is designed to meet the demands of the modern workforce.</p>
                <ul class="list-unstyled mb-4">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-primary mt-1 me-3 fs-5"></i>
                        <div>
                            <strong class="d-block text-dark">Industry-Aligned Curriculum</strong>
                            <span class="text-muted small">Our courses are regularly updated to match industry
                                standards.</span>
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-primary mt-1 me-3 fs-5"></i>
                        <div>
                            <strong class="d-block text-dark">Exceptional Placement Record</strong>
                            <span class="text-muted small">Over 95% of our graduates find employment within 6
                                months.</span>
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-primary mt-1 me-3 fs-5"></i>
                        <div>
                            <strong class="d-block text-dark">Global Alumni Network</strong>
                            <span class="text-muted small">Connect with successful professionals across the
                                globe.</span>
                        </div>
                    </li>
                </ul>
                <a href="about.php" class="btn btn-outline-primary px-4 rounded-pill">Learn More About Us</a>
            </div>
        </div>
    </div>
</section>

<!-- Quick Inquiry Form -->
<section class="py-5 position-relative"
    style="background: linear-gradient(rgba(249, 250, 246, 0.85), rgba(121, 121, 122, 0.9)), url('https://images.unsplash.com/photo-1523580494112-071d16940d14?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover fixed;">
    <div class="container position-relative z-1 py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 text-dark pe-lg-5">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 fs-6">Get in Touch</span>
                <h2 class="display-5 fw-bold mb-4">Ready to Take the Next Step?</h2>
                <p class="lead text-muted mb-5">Whether you have questions about our programs, the admission process, or
                    campus life, our dedicated team is here to guide you every step of the way.</p>

                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-4 d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 60px; height: 60px;">
                        <i class="fas fa-phone-alt fa-lg text-primary"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Call Us Directly</h5>
                        <p class="text-muted mb-0">+1 234 567 890</p>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-4 d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 60px; height: 60px;">
                        <i class="fas fa-envelope fa-lg text-primary"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Email Our Office</h5>
                        <p class="text-muted mb-0">admission@college.edu</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 rounded-4 shadow-lg"
                    style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                    <div class="card-body p-5">
                        <h3 class="fw-bold text-dark mb-1">Quick Inquiry</h3>
                        <p class="text-muted mb-4 small">Fill out the form below and we will contact you shortly.</p>

                        <form action="contact.php" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-dark">First Name</label>
                                    <input type="text" name="name"
                                        class="form-control form-control-lg bg-light border-0" placeholder="John"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-dark">Last Name</label>
                                    <input type="text" name="last_name"
                                        class="form-control form-control-lg bg-light border-0" placeholder="Doe">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small text-dark">Email Address</label>
                                    <input type="email" name="email"
                                        class="form-control form-control-lg bg-light border-0"
                                        placeholder="john@example.com" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small text-dark">Phone Number</label>
                                    <input type="tel" name="phone"
                                        class="form-control form-control-lg bg-light border-0"
                                        placeholder="+1 (555) 000-0000">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold small text-dark">Your Message</label>
                                    <textarea name="message" class="form-control form-control-lg bg-light border-0"
                                        rows="4" placeholder="How can we help you?" required></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow-sm">Send Message
                                        <i class="fas fa-paper-plane ms-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>