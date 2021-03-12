Существуют опросы.
Существуют разовые лицензии. 
К опросу можно применять сколько угодно разовых лицензий, активации записываются в таблицу LICENSE_ACTIVATIONS.
Лицензия даёт 60 дней работы опроса, если лицензия применена пока еще действует старая - тогда количество дней суммируется.
Нужно исходя из данных таблицы LICENSE_ACTIVATIONS рассчитать дату окончания лицензии для конкретного опроса.

Пример:
2020-01-01 было применено 6 лицензий (каждая по 60 дней) - дата станет 2020-12-26.
Если мы к этому опросу применим еще одну лицензию:
Например, если 2020-12-20, тогда дата станет 2020-12-25 + 60 дней.
Например, если 2020-12-28, тогда дата станет 2020-12-28 + 60 дней.
Задание на логику, здесь не нужно писать полноценное приложение - можно даже все в 1 функцию уместить.

create table LICENSE_ACTIVATIONS
(
    USER_LICENSE_ID int                                 not null,
    ACTIVATION_DATE timestamp default CURRENT_TIMESTAMP not null,
    TYPE            int                                 not null,
    TO_OBJECT       int                                 null,
    PARAM           varchar(255)                        null,
)
    charset = utf8;

INSERT INTO LICENSE_ACTIVATIONS (USER_LICENSE_ID, ACTIVATION_DATE, TYPE, TO_OBJECT, PARAM) VALUES (217, '2019-11-16 16:36:52', 1, 1100, null);
INSERT INTO LICENSE_ACTIVATIONS (USER_LICENSE_ID, ACTIVATION_DATE, TYPE, TO_OBJECT, PARAM) VALUES (217, '2020-11-19 07:37:04', 1, 1179, null);
INSERT INTO LICENSE_ACTIVATIONS (USER_LICENSE_ID, ACTIVATION_DATE, TYPE, TO_OBJECT, PARAM) VALUES (217, '2020-11-19 07:44:05', 1, 1179, null);
INSERT INTO LICENSE_ACTIVATIONS (USER_LICENSE_ID, ACTIVATION_DATE, TYPE, TO_OBJECT, PARAM) VALUES (217, '2019-11-19 08:07:47', 1, 1173, null);
INSERT INTO LICENSE_ACTIVATIONS (USER_LICENSE_ID, ACTIVATION_DATE, TYPE, TO_OBJECT, PARAM) VALUES (217, '2020-11-19 08:08:31', 1, 1173, null);

// Значения из таблицы

    [0] => 1573940212
    [1] => 1605789424
    [2] => 1605789845
    [3] => 1574168867
    [4] => 1605791311


// Добавленные значения

    [0] => 1579124212
    [1] => 1610973424
    [2] => 1610973845
    [3] => 1579352867
    [4] => 1610975311

// Результат

Array
(
    [0] => 26665212 // - правильный
    [1] => -5183579
    [2] => -36804978
    [3] => 26438444
)

2020-03-18 16:33:33 < 2020-01-15 16:36:52 === false


