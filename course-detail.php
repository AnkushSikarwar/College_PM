<?php
require_once 'includes/db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: courses.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->execute([$id]);
$course = $stmt->fetch();

if (!$course) {
    header("Location: courses.php");
    exit;
}

include 'includes/header.php';
?>

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="courses.php" class="text-white-50 text-decoration-none">Courses</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page"><?php echo htmlspecialchars($course['title']); ?></li>
            </ol>
        </nav>
        <h1 class="display-5 fw-bold mt-3"><?php echo htmlspecialchars($course['title']); ?></h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <img src="assets/images/<?php echo htmlspecialchars($course['image']); ?>" class="img-fluid rounded shadow-sm mb-4 w-100" style="max-height: 400px; object-fit: cover;" alt="<?php echo htmlspecialchars($course['title']); ?>" onerror="this.src='https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'">
            
            <div class="bg-white p-4 rounded shadow-sm">
                <h3 class="fw-bold mb-4 border-bottom pb-2">Course Overview</h3>
                <div class="text-muted" style="line-height: 1.8;">
                    <?php echo nl2br(htmlspecialchars($course['description'])); ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                <div class="card-body p-4">
                    <h4 class="fw-bold border-bottom pb-3 mb-4">Course Details</h4>
                    
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between mb-3">
                            <span class="text-muted"><i class="far fa-clock me-2 text-primary"></i> Duration:</span>
                            <span class="fw-semibold"><?php echo htmlspecialchars($course['duration']); ?></span>
                        </li>
                        <li class="d-flex justify-content-between mb-3">
                            <span class="text-muted"><i class="fas fa-tag me-2 text-primary"></i> Fees:</span>
                            <span class="fw-bold text-success">$<?php echo htmlspecialchars(number_format($course['fees'], 2)); ?></span>
                        </li>
                        <li class="d-flex justify-content-between mb-3">
                            <span class="text-muted"><i class="fas fa-calendar-alt me-2 text-primary"></i> Intake:</span>
                            <span class="fw-semibold">Fall & Spring</span>
                        </li>
                    </ul>
                    
                    <a href="admission.php?course_id=<?php echo $course['id']; ?>" class="btn btn-primary btn-lg w-100 mb-3">Apply Now</a>
                    <a href="contact.php" class="btn btn-outline-secondary w-100">Have Questions?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
