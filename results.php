<?php
require_once 'includes/db.php';
include 'includes/header.php';

$result = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $roll_no = trim($_POST['roll_no']);
    
    if (!empty($roll_no)) {
        $stmt = $pdo->prepare("SELECT * FROM results WHERE roll_no = ?");
        $stmt->execute([$roll_no]);
        $result = $stmt->fetch();
        
        if (!$result) {
            $error = "No result found for Roll Number: " . htmlspecialchars($roll_no);
        }
    } else {
        $error = "Please enter a valid Roll Number.";
    }
}
?>

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Exam Results</h1>
        <p class="lead">Check your academic performance</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-5">
                <div class="card-body p-4 p-md-5 bg-white rounded">
                    <h3 class="fw-bold mb-4 text-center">Search Result</h3>
                    
                    <?php if($error): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="input-group input-group-lg mb-3">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-id-card text-muted"></i></span>
                            <input type="text" name="roll_no" class="form-control border-start-0" placeholder="Enter your Roll Number (e.g., CS-101)" required value="<?php echo isset($_POST['roll_no']) ? htmlspecialchars($_POST['roll_no']) : ''; ?>">
                            <button class="btn btn-primary px-4" type="submit" name="search">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if($result): ?>
            <div class="card border-0 shadow border-top border-primary border-4 animate__animated animate__fadeInUp">
                <div class="card-header bg-white p-4 pb-0 border-0 text-center">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($result['name']); ?>&background=random&size=100" class="rounded-circle mb-3 shadow-sm" alt="Student">
                    <h3 class="fw-bold mb-0"><?php echo htmlspecialchars($result['name']); ?></h3>
                    <p class="text-muted">Roll No: <span class="fw-semibold text-dark"><?php echo htmlspecialchars($result['roll_no']); ?></span></p>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <p class="text-muted mb-1 small text-uppercase fw-semibold">Course</p>
                            <h5 class="fw-bold"><?php echo htmlspecialchars($result['course']); ?></h5>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <p class="text-muted mb-1 small text-uppercase fw-semibold">Status</p>
                            <?php if(strtolower($result['status']) == 'pass'): ?>
                                <span class="badge bg-success fs-6 px-3 py-2">Pass</span>
                            <?php else: ?>
                                <span class="badge bg-danger fs-6 px-3 py-2">Fail</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Subject Marks</th>
                                    <th>Total Marks</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-semibold fs-5"><?php echo htmlspecialchars($result['marks']); ?></td>
                                    <td class="fw-semibold fs-5 text-muted"><?php echo htmlspecialchars($result['total_marks']); ?></td>
                                    <td class="fw-bold fs-5 text-primary"><?php echo htmlspecialchars($result['grade']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light p-3 text-center border-0 rounded-bottom">
                    <button onclick="window.print()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-print me-2"></i>Print Result</button>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
