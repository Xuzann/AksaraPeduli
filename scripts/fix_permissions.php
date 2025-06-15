<?php

// Script untuk fix permission direktori upload
// Jalankan dengan: php scripts/fix_permissions.php

echo "🔧 FIXING UPLOAD PERMISSIONS\n";
echo "============================\n\n";

$publicPath = __DIR__ . '/../public';
$uploadsPath = $publicPath . '/uploads';
$campaignsPath = $uploadsPath . '/campaigns';
$profilePath = $uploadsPath . '/profile_pictures';

echo "1. Checking current permissions...\n";
echo "   Uploads: " . (file_exists($uploadsPath) ? substr(sprintf('%o', fileperms($uploadsPath)), -4) : 'NOT EXISTS') . "\n";
echo "   Campaigns: " . (file_exists($campaignsPath) ? substr(sprintf('%o', fileperms($campaignsPath)), -4) : 'NOT EXISTS') . "\n";
echo "   Profile: " . (file_exists($profilePath) ? substr(sprintf('%o', fileperms($profilePath)), -4) : 'NOT EXISTS') . "\n";

echo "\n2. Fixing permissions...\n";

// Fix uploads directory
if (file_exists($uploadsPath)) {
    if (chmod($uploadsPath, 0777)) {
        echo "   ✅ Fixed uploads directory permissions to 0777\n";
    } else {
        echo "   ❌ Failed to fix uploads directory permissions\n";
    }
} else {
    echo "   ❌ Uploads directory does not exist\n";
}

// Fix campaigns directory
if (file_exists($campaignsPath)) {
    if (chmod($campaignsPath, 0777)) {
        echo "   ✅ Fixed campaigns directory permissions to 0777\n";
    } else {
        echo "   ❌ Failed to fix campaigns directory permissions\n";
    }
} else {
    if (mkdir($campaignsPath, 0777, true)) {
        echo "   ✅ Created campaigns directory with 0777 permissions\n";
    } else {
        echo "   ❌ Failed to create campaigns directory\n";
    }
}

// Fix profile_pictures directory
if (file_exists($profilePath)) {
    if (chmod($profilePath, 0777)) {
        echo "   ✅ Fixed profile_pictures directory permissions to 0777\n";
    } else {
        echo "   ❌ Failed to fix profile_pictures directory permissions\n";
    }
} else {
    if (mkdir($profilePath, 0777, true)) {
        echo "   ✅ Created profile_pictures directory with 0777 permissions\n";
    } else {
        echo "   ❌ Failed to create profile_pictures directory\n";
    }
}

echo "\n3. Verifying permissions after fix...\n";
echo "   Uploads: " . (file_exists($uploadsPath) ? substr(sprintf('%o', fileperms($uploadsPath)), -4) : 'NOT EXISTS') . "\n";
echo "   Campaigns: " . (file_exists($campaignsPath) ? substr(sprintf('%o', fileperms($campaignsPath)), -4) : 'NOT EXISTS') . "\n";
echo "   Profile: " . (file_exists($profilePath) ? substr(sprintf('%o', fileperms($profilePath)), -4) : 'NOT EXISTS') . "\n";

echo "\n4. Testing write permissions...\n";

// Test campaigns directory
$testFile = $campaignsPath . '/test_write_' . time() . '.txt';
if (file_put_contents($testFile, 'test write permission')) {
    echo "   ✅ Campaigns directory write test: SUCCESS\n";
    unlink($testFile);
} else {
    echo "   ❌ Campaigns directory write test: FAILED\n";
}

// Test profile_pictures directory
$testFile = $profilePath . '/test_write_' . time() . '.txt';
if (file_put_contents($testFile, 'test write permission')) {
    echo "   ✅ Profile_pictures directory write test: SUCCESS\n";
    unlink($testFile);
} else {
    echo "   ❌ Profile_pictures directory write test: FAILED\n";
}

echo "\n🎉 Permission fix completed!\n";
echo "\nIf you still have issues, try running this script as Administrator.\n";

?>
