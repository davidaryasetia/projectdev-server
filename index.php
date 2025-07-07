<!DOCTYPE html>
<html>

<head>
    <title>Dav's Server</title>
    <link rel="stylesheet" href="style.css" class="rel">
</head>

<body>
    <div class="container">
        <h2>Welcome to David's Server Infrastructure !!</h2>
        <div class="stat-section">
            <h4>Server Statistics:</h4>
            <p><span>Server Running:</span> <?php
            $isDocker = false;
            if (file_exists('/.dockerenv')) {
                $isDocker = true;
            } elseif (is_readable('/proc/1/cgroup')) {
                $cgroup = file_get_contents('/proc/1/cgroup');
                if (strpos($cgroup, 'docker') !== false || strpos($cgroup, 'containerd') !== false) {
                    $isDocker = true;
                }
            }
            echo $isDocker ? 'Running in Docker' : 'Not running in Docker';
            ?></p>
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
            <p><span>Docker Status:</span> <?php echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB'; ?></p>
            <p><span>Memory Usage:</span> <?php echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB'; ?></p>
            <p><span>Disk Usage:</span>
                <?php echo round(disk_free_space("/") / 1024 / 1024 / 1024, 2) . ' GB free of ' . round(disk_total_space("/") / 1024 / 1024 / 1024, 2) . ' GB'; ?>
            </p>

            <p><span>Network Status:</span>
                <?php
                if (function_exists('shell_exec')) {
                    // Detect OS and use appropriate ping command
                    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                        $networkStatus = shell_exec('ping -n 1 google.com');
                        $isOnline = $networkStatus && strpos($networkStatus, 'TTL=') !== false;
                    } else {
                        $networkStatus = shell_exec('ping -c 1 google.com');
                        $isOnline = $networkStatus && (strpos($networkStatus, '1 received') !== false || strpos($networkStatus, '1 packets received') !== false);
                    }
                    echo $isOnline ? 'Online' : 'Offline';
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
        <p><span>Created By David Aryasetia</span></p>
    </footer>
</body>

</html>