<?php

include_once  '../../Core/Core.php';
include_once '../../Core/Config.php';

if (isset($_FILES))
{
    reset($_FILES);
    $Image = current($_FILES);

    $UploadPath = (new \Core\Config())::ImagesRoot.'/Upload/'.$Image['name'];
    $returnPath = (new \Core\Config())::WebImagesRoot.'/Upload/'.$Image['name'];

    move_uploaded_file($Image['tmp_name'], $UploadPath);

    echo json_encode(array('location' => $returnPath));
}
else
{
    header('HTTP/2 403 Origin Access Denied');
}

(new \Core\Core())->LogFile('', '', get_defined_vars());
