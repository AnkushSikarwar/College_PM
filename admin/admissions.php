<?php
require_once 'includes/auth.php';
require_once '../includes/db.php';

// Handle status update
if (isset($_GET['action']) && isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    
    if (in_array($status, ['Approved', 'Rejected'])) {
        $stmt = $pdo->prepare("UPDATE admissions SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        header("Location: admissions.php");
        exit;
    }
}

// Fetch all admissions with course titles
$query = "SELECT a.*, c.title as course_title FROM admissions a 
          LEFT JOIN courses c ON a.course_id = c.id 
          ORDER BY a.created_at DESC";
$admissions = $pdo->query($query)->fetchAll();

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="fw-bold m-0 text-dark">Manage Admissions</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Applicant Details</th>
                        <th>Course</th>
                        <th>Percentage</th>
                        <th>Status</th>
                        <th>Applied On</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($admissions as $adm): ?>
                    <tr>
                        <td class="ps-4 text-muted">#<?php echo $adm['id']; ?></td>
                        <td>
                            <div class="fw-semibold text-dark"><?php echo htmlspecialchars($adm['full_name']); ?></div>
                            <div class="small text-muted"><?php echo htmlspecialchars($adm['email']); ?> | <?php echo htmlspecialchars($adm['phone']); ?></div>
                        </td>
                        <td><?php echo htmlspecialchars($adm['course_title'] ?? 'N/A'); ?></td>
                        <td class="fw-semibold"><?php echo htmlspecialchars($adm['percentage']); ?>%</td>
                        <td>
                            <?php if($adm['status'] == 'Approved'): ?>
                                <span class="badge bg-success">Approved</span>
                            <?php elseif($adm['status'] == 'Rejected'): ?>
                                <span class="badge bg-danger">Rejected</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-muted small"><?php echo date('d M Y, h:i A', strtotime($adm['created_at'])); ?></td>
                        <td class="text-end pe-4">
                            <?php if($adm['status'] == 'Pending'): ?>
                                <a href="admissions.php?action=update&id=<?php echo $adm['id']; ?>&status=Approved" class="btn btn-sm btn-success shadow-sm"><i class="fas fa-check"></i> Approve</a>
                                <a href="admissions.php?action=update&id=<?php echo $adm['id']; ?>&status=Rejected" class="btn btn-sm btn-danger shadow-sm"><i class="fas fa-times"></i> Reject</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
