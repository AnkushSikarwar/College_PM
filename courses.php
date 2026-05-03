<?php
require_once 'includes/db.php';

// Fetch all courses
$stmt = $pdo->query("SELECT * FROM courses ORDER BY id DESC");
$courses = $stmt->fetchAll();

include 'includes/header.php';
?>

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Our Courses</h1>
        <p class="lead">Explore our diverse range of academic programs</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php if(count($courses) > 0): ?>
            <?php foreach($courses as $course): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="assets/images/<?php echo htmlspecialchars($course['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($course['title']); ?>" onerror="this.src='https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark"><?php echo htmlspecialchars($course['title']); ?></h5>
                        <p class="card-text text-muted"><?php echo htmlspecialchars(substr($course['description'], 0, 120)) . '...'; ?></p>
                        
                        <div class="d-flex justify-content-between mb-3 border-top pt-3">
                            <span class="text-muted"><i class="far fa-clock me-2 text-primary"></i><?php echo htmlspecialchars($course['duration']); ?></span>
                            <span class="fw-bold text-success">$<?php echo htmlspecialchars(number_format($course['fees'], 2)); ?></span>
                        </div>
                        
                        <a href="course-detail.php?id=<?php echo $course['id']; ?>" class="btn btn-outline-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-book fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">No courses available at the moment.</h3>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
