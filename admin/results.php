<?php
require_once 'includes/auth.php';
require_once '../includes/db.php';

$success = '';
$error = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM results WHERE id = ?");
    if ($stmt->execute([$id])) {
        header("Location: results.php");
        exit;
    }
}

// Handle Add Result
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_result'])) {
    $roll_no = trim($_POST['roll_no']);
    $name = trim($_POST['name']);
    $course = trim($_POST['course']);
    $marks = intval($_POST['marks']);
    $total_marks = intval($_POST['total_marks']);
    $grade = trim($_POST['grade']);
    $status = trim($_POST['status']);
    
    if (empty($roll_no) || empty($name) || empty($course) || empty($grade) || empty($status)) {
        $error = "All fields are required.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO results (roll_no, name, course, marks, total_marks, grade, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$roll_no, $name, $course, $marks, $total_marks, $grade, $status])) {
                $success = "Result added successfully.";
            } else {
                $error = "Failed to add result.";
            }
        } catch(PDOException $e) {
            $error = "Error: Roll Number might already exist.";
        }
    }
}

// Fetch all results
$results = $pdo->query("SELECT * FROM results ORDER BY id DESC")->fetchAll();

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold m-0 text-dark">Manage Results</h4>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addResultModal"><i class="fas fa-plus me-2"></i> Add Result</button>
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
                        <th class="ps-4">Roll No</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Score</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($results) > 0): ?>
                        <?php foreach($results as $res): ?>
                        <tr>
                            <td class="ps-4 fw-bold text-primary"><?php echo htmlspecialchars($res['roll_no']); ?></td>
                            <td class="fw-semibold text-dark"><?php echo htmlspecialchars($res['name']); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($res['course']); ?></td>
                            <td><?php echo $res['marks'] . '/' . $res['total_marks']; ?> <span class="badge bg-secondary ms-1"><?php echo htmlspecialchars($res['grade']); ?></span></td>
                            <td>
                                <?php if(strtolower($res['status']) == 'pass'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success">Pass</span>
                                <?php else: ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">Fail</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <a href="results.php?delete=<?php echo $res['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this result?');"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No results found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Result Modal -->
<div class="modal fade" id="addResultModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Student Result</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Roll Number</label>
                            <input type="text" name="roll_no" class="form-control" required placeholder="CS-101">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Student Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Course</label>
                        <input type="text" name="course" class="form-control" required placeholder="B.Sc Computer Science">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Obtained Marks</label>
                            <input type="number" name="marks" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Total Marks</label>
                            <input type="number" name="total_marks" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Grade</label>
                            <input type="text" name="grade" class="form-control" required placeholder="A+">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Pass">Pass</option>
                            <option value="Fail">Fail</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_result" class="btn btn-primary px-4">Save Result</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
