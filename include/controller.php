<?php

// Включим отображение всех ошибок
error_reporting(E_ALL);

include_once $_SERVER['DOCUMENT_ROOT'] . "/include/main_menu.php";

/**
* Функция выводит меню разделов
*
* @param array $menu - массив, содержащий пункты меню
* @param string $cssClass - класс, определяющий внешний вид пунктов меню
* @param int $sortType - тип сортировки SORT_ASC|SORT_DESC, по умолчанию SORT_ASC
*/
function showMenu(array $menu, string $cssClass, int $sortType = SORT_ASC)
{
    $menu = arraySort($menu, $sortType);
    require ($_SERVER['DOCUMENT_ROOT'] . '/template/menu.php');
}

/**
* Функция сортирует массивы
*
* @param array $array - массив для сортировки
* @param int $sort - тип сортировки SORT_ASC|SORT_DESC, по умолчанию SORT_ASC
* @param string $key - ключ, по которому осуществляется сортировка
* @return array $array - отсортированный массив
*/
function arraySort(array $array, int $sort = SORT_ASC, string $key = 'sort') : array
{
    usort($array, function($a, $b) use ($sort, $key) {return $sort === SORT_DESC ? $b[$key] <=> $a[$key] : $a[$key] <=> $b[$key];});
    return $array;
}

/**
* Функция, если нужно, обрезает длину строки до X символов,
* если она длинне Y символов, и добавляет в конец (...)
*
* @param string $inputString - строка для проверки её длины и обрезки при необходимости
* @param int $newStringLength - кол-во символов в строке после обрезки, по умолчанию 12 (см. config.php)
* @param int $cutPoint - задает макс. длину строки без обрезки, по умолчанию 15 (см. config.php)
* @return string - изменённая или неизменённа строка
*/
function cutThisString(string $inputString, int $newStringLength = 12, int $cutPoint = 15) : string
{
    if (mb_strlen($inputString) > $cutPoint) {
        return mb_substr($inputString, 0, $newStringLength) . '...';
    }
    return $inputString;
}

/**
* Функция выводит названия разделов*
* @param array $menu - массив, содержащий названия разделов
*/
function getTitle(array $menu)
{
    foreach ($menu as $value) {
        if (checkUrl($value['path'])) {
            return $value['title'];
        }
    }
}

/**
* Функция возвращает наименование класса (css-стиля) для раздела меню,
* в котором сейчас находится пользователь
* @param $path - путь к разделу меню
*/
function getMenuClass(string $path)
{
    if (checkUrl($path)){
        return "menu-active";
    }
}

/**
* Функция проверяет совпадения url и значения 'path' из массива с элементами меню
*/
function checkUrl(string $url)
{
    return $url == parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}