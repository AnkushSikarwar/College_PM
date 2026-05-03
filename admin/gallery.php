<?php
require_once 'includes/auth.php';
require_once '../includes/db.php';

$success = '';
$error = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM gallery WHERE id = ?");
    if ($stmt->execute([$id])) {
        header("Location: gallery.php");
        exit;
    }
}

// Handle Add Image (Simulated Upload - just adding path)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_image'])) {
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    // In a real application, you would handle file upload here. 
    // For this prototype, we'll use a placeholder or Unsplash image URL if no direct path provided.
    $image_path = trim($_POST['image_path']);
    if(empty($image_path)) {
        $image_path = 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';
    }
    
    if (empty($category)) {
        $error = "Category is required.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO gallery (category, image_path, description) VALUES (?, ?, ?)");
        if ($stmt->execute([$category, $image_path, $description])) {
            $success = "Image added successfully.";
        } else {
            $error = "Failed to add image.";
        }
    }
}

// Fetch all gallery images
$images = $pdo->query("SELECT * FROM gallery ORDER BY id DESC")->fetchAll();

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold m-0 text-dark">Manage Gallery</h4>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addImageModal"><i class="fas fa-plus me-2"></i> Add Image</button>
    </div>
</div>

<?php if($success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert"><?php echo $success; ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if($error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert"><?php echo $error; ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="row g-4">
    <?php if(count($images) > 0): ?>
        <?php foreach($images as $image): ?>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0 position-relative">
                <img src="<?php echo htmlspecialchars(strpos($image['image_path'], 'http') === 0 ? $image['image_path'] : '../assets/images/' . $image['image_path']); ?>" class="card-img-top" style="height: 180px; object-fit: cover;" alt="<?php echo htmlspecialchars($image['description']); ?>">
                <a href="gallery.php?delete=<?php echo $image['id']; ?>" class="position-absolute top-0 end-0 m-2 btn btn-sm btn-danger rounded-circle" onclick="return confirm('Delete this image?');"><i class="fas fa-trash"></i></a>
                <div class="card-body p-3 text-center">
                    <span class="badge bg-secondary mb-2"><?php echo htmlspecialchars($image['category']); ?></span>
                    <p class="small text-muted mb-0 text-truncate" title="<?php echo htmlspecialchars($image['description']); ?>"><?php echo htmlspecialchars($image['description']); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5 text-muted">
            <i class="fas fa-images fa-3x mb-3"></i>
            <p>No images found in the gallery.</p>
        </div>
    <?php endif; ?>
</div>

<!-- Add Image Modal -->
<div class="modal fade" id="addImageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add New Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Category</label>
                        <select name="category" class="form-select" required>
                            <option value="Campus">Campus</option>
                            <option value="Events">Events</option>
                            <option value="Facilities">Facilities</option>
                            <option value="Students">Students</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Image Path / URL</label>
                        <input type="text" name="image_path" class="form-control" placeholder="Leave empty for a random placeholder image">
                        <div class="form-text">For this prototype, you can provide an external image URL.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Annual Sports Day 2023">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_image" class="btn btn-primary px-4">Save Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
