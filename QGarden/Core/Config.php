<?php

namespace Core;


class Config
{
    public const DebugMode = true;
    public const ProductPerPage = 9;
    public const NewProductsCount = 6;
    public const CategoryHomeCount = 4;
    public const DealProductsCount = 4;
    public const DocumentRoot = "C:/Jeremy/WAMP/www/PRO1"; #Project Root Path
    public const WebDocumentRoot = "http://localhost/PRO1/"; #Project Web Root Path
    public const WebImagesRoot = "http://localhost/PRO1/Themes/Images"; #Project Images Upload Root Path
    public const ImagesRoot = "C:/Jeremy/WAMP/www/PRO1/Themes/Images";  #Project Web Images Upload Root Path

    public $ImagesRoot = self::ImagesRoot;
    public $DocumentRoot = self::DocumentRoot;
    public $WebImagesRoot = self::WebImagesRoot;
    public $ProductPerPage = self::ProductPerPage;
    public $WebDocumentRoot = self::WebDocumentRoot;
    public $NewProductsCount = self::NewProductsCount;
    public $DealProductsCount = self::DealProductsCount;
    public $CategoryHomeCount = self::CategoryHomeCount;

    protected const DatabaseName = "QGarden";
    protected const DatabaseUser = "Jeremy";
    protected const DatabasePass = "SonViet@0104LOVE";
    protected const DatabaseServer = "localhost";

    protected const HashAlgorithm = 'SHA3-256';
}
