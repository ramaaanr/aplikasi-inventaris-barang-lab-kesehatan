<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <h1 class="text-center">Admin Dashboard</h1>
            <p class="text-center">
                Welcome, <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong>!
            </p>
            <div class="text-center mt-4">
                <a href="/auth/logout" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
