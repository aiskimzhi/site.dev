<?php
/**
 * Простой пример реализации паттерна Singleton
 *
 * @name SingletonTest
 * @author Andrew Vasiliev (illusive [at] meta [dot] ua)
 */
class SingletonTest
{
    /**
     * Статическая переменная, в которой мы
     * будем хранить экземпляр класса
     *
     * @var SingletonTest
     */
    protected static $_instance;
 
    /**
     * Закрываем доступ к функции вне класса.
     * Паттерн Singleton не допускает вызов
     * этой функции вне класса
     *
     */
    private function __construct(){
        /**
         * При этом в функцию можно вписать
         * свой код инициализации. Также можно
         * использовать деструктор класса.
         * Эти функции работают по прежднему,
         * только не доступны вне класса
         */
    }
 
    /**
     * Закрываем доступ к функции вне класса.
     * Паттерн Singleton не допускает вызов
     * этой функции вне класса
     *
     */
    private function __clone(){
    }
    /**
     * Статическая функция, которая возвращает
     * экземпляр класса или создает новый при
     * необходимости
     *
     * @return SingletonTest
     */
    public static function getInstance() {
        // проверяем актуальность экземпляра
        if (null === self::$_instance) {
            // создаем новый экземпляр
            self::$_instance = new self();
        }
        // возвращаем созданный или существующий экземпляр
        return self::$_instance;
    }
}