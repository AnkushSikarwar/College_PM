<?php
require_once 'includes/auth.php';
require_once '../includes/db.php';

$success = '';
$error = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: courses.php");
        exit;
    } catch(PDOException $e) {
        $error = "Cannot delete course because it has associated records.";
    }
}

// Handle Add Course
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_course'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $duration = trim($_POST['duration']);
    $fees = floatval($_POST['fees']);
    
    if (empty($title) || empty($description) || empty($duration) || empty($fees)) {
        $error = "All fields are required.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO courses (title, description, duration, fees) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$title, $description, $duration, $fees])) {
            $success = "Course added successfully.";
        } else {
            $error = "Failed to add course.";
        }
    }
}

// Fetch all courses
$courses = $pdo->query("SELECT * FROM courses ORDER BY id DESC")->fetchAll();

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold m-0 text-dark">Manage Courses</h4>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addCourseModal"><i class="fas fa-plus me-2"></i> Add Course</button>
    </div>
</div>

<?php if($success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert"><?php echo $success; ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if($error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert"><?php echo $error; ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Title</th>
                        <th>Duration</th>
                        <th>Fees</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($courses) > 0): ?>
                        <?php foreach($courses as $course): ?>
                        <tr>
                            <td class="ps-4 fw-semibold text-dark"><?php echo htmlspecialchars($course['title']); ?></td>
                            <td><?php echo htmlspecialchars($course['duration']); ?></td>
                            <td class="text-success fw-bold">$<?php echo htmlspecialchars(number_format($course['fees'], 2)); ?></td>
                            <td class="text-end pe-4">
                                <a href="courses.php?delete=<?php echo $course['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this course?');"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No courses found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Course Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Duration (e.g., 4 Years)</label>
                            <input type="text" name="duration" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Fees ($)</label>
                            <input type="number" step="0.01" name="fees" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Description</label>
                        <textarea name="description" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_course" class="btn btn-primary px-4">Save Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
