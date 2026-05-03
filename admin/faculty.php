<?php
require_once 'includes/auth.php';
require_once '../includes/db.php';

$success = '';
$error = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM faculty WHERE id = ?");
    if ($stmt->execute([$id])) {
        header("Location: faculty.php");
        exit;
    }
}

// Handle Add Faculty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_faculty'])) {
    $name = trim($_POST['name']);
    $designation = trim($_POST['designation']);
    $subject = trim($_POST['subject']);
    
    if (empty($name) || empty($designation) || empty($subject)) {
        $error = "All fields are required.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO faculty (name, designation, subject) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $designation, $subject])) {
            $success = "Faculty member added successfully.";
        } else {
            $error = "Failed to add faculty.";
        }
    }
}

// Fetch all faculty
$facultyList = $pdo->query("SELECT * FROM faculty ORDER BY name ASC")->fetchAll();

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold m-0 text-dark">Manage Faculty</h4>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addFacultyModal"><i class="fas fa-plus me-2"></i> Add Faculty</button>
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
                        <th class="ps-4">Name</th>
                        <th>Designation</th>
                        <th>Subject</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($facultyList) > 0): ?>
                        <?php foreach($facultyList as $faculty): ?>
                        <tr>
                            <td class="ps-4 fw-semibold text-dark">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($faculty['name']); ?>&background=random&size=40" class="rounded-circle me-2" alt="Avatar">
                                <?php echo htmlspecialchars($faculty['name']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($faculty['designation']); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($faculty['subject']); ?></td>
                            <td class="text-end pe-4">
                                <a href="faculty.php?delete=<?php echo $faculty['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this faculty member?');"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No faculty members found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Faculty Modal -->
<div class="modal fade" id="addFacultyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Faculty Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Full Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="Dr. John Doe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Designation</label>
                        <input type="text" name="designation" class="form-control" required placeholder="Professor">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Department / Subject</label>
                        <input type="text" name="subject" class="form-control" required placeholder="Computer Science">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_faculty" class="btn btn-primary px-4">Save Faculty</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
