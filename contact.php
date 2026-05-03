<?php
include 'includes/header.php';

$success = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // In a real application, you would send an email or save to DB here.
    // For now, we'll just simulate success.
    $success = true;
}
?>

<!-- Page Header -->
<div class="bg-primary text-white py-5">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Contact Us</h1>
        <p class="lead">We'd love to hear from you</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-5">
            <h3 class="fw-bold mb-4">Get in Touch</h3>
            <p class="text-muted mb-4">Whether you have questions about admissions, our programs, or campus life, our team is ready to answer all your questions.</p>
            
            <div class="d-flex align-items-center mb-4 p-3 bg-white shadow-sm rounded border-start border-primary border-4">
                <div class="bg-light rounded-circle p-3 me-3">
                    <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Our Location</h5>
                    <p class="text-muted mb-0">123 College Avenue, City, State 12345</p>
                </div>
            </div>
            
            <div class="d-flex align-items-center mb-4 p-3 bg-white shadow-sm rounded border-start border-primary border-4">
                <div class="bg-light rounded-circle p-3 me-3">
                    <i class="fas fa-phone-alt fa-2x text-primary"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Phone Number</h5>
                    <p class="text-muted mb-0">+1 234 567 890 <br> <small>Mon-Fri, 8am-5pm</small></p>
                </div>
            </div>
            
            <div class="d-flex align-items-center p-3 bg-white shadow-sm rounded border-start border-primary border-4">
                <div class="bg-light rounded-circle p-3 me-3">
                    <i class="fas fa-envelope fa-2x text-primary"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Email Address</h5>
                    <p class="text-muted mb-0">info@college.edu <br> admission@college.edu</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-7">
            <div class="bg-white p-5 rounded shadow-sm">
                <h3 class="fw-bold mb-4">Send us a Message</h3>
                
                <?php if($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> Thank you! Your message has been sent successfully. We will get back to you soon.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control form-control-lg bg-light" name="name" required placeholder="John Doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control form-control-lg bg-light" name="email" required placeholder="john@example.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Subject</label>
                            <input type="text" class="form-control form-control-lg bg-light" name="subject" required placeholder="How can we help you?">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Message</label>
                            <textarea class="form-control form-control-lg bg-light" name="message" rows="5" required placeholder="Your message here..."></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg px-5">Send Message <i class="fas fa-paper-plane ms-2"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Map -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1683212000000!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
