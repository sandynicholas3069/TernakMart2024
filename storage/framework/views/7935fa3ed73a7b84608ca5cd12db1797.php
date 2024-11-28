<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart</h1>
        <div class="space-x-4">
            <a href="<?php echo e(route('landing')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="min-h-screen bg-gray-50 flex items-center justify-center">
        <form action="<?php echo e(route('login')); ?>" method="POST" class="bg-gray-800 p-6 rounded shadow-md space-y-4 w-full max-w-md">
            <?php echo csrf_field(); ?>
            <h2 class="text-2xl text-center text-white font-bold">Login</h2>
            
            <!-- Display Error Messages -->
            <?php if($errors->any()): ?>
                <div class="bg-red-100 text-red-800 p-6 rounded shadow-md space-y-4 w-full max-w-md">
                    <ul class="list-disc pl-5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <!-- Email Field -->
            <input type="email" name="email" placeholder="Input Your Email" 
                   class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500">
            
            <!-- Password Field -->
            <input type="password" name="password" placeholder="Input Your Password" 
                   class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500">
            
            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-blue-500 text-white hover:bg-blue-600 p-2 rounded transition duration-300">
                Login
            </button>
            
            <!-- Register Link -->
            <a href="<?php echo e(route('register')); ?>" 
               class="text-blue-300 text-sm hover:underline transition-colors duration-300">
                Register
            </a>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html><?php /**PATH D:\Apps\laragon\www\ternakmart\resources\views/login.blade.php ENDPATH**/ ?>