<?php

// Script untuk debug masalah upload di Windows
// Jalankan dengan: php scripts/debug_upload_issue.php

echo "🔍 DEBUGGING UPLOAD ISSUE\n";
echo "========================\n\n";

// 1. Check current working directory
echo "1. Current working directory: " . getcwd() . "\n";
echo "2. Script directory: " . __DIR__ . "\n";

// 3. Check public path
$publicPath = __DIR__ . '/../public';
echo "3. Public path: " . realpath($publicPath) . "\n";

// 4. Check uploads directory
$uploadsPath = $publicPath . '/uploads';
echo "4. Uploads path: " . $uploadsPath . "\n";
echo "   Uploads exists: " . (file_exists($uploadsPath) ? "YES" : "NO") . "\n";
echo "   Uploads is dir: " . (is_dir($uploadsPath) ? "YES" : "NO") . "\n";
echo "   Uploads writable: " . (is_writable($uploadsPath) ? "YES" : "NO") . "\n";

// 5. Check campaigns directory
$campaignsPath = $uploadsPath . '/campaigns';
echo "5. Campaigns path: " . $campaignsPath . "\n";
echo "   Campaigns exists: " . (file_exists($campaignsPath) ? "YES" : "NO") . "\n";
echo "   Campaigns is dir: " . (is_dir($campaignsPath) ? "YES" : "NO") . "\n";
echo "   Campaigns writable: " . (is_writable($campaignsPath) ? "YES" : "NO") . "\n";

// 6. Try to create directories
echo "\n6. Creating directories...\n";

if (!file_exists($uploadsPath)) {
    if (mkdir($uploadsPath, 0777, true)) {
        echo "   ✅ Created uploads directory\n";
    } else {
        echo "   ❌ Failed to create uploads directory\n";
    }
} else {
    echo "   ✅ Uploads directory already exists\n";
}

if (!file_exists($campaignsPath)) {
    if (mkdir($campaignsPath, 0777, true)) {
        echo "   ✅ Created campaigns directory\n";
    } else {
        echo "   ❌ Failed to create campaigns directory\n";
    }
} else {
    echo "   ✅ Campaigns directory already exists\n";
}

// 7. Test write permission
echo "\n7. Testing write permissions...\n";

$testFile = $campaignsPath . '/test_write.txt';
$testContent = 'Test write permission - ' . date('Y-m-d H:i:s');

if (file_put_contents($testFile, $testContent)) {
    echo "   ✅ Write test successful\n";
    echo "   ✅ Test file created: $testFile\n";
    
    // Clean up test file
    if (unlink($testFile)) {
        echo "   ✅ Test file deleted successfully\n";
    } else {
        echo "   ⚠️  Could not delete test file\n";
    }
} else {
    echo "   ❌ Write test FAILED\n";
    echo "   ❌ Cannot write to: $campaignsPath\n";
}

// 8. Check PHP settings
echo "\n8. PHP Upload Settings:\n";
echo "   upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "   post_max_size: " . ini_get('post_max_size') . "\n";
echo "   max_file_uploads: " . ini_get('max_file_uploads') . "\n";
echo "   memory_limit: " . ini_get('memory_limit') . "\n";
echo "   file_uploads: " . (ini_get('file_uploads') ? 'ON' : 'OFF') . "\n";

// 9. Check directory permissions (Windows style)
echo "\n9. Directory Permissions:\n";
if (function_exists('fileperms')) {
    if (file_exists($uploadsPath)) {
        echo "   Uploads perms: " . substr(sprintf('%o', fileperms($uploadsPath)), -4) . "\n";
    }
    if (file_exists($campaignsPath)) {
        echo "   Campaigns perms: " . substr(sprintf('%o', fileperms($campaignsPath)), -4) . "\n";
    }
}

// 10. Check if running as admin/proper user
echo "\n10. System Info:\n";
echo "   PHP User: " . (function_exists('get_current_user') ? get_current_user() : 'Unknown') . "\n";
echo "   OS: " . PHP_OS . "\n";
echo "   PHP Version: " . PHP_VERSION . "\n";

echo "\n🏁 Debug completed!\n";

?>
