<?php

namespace Model;

use Core\Core;
use Core\Config;
use Core\Database;

class Products
{
    private $Database;

    /**
     * Construct function
     */
    public function __construct()
    {
        $this -> Database = new Database();
    }

    public function GetTotalProduct(int $CategoryID = NULL)
    {
        $SQL = "SELECT COUNT(*) FROM Products";

        if ($CategoryID !== NULL)
        {
            $SQL .= " WHERE ProductCategoryID = ?";

            return (int) $this -> Database -> QSelectOneValue($SQL, $CategoryID);
        } return (int) $this -> Database -> QSelectOneValue($SQL);
    }

    /**
     * Get Products with specific param.
     * @param int $CurrentPage User in current page.
     * @param int|NULL $CategoryID Product category ID.
     * @param string|NULL $SearchKey User search what.?
     * @param int|NULL $PriceFrom User want product with min price.
     * @param int|NULL $PriceTo User want product with max price.
     * @param int|NULL $OnlyStar User want product with rated star from.
     * @param int|NULL $OnlySale User want product with price is sale.
     * @return array|bool|string array contain products list. false if error and error message if Config::DebugMode true.
     */
    public function GetProductList(int $CurrentPage = 0, int $CategoryID = NULL, string $SearchKey = NULL, int $PriceFrom = NULL, int $PriceTo = NULL, int $OnlyStar = NULL, int $OnlySale = NULL)
    {
        $SQL = "(SELECT ProductID, ProductCategoryID, ProductName, ProductPrice, ProductRateAvg, ProductTotalRate, ProductDiscount, ProductDefaultImage, ProductImageList, ProductPreview, ProductDescription, ProductType, ProductSize, ProductColor, ProductAvailable, ProductTotalReview FROM Products WHERE ProductID != 0";

        if ($CategoryID !== NULL)
        {
            $SQL .= " AND ProductCategoryID = ?";
        }

        if ($SearchKey !== NULL)
        {
            $SQL .= " AND ProductName LIKE ?";

            if (is_string($SearchKey))
            {
                $SearchKey = '%'.$SearchKey.'%';
            }
        }

        if ($PriceFrom !== NULL)
        {
            if (is_int($PriceFrom)) $SQL .= " AND ProductPrice >= ".$PriceFrom; else return false;
        }

        if ($PriceTo !== NULL)
        {
            if (is_int($PriceTo)) $SQL .= " AND ProductPrice <= ".$PriceTo; else return false;
        }

        if ($OnlyStar !== NULL)
        {
            if (is_int($OnlyStar)) $SQL .= " AND ProductRateAvg >= ".$OnlyStar; else return false;
        }

        if ($OnlySale !== NULL)
        {
            if ($OnlySale === 1)
            {
                $SQL .= " AND ProductDiscount != 0";
            }

            if ($OnlySale === 2)
            {
                $SQL .= " AND ProductDiscount = 0";
            }

            if (!is_int($OnlySale)) return  false;
        }

        if ($CurrentPage !== 0)
        {
            $SQL .= " GROUP BY ProductID LIMIT ".($CurrentPage - 1) * Config::ProductPerPage.", ".Config::ProductPerPage;
        }

        if ($SearchKey !== NULL and $CategoryID !== NULL)
        {
            return $this -> Database -> QSelect($SQL.") ORDER BY ProductID DESC", $CategoryID, $SearchKey);
        }

        if ($SearchKey !== NULL and $CategoryID === NULL)
        {
            return $this -> Database -> QSelect($SQL.") ORDER BY ProductID DESC", $SearchKey);
        }

        if ($SearchKey === NULL and $CategoryID !== NULL)
        {
            return $this -> Database -> QSelect($SQL.") ORDER BY ProductID DESC", $CategoryID);
        }

        if ($SearchKey === NULL and $CategoryID === NULL)
        {
            return $this -> Database -> QSelect($SQL.") ORDER BY ProductID DESC");
        }

    }

    public function GetDiscountProduct()
    {
        $SQL = "SELECT * FROM Products WHERE ProductDiscount > 0 GROUP BY ProductID LIMIT 16";

        return $this -> Database -> QSelect($SQL);
    }

    public function GetTotalSearchProduct(int $CategoryID = NULL, string $SearchKey = NULL, int $PriceFrom = NULL, int $PriceTo = NULL, int $OnlyStar = NULL, int $OnlySale = NULL)
    {
        $SQL = "SELECT COUNT(*) FROM Products WHERE ProductID != 0";

        if ($CategoryID !== NULL)
        {
            $SQL .= " AND ProductCategoryID = ?";
        }

        if ($SearchKey !== NULL)
        {
            $SQL .= " AND ProductName LIKE ?";

            if (is_string($SearchKey))
            {
                $SearchKey = '%'.$SearchKey.'%';
            }
        }

        if ($PriceFrom !== NULL)
        {
            if (is_int($PriceFrom)) $SQL .= " AND ProductPrice >= ".$PriceFrom; else return false;
        }

        if ($PriceTo !== NULL)
        {
            if (is_int($PriceTo)) $SQL .= " AND ProductPrice <= ".$PriceTo; else return false;
        }

        if ($OnlyStar !== NULL)
        {
            if (is_int($OnlyStar)) $SQL .= " AND ProductRateAvg >= ".$OnlyStar; else return false;
        }

        if ($OnlySale !== NULL)
        {
            if ($OnlySale === 1)
            {
                $SQL .= " AND ProductDiscount != 0";
            }

            if ($OnlySale === 2)
            {
                $SQL .= " AND ProductDiscount = 0";
            }

            if (!is_int($OnlySale)) return  false;
        }

        if ($SearchKey !== NULL and $CategoryID !== NULL)
        {
            return $this -> Database -> QSelectOneValue($SQL, $CategoryID, $SearchKey);
        }

        if ($SearchKey !== NULL and $CategoryID === NULL)
        {
            return $this -> Database -> QSelectOneValue($SQL, $SearchKey);
        }

        if ($SearchKey === NULL and $CategoryID !== NULL)
        {
            return $this -> Database -> QSelectOneValue($SQL, $CategoryID);
        }

        if ($SearchKey === NULL and $CategoryID === NULL)
        {
            return $this -> Database -> QSelectOneValue($SQL);
        }

    }

    public function GetProduct(int $ProductID)
    {
        return $this -> Database -> QSelectOneRecord('SELECT * FROM Products WHERE ProductID = ?', $ProductID);
    }

    public function GetComment(int $ProductID)
    {
        $SQL = 'SELECT * FROM Products, Comments WHERE ProductID = CommentOnProductID AND ProductID = ? GROUP BY ProductID';

        return $this -> Database -> QSelect($SQL, $ProductID);
    }

    public function GetRelatedProduct(int $CategoryID, int $ProductID)
    {
        return $this -> Database -> QSelect('SELECT * FROM Products WHERE ProductCategoryID = ? AND ProductID != ? LIMIT 4', $CategoryID, $ProductID);
    }

    public function CountAvg(int $ProductID)
    {
        $NewAvg = (int)$this -> Database -> QSelectOneValue('SELECT CEILING(AVG(CommentRatedStar)) FROM `Comments` WHERE CommentOnProductID = ?', $ProductID);
        return $this -> Database -> QExecute("UPDATE Products SET ProductRateAvg = ? WHERE ProductID = ?", $NewAvg, $ProductID);
    }

    public function TotalPerStar(int $Star, int $ProductID)
    {
        return $this -> Database -> QSelectOneValue("SELECT COUNT(CommentRatedStar) FROM Products, Comments WHERE ProductID = CommentOnProductID AND ProductID = ? AND CommentRatedStar = ?", $ProductID, $Star);
    }
}