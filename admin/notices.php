<?php
require_once 'includes/auth.php';
require_once '../includes/db.php';

$success = '';
$error = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM notices WHERE id = ?");
    if ($stmt->execute([$id])) {
        header("Location: notices.php");
        exit;
    }
}

// Handle Add Notice
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_notice'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $date = $_POST['date'];
    
    if (empty($title) || empty($content) || empty($date)) {
        $error = "All fields are required.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO notices (title, content, date, is_active) VALUES (?, ?, ?, 1)");
        if ($stmt->execute([$title, $content, $date])) {
            $success = "Notice added successfully.";
        } else {
            $error = "Failed to add notice.";
        }
    }
}

// Handle Toggle Active
if (isset($_GET['toggle']) && isset($_GET['state'])) {
    $id = $_GET['toggle'];
    $state = $_GET['state'] == '1' ? 0 : 1;
    $stmt = $pdo->prepare("UPDATE notices SET is_active = ? WHERE id = ?");
    $stmt->execute([$state, $id]);
    header("Location: notices.php");
    exit;
}

// Fetch all notices
$notices = $pdo->query("SELECT * FROM notices ORDER BY date DESC")->fetchAll();

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold m-0 text-dark">Manage Notices</h4>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addNoticeModal"><i class="fas fa-plus me-2"></i> Add Notice</button>
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
                        <th class="ps-4">Date</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($notices) > 0): ?>
                        <?php foreach($notices as $notice): ?>
                        <tr>
                            <td class="ps-4 text-muted small"><?php echo date('M d, Y', strtotime($notice['date'])); ?></td>
                            <td class="fw-semibold text-dark"><?php echo htmlspecialchars($notice['title']); ?></td>
                            <td>
                                <a href="notices.php?toggle=<?php echo $notice['id']; ?>&state=<?php echo $notice['is_active']; ?>" class="badge rounded-pill text-decoration-none <?php echo $notice['is_active'] ? 'bg-success' : 'bg-secondary'; ?>">
                                    <?php echo $notice['is_active'] ? 'Active' : 'Inactive'; ?>
                                </a>
                            </td>
                            <td class="text-end pe-4">
                                <a href="notices.php?delete=<?php echo $notice['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this notice?');"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No notices found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Notice Modal -->
<div class="modal fade" id="addNoticeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add New Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Notice Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Date</label>
                        <input type="date" name="date" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Content</label>
                        <textarea name="content" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_notice" class="btn btn-primary px-4">Save Notice</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
