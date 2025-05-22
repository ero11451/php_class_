<?php

function AdminLayout($pagePath, $data = [])
{
    // Extract the data array to variables
    extract($data);

    // Make $pageContent available in view.php
    ob_start();
    include $pagePath;
    $pageContent = ob_get_clean();

    // Now render the layout with $pageContent
    include __DIR__ . '/view.php';

    
}
