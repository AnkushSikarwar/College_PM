<?php
require_once 'includes/db.php';

// Fetch all faculty
$stmt = $pdo->query("SELECT * FROM faculty ORDER BY name ASC");
$facultyList = $stmt->fetchAll();

include 'includes/header.php';
?>

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Our Faculty</h1>
        <p class="lead">Learn from the brightest minds</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php if(count($facultyList) > 0): ?>
            <?php foreach($facultyList as $faculty): ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <img src="assets/images/<?php echo htmlspecialchars($faculty['image']); ?>" class="card-img-top faculty-img" alt="<?php echo htmlspecialchars($faculty['name']); ?>" onerror="this.src='https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark mb-1"><?php echo htmlspecialchars($faculty['name']); ?></h5>
                        <p class="text-primary fw-semibold mb-1 small"><?php echo htmlspecialchars($faculty['designation']); ?></p>
                        <p class="text-muted small mb-0"><?php echo htmlspecialchars($faculty['subject']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-users fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">Faculty profiles will be updated soon.</h3>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
