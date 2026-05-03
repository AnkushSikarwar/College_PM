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

<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Welcome to EduCollege</h1>
        <p class="lead mb-5 fs-4 animate__animated animate__fadeInUp">Empowering minds, shaping futures. Discover a world of opportunities.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="courses.php" class="btn btn-primary btn-lg rounded-pill px-5">Explore Courses</a>
            <a href="admission.php" class="btn btn-outline-light btn-lg rounded-pill px-5">Apply Now</a>
        </div>
    </div>
</section>

<!-- Auto-scrolling Notices -->
<div class="container">
    <div class="notice-marquee">
        <span>
            <strong><i class="fas fa-bullhorn text-danger me-2"></i> Latest Updates:</strong>
            <?php if(count($notices) > 0): ?>
                <?php foreach($notices as $notice): ?>
                    <span class="mx-4">&bull; <?php echo htmlspecialchars($notice['title']); ?> (<?php echo date('M d, Y', strtotime($notice['date'])); ?>)</span>
                <?php endforeach; ?>
            <?php else: ?>
                <span class="mx-4">No new notices at this time.</span>
            <?php endif; ?>
        </span>
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

<?php include 'includes/footer.php'; ?>
