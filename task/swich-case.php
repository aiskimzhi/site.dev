<?php
/**
 * Создать переменную $day и присвоить ей произвольное значение
 * вывести фразу "Это рабочий день", если значение $day попадает в диапазон от 1 до 5
 * Вывести фразу "Это выходной", если значение 6 или 7
 * Вывести фразу "Неизвестный день", если значение не попадает в указанные диапазоны
 */

$day = 8;

switch ($day) {
    case $day >= 1 && $day <= 5:
        echo 'Это рабочий день';
        break;
    case $day == 6 || $day == 7:
        echo 'Это выходной';
        break;
    default:
        echo 'Неизвестный день';
}