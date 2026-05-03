<?php
require_once 'includes/db.php';

$success = '';
$error = '';

// Fetch active courses for the dropdown
$stmt = $pdo->query("SELECT id, title FROM courses ORDER BY title ASC");
$courses = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply'])) {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $course_id = $_POST['course_id'];
    $previous_school = trim($_POST['previous_school']);
    $percentage = floatval($_POST['percentage']);
    
    if (empty($full_name) || empty($email) || empty($phone) || empty($course_id) || empty($previous_school) || empty($percentage)) {
        $error = "All fields are required.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO admissions (full_name, email, phone, course_id, previous_school, percentage) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$full_name, $email, $phone, $course_id, $previous_school, $percentage])) {
                $success = "Your admission application has been submitted successfully. We will contact you soon.";
            } else {
                $error = "Failed to submit application. Please try again.";
            }
        } catch(PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}

include 'includes/header.php';
?>

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Admission Application</h1>
        <p class="lead">Take the first step towards a bright future</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-white p-4 border-bottom text-center">
                    <h3 class="fw-bold mb-0">Apply Online</h3>
                </div>
                <div class="card-body p-4 p-md-5 bg-light">
                    
                    <?php if($success): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> <?php echo $success; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <h5 class="mb-4 fw-bold text-primary border-bottom pb-2">Personal Information</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Full Name *</label>
                                <input type="text" class="form-control form-control-lg" name="full_name" required placeholder="Enter your full name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address *</label>
                                <input type="email" class="form-control form-control-lg" name="email" required placeholder="Enter your email">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number *</label>
                                <input type="tel" class="form-control form-control-lg" name="phone" required placeholder="Enter your phone number">
                            </div>
                        </div>

                        <h5 class="mb-4 fw-bold text-primary border-bottom pb-2 mt-5">Academic Details</h5>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Select Course *</label>
                                <select class="form-select form-select-lg" name="course_id" required>
                                    <option value="" disabled selected>Choose a course to apply for</option>
                                    <?php foreach($courses as $course): ?>
                                        <option value="<?php echo $course['id']; ?>" <?php echo (isset($_GET['course_id']) && $_GET['course_id'] == $course['id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($course['title']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Previous School/College *</label>
                                <input type="text" class="form-control form-control-lg" name="previous_school" required placeholder="Name of previous institution">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Percentage/CGPA *</label>
                                <input type="number" step="0.01" min="0" max="100" class="form-control form-control-lg" name="percentage" required placeholder="e.g., 85.5">
                            </div>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" name="apply" class="btn btn-primary btn-lg">Submit Application <i class="fas fa-arrow-right ms-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
