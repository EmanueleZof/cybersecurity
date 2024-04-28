<!DOCTYPE html>
    <head>
        <title>Lista file</title>
    </head>
    <body>
        <h1>Laboratorio CS</h1>
        <ul>
        <?php 
            $files = array_diff(scandir('.'), array('.', '..'));
            foreach ($files as $f) {
                if (is_dir($f)) {
                    echo "<li>".$f."<ul>";
                    $subfiles = array_diff(scandir($f), array('.', '..'));
                    foreach ($subfiles as $s) {
                        echo "<li><a href=".$f."/".$s." target='_blank'>".$s."</a></li>";
                    }
                    echo "</ul></li>";
                } else {
                    echo "<li><a href=".$f." target='_blank'>".$f."</a></li>";
                }
            }
        ?>
        </ul>
    </body>
</html>