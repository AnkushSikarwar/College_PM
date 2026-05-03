<?php
require_once 'includes/db.php';

// Fetch all gallery images
$stmt = $pdo->query("SELECT * FROM gallery ORDER BY id DESC");
$images = $stmt->fetchAll();

include 'includes/header.php';
?>

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Photo Gallery</h1>
        <p class="lead">Glimpses of campus life and events</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php if(count($images) > 0): ?>
            <?php foreach($images as $image): ?>
            <div class="col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm h-100 bg-white">
                    <img src="assets/images/<?php echo htmlspecialchars($image['image_path']); ?>" class="card-img-top gallery-img rounded" style="height: 250px; object-fit: cover;" alt="<?php echo htmlspecialchars($image['description']); ?>" onerror="this.src='https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'" data-bs-toggle="modal" data-bs-target="#imageModal<?php echo $image['id']; ?>">
                    <div class="card-body p-2 text-center">
                        <span class="badge bg-secondary mb-1"><?php echo htmlspecialchars($image['category']); ?></span>
                        <p class="small text-muted mb-0"><?php echo htmlspecialchars($image['description']); ?></p>
                    </div>
                </div>
            </div>

            <!-- Lightbox Modal -->
            <div class="modal fade" id="imageModal<?php echo $image['id']; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-transparent border-0">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="assets/images/<?php echo htmlspecialchars($image['image_path']); ?>" class="img-fluid rounded shadow" alt="<?php echo htmlspecialchars($image['description']); ?>" onerror="this.src='https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'">
                            <p class="text-white mt-3"><?php echo htmlspecialchars($image['description']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-images fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">Gallery is empty.</h3>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
