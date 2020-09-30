<?php


namespace Core;

class Core
{
    public function LogFile($ErrorMess, $Function, $Variable)
    {
        $Name = date('d-m-Y');
        $Error = @fopen(Config::DocumentRoot . '/Admin/Log/' . $Name . '.txt', 'a+');
        @fwrite($Error, PHP_EOL . '--------------' . PHP_EOL);
        @fwrite($Error, 'Error Date: ' . (print_r(date('d-m-Y h:i:s'), true)) . PHP_EOL);
        @fwrite($Error, 'Error In: ' . (print_r($Function, true)) . PHP_EOL);
        @fwrite($Error, 'Error Message: ' . (print_r($ErrorMess, true)) . PHP_EOL);
        @fwrite($Error, 'Variable JSON: ' . (print_r($Variable, true)));
        @fclose($Error);
    }

    public function ReturnDate(int $Timestamp, bool $WithTime = false)
    {
        return ($WithTime === true ? gmdate('d-m-Y H:m:s', $Timestamp) : gmdate('d-m-Y', $Timestamp));
    }

    public function RemoveArrayByValue($Array, $Key, $Value)
    {
        foreach ($Array as $ArrayInfo)
        {
            if ($ArrayInfo[$Key] == $Value)
            {
                unset($Array[$ArrayInfo]);
            }
        }
        return $Array;
    }

    /**
     * Pagination function.
     * @param int $TotalProduct Total product in with or without category.
     * @param int $CurrentPage User current in page.
     * @return string Paged HTML format.
     */
    public function Page (int $TotalProduct, int $CurrentPage)
    {
        $LimitPage = 5;

        $PagedHTML = '';

        $CurrentQuery = $_GET;

        $NextQuery = $_GET;
        $PrevQuery = $_GET;

        $LastQuery = $_GET;
        $FirstQuery = $_GET;

        $IsLastButtonHidden = '';
        $IsNextButtonHidden = '';

        $IsFirstButtonHidden = '';
        $IsPreviousButtonHidden = '';

        $TotalPage = ceil($TotalProduct / Config::ProductPerPage);

        if($CurrentPage === 1)
        {
            $IsFirstButtonHidden = 'hidden';
            $IsPreviousButtonHidden = 'hidden';
        }

        if ((int) $CurrentPage === (int) $TotalPage)
        {
            $IsLastButtonHidden = 'hidden';
            $IsNextButtonHidden = 'hidden';
        }

        $NextQuery['Page'] = $CurrentPage + 1;
        $LastQuery['Page'] = $TotalPage;


        $NextButton = '<li class="'.$IsNextButtonHidden.'"><a href="?'.http_build_query($NextQuery).'">></a></li>';
        $LastButton = '<li class="'.$IsLastButtonHidden.'"><a href="?'.http_build_query($LastQuery).'">>|</a></li>';

        $PrevQuery['Page'] = $CurrentPage - 1;
        $FirstQuery['Page'] = 1;

        $PreviousButton = '<li class="'.$IsFirstButtonHidden.'"><a href="?'.http_build_query($PrevQuery).'"><</a></li>';
        $FirstButton = '<li class="'.$IsPreviousButtonHidden.'"><a href="?'.http_build_query($FirstQuery).'">|<</a></li>';

        $PagedHTML .= $FirstButton.$PreviousButton;

        if ($CurrentPage <= $TotalPage && $TotalPage >= 1)
        {
            $PageBreak = 1;

            if ($CurrentPage > ($LimitPage / 2))
            {
                $CurrentQuery['Page'] = 1;

                $PagedHTML .= '<li><a href="?'.http_build_query($CurrentQuery).'">1</a></li>';
                $PagedHTML .= '<li><a>...</a></li>';
            }

            $Loop = $CurrentPage;

            while ($Loop <= $TotalPage)
            {
                if ($PageBreak < $LimitPage)
                {
                    $CurrentQuery['Page'] = $Loop;

                    if ($CurrentPage === $Loop)
                    {
                        $PagedHTML .= '<li class="active"><a href="?'.http_build_query($CurrentQuery).'">'.$Loop.'</a></li>';
                    } else $PagedHTML .= '<li><a href="?'.http_build_query($CurrentQuery).'">'.$Loop.'</a></li>';
                }

                $PageBreak++;
                $Loop++;
            }

            if ($CurrentPage < ($TotalPage - ($LimitPage / 2)))
            {
                $CurrentQuery['Page'] = $TotalPage;

                $PagedHTML .= '<li><a href="?'.http_build_query($CurrentQuery).'">...</a></li>';
                $PagedHTML .= '<li><a href="?'.http_build_query($CurrentQuery).'">'.$TotalPage.'</a></li>';
            }
        }

        return $PagedHTML.$NextButton.$LastButton;
    }

    public function MakeCleanText(string $String)
    {
        /**
        $String = str_replace("`", "", $String);
        $String = str_replace("~", "", $String);
        $String = str_replace("!", "", $String);
        $String = str_replace("@", "", $String);
        $String = str_replace("#", "", $String);
        $String = str_replace("$", "", $String);
        $String = str_replace("%", "", $String);
        $String = str_replace("%", "", $String);
        $String = str_replace("^", "", $String);
        $String = str_replace("&", "", $String);
        $String = str_replace("*", "", $String);
        $String = str_replace("(", "", $String);
        $String = str_replace(")", "", $String);
        $String = str_replace("-", "", $String);
        $String = str_replace("_", "", $String);
        $String = str_replace("+", "", $String);
        $String = str_replace("=", "", $String);
        $String = str_replace("[", "", $String);
        $String = str_replace("]", "", $String);
        $String = str_replace(";", "", $String);
        $String = str_replace(":", "", $String);
        $String = str_replace('"', "", $String);
        $String = str_replace("/", "", $String);
        $String = str_replace(".", "", $String);
        $String = str_replace(",", "", $String);
        $String = str_replace("<", "", $String);
        $String = str_replace(">", "", $String);
        $String = str_replace("?", "", $String);
         **/
        return preg_replace('/[^\s\p{L}]/u','',$String);
    }

    public function TokenCreator
    (
        int $KeyLength = 64,
        string $KeySpace = "ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ234567890"
    )
    {
        if ($KeyLength < 1) throw new \RangeException("Length must be a positive integer");

        $Token = [];

        $MinLoop = 0;
        $MaxLoop = mb_strlen($KeySpace, '8bit') - 1;

        while ($MinLoop < $KeyLength)
        {
            ReWhile:
            try {
                $Token[] = $KeySpace[random_int(0, $MaxLoop)];
            }
            catch (\Exception $Error)
            {
                self::LogFile($Error -> getMessage(), 'Token Creator', get_defined_vars());
            }

            if ($Token[$MinLoop] === NULL) goto ReWhile;

            $MinLoop++;
        }

        return implode('', $Token);
    }

}