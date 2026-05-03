<?php
require_once 'includes/auth.php';
require_once '../includes/db.php';

// Fetch stats
$studentsCount = $pdo->query("SELECT COUNT(*) FROM admissions")->fetchColumn();
$coursesCount = $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
$facultyCount = $pdo->query("SELECT COUNT(*) FROM faculty")->fetchColumn();
$noticesCount = $pdo->query("SELECT COUNT(*) FROM notices")->fetchColumn();

// Fetch recent admissions
$recentAdmissions = $pdo->query("SELECT * FROM admissions ORDER BY created_at DESC LIMIT 5")->fetchAll();

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="row g-4 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card h-100 bg-primary text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 text-uppercase mb-1">Total Admissions</h6>
                    <h2 class="fw-bold mb-0"><?php echo $studentsCount; ?></h2>
                </div>
                <div class="fs-1 text-white-50"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card h-100 bg-success text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 text-uppercase mb-1">Total Courses</h6>
                    <h2 class="fw-bold mb-0"><?php echo $coursesCount; ?></h2>
                </div>
                <div class="fs-1 text-white-50"><i class="fas fa-book"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card h-100 bg-warning text-dark p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-dark-50 text-uppercase mb-1">Total Faculty</h6>
                    <h2 class="fw-bold mb-0"><?php echo $facultyCount; ?></h2>
                </div>
                <div class="fs-1 opacity-50"><i class="fas fa-chalkboard-teacher"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card h-100 bg-danger text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 text-uppercase mb-1">Total Notices</h6>
                    <h2 class="fw-bold mb-0"><?php echo $noticesCount; ?></h2>
                </div>
                <div class="fs-1 text-white-50"><i class="fas fa-bell"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold m-0">Recent Applications</h5>
                <a href="admissions.php" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Applicant Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($recentAdmissions) > 0): ?>
                                <?php foreach($recentAdmissions as $adm): ?>
                                <tr>
                                    <td class="ps-4 fw-semibold"><?php echo htmlspecialchars($adm['full_name']); ?></td>
                                    <td class="text-muted"><?php echo htmlspecialchars($adm['email']); ?></td>
                                    <td>
                                        <?php if($adm['status'] == 'Approved'): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success">Approved</span>
                                        <?php elseif($adm['status'] == 'Rejected'): ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">Rejected</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-muted small"><?php echo date('M d, Y', strtotime($adm['created_at'])); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No recent admissions found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
