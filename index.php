<!DOCTYPE html>
<html>
<head>
    <title>Dav's Server</title>
    <link rel="stylesheet" href="" class="rel">
</head>
<body>
    <div class="container">
        <h2>Hello Welcome To David Infrastructure Server!!!</h2>
        <div class="stat-section">
            <h4>Server Statistics:</h4>
            <p><span>Server Time:</span> <?php echo date('Y-m-d H:i:s'); ?></p>
            <p><span>Server Load:</span> 
                <?php 
                if (function_exists('sys_getloadavg')) {
                    $load = sys_getloadavg();
                    echo implode(', ', $load);
                } else {
                    echo 'Load average not available';
                }
                ?>
            </p>
            <p><span>Memory Usage:</span> <?php echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB'; ?></p>
            <p><span>Disk Usage:</span> <?php echo round(disk_free_space("/") / 1024 / 1024 / 1024, 2) . ' GB free of ' . round(disk_total_space("/") / 1024 / 1024 / 1024, 2) . ' GB'; ?></p>
           
            <p><span>Network Status:</span>
                <?php
                if (function_exists('shell_exec')) {
                    $networkStatus = shell_exec('ping -c 1 google.com');
                    echo strpos($networkStatus, '1 received') !== false ? 'Online' : 'Offline';
                } else {
                    echo 'Network status not available';
                }
                ?>
            </p>
            <p><span>Running Processes:</span>
                <?php
                if (function_exists('shell_exec')) {
                    $processes = shell_exec('ps -e | wc -l');
                    echo $processes ? trim($processes) . ' processes running' : 'Process information not available';
                } else {
                    echo 'Process information not available';
                }
                ?>
            </p>
        </div>
    </div>
    <footer>
        <p><span>Author By : David Aryasetia - Dav's Corp Company 2024</span></p>
    </footer>
</body>
</html>

