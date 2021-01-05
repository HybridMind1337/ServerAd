<?php

/**
 *
 * @class Pagination
 * @created 16.12.2020 г.
 *
 * @author HybridMind
 * @email support@webocean.info
 * @discord HybridMind#6095
 *
 */

class Pagination
{
    protected $per_page;
    protected $nav_limit;
    protected $values;
    protected $link;
    public function __construct($perPage, $navLimit, $data, $link)
    {
        $this->per_page = $perPage;
        // Колко страници да се показват максимално в менюто, като 1 е винаги там.
        // Пример: Ако въведеш 3 ще се показват от 1 до 4.
        $this->nav_limit = $navLimit;
        $this->values = $data;
        $this->link = $link;
    }

    public function page()
    {

        $total_values = count($this->values);

        if (isset($_GET['page'])) {
            $current_page = $_GET['page'];
        } else {
            $current_page = 1;
        }
        $counts = ceil($total_values / $this->per_page);
        $param1 = ($current_page - 1) * $this->per_page;
        $this->data = array_slice($this->values, $param1, $this->per_page);

        for ($x = 1; $x <= $counts; $x++) {
            $numbers[] = $x;
        }

        return $numbers;
    }

    public function fetchResult()
    {
        $this->page();
        $resultsValues = $this->data;
        return $resultsValues;
    }

    public function showPagination()
    {
        $total_values = count($this->values);

        if (isset($_GET['page'])) {
            $current_page = $_GET['page'];
        } else {
            $current_page = 1;
        }
        $counts = ceil($total_values / $this->per_page);
        $param1 = ($current_page - 1) * $this->per_page;

        return $this->getPagination($current_page, $counts, $this->per_page);
    }

    public function getPagination($page, $total_pages)
    {
        $link = $this->link;
        //show page
        if ($total_pages == 0) {
            return 'Page 0 of 0';
        } else {
            $nav_page = "<nav>";
            $nav_page .= '<ul class="pagination justify-content-center pt-2">';
            // Колко страници да се показват
            // от ляво и дясно от активната страница.
            $limit_nav = $this->nav_limit;
            $start = ($page - $limit_nav <= 0) ? 1 : $page - $limit_nav;
            $end = $page + $limit_nav > $total_pages ? $total_pages : $page + $limit_nav;
            if ($page + $limit_nav >= $total_pages && $total_pages > $limit_nav * 2) {
                $start = $total_pages - $limit_nav * 2;
            }
            if ($page > 2) { //Показване на първата страница.
                $nav_page .= '<a class="page-link bg-info text-white" href="' . sprintf($link, 1) . '">1</a>';
            }
            if ($page > 2) { //Добавяне на точки след между първата страница и бутона за назад.
                $nav_page .= '<li class="page-item ml-1 mr-1"></li>';
            }
            if ($page > 1) { //Добавяне на бутон за предишна страница.
                $nav_page .= '<a class="page-link" href="' . sprintf($link, $page - 1) . '"><i class="fas fa-caret-left"></i></a>';
            }
            for ($i = $start; $i <= $end; $i++) {
                if ($page == $i) {
                    // Текуща страница.
                    $nav_page .= '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
                } else {
                    $nav_page .= '<li class="page-item"><a class="page-link" href="' . sprintf($link, $i) . '">' . $i . '</a></li>';
                }
            }
            // Добавяне на следващият бутон
            // и скривае когато текущата страница е страницата
            if ($page < $total_pages) {
                $nav_page .= '<a class="page-link" href="' . sprintf($link, $page + 1) . '"><i class="fas fa-caret-right"></i></a>';
            }

            // Добавяне на а
            if ($end + 1 < $total_pages) {
                $nav_page .= '<li class="page-item ml-1 mr-1"></li>';
            }
            if ($end != $total_pages) //show last page
                $nav_page .= '<a class="page-link bg-info text-white" href="' . sprintf($link, $total_pages) . '">' . $total_pages . '</a>';
            $nav_page .= "</ul>";
            $nav_page .= "</nav>";

            return $nav_page;
        }
    }
}