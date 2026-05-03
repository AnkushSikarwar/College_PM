<?php
require_once 'includes/auth.php';
require_once '../includes/db.php';

$success = '';
$error = '';

// ================= DELETE =================
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Get image first
    $stmt = $pdo->prepare("SELECT image FROM faculty WHERE id = ?");
    $stmt->execute([$id]);
    $faculty = $stmt->fetch();

    if ($faculty) {
        // Delete image file
        if (!empty($faculty['image']) && file_exists("uploads/faculty/" . $faculty['image'])) {
            unlink("uploads/faculty/" . $faculty['image']);
        }

        // Delete record
        $stmt = $pdo->prepare("DELETE FROM faculty WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: faculty.php");
        exit;
    }
}

// ================= ADD FACULTY =================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_faculty'])) {

    $name = trim($_POST['name']);
    $designation = trim($_POST['designation']);
    $subject = trim($_POST['subject']);

    // Image handling
    $imageName = '';
    if (!empty($_FILES['image']['name'])) {

        $file = $_FILES['image'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ext, $allowed)) {
            $error = "Only JPG, JPEG, PNG, WEBP files allowed.";
        } else {

            $uploadDir = "uploads/faculty/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imageName = time() . "_" . uniqid() . "." . $ext;
            $targetFile = $uploadDir . $imageName;

            if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
                $error = "Image upload failed.";
            }
        }
    }

    if (empty($name) || empty($designation) || empty($subject)) {
        $error = "All fields are required.";
    }

    if (empty($error)) {
        $stmt = $pdo->prepare("INSERT INTO faculty (name, designation, subject, image) VALUES (?, ?, ?, ?)");

        if ($stmt->execute([$name, $designation, $subject, $imageName])) {
            $success = "Faculty member added successfully.";
        } else {
            $error = "Database error.";
        }
    }
}

// ================= FETCH DATA =================
$facultyList = $pdo->query("SELECT * FROM faculty ORDER BY name ASC")->fetchAll();

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold m-0 text-dark">Manage Faculty</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFacultyModal">
            + Add Faculty
        </button>
    </div>
</div>

<?php if ($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Image</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Subject</th>
                    <th class="text-end pe-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($facultyList) > 0): ?>
                    <?php foreach ($facultyList as $faculty): ?>
                        <tr>
                            <td class="ps-3">
                                <?php
                                $imgPath = (!empty($faculty['image']) && file_exists("uploads/faculty/" . $faculty['image']))
                                    ? "uploads/faculty/" . $faculty['image']
                                    : "https://via.placeholder.com/40";
                                ?>
                                <img src="<?php echo $imgPath; ?>" width="40" height="40" class="rounded-circle">
                            </td>
                            <td><?php echo htmlspecialchars($faculty['name']); ?></td>
                            <td><?php echo htmlspecialchars($faculty['designation']); ?></td>
                            <td><?php echo htmlspecialchars($faculty['subject']); ?></td>
                            <td class="text-end pe-3">
                                <a href="?delete=<?php echo $faculty['id']; ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this faculty?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4">No faculty found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ================= MODAL ================= -->
<div class="modal fade" id="addFacultyModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5>Add Faculty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>

                    <input type="text" name="designation" class="form-control mb-2" placeholder="Designation" required>

                    <input type="text" name="subject" class="form-control mb-2" placeholder="Subject" required>

                    <input type="file" name="image" class="form-control" required>

                </div>

                <div class="modal-footer">
                    <button type="submit" name="add_faculty" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>