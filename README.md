### Техническое задание:

Разработать API (формат на ваше усмотрение) для Frontend команды. API предусматривает следующие операции:

- Получение списка автомобилей, у для каждого автомобиля должны быть следующие данные: бренд, модель, изображение, цена

- Расчет кредита по указанным параметрам из формы: цена автомобиля, первоначальный взнос, готов платить в месяц, срок
  кредита. Алгоритм расчета кредитных на Ваше усмотрение. Например, если первоначальный взнос более 200000 р., платеж в
  месяц до 10000 р., срок кредита менее 5 лет – выводить программу с процентной ставкой "от 12.3%", платеж в месяц от
  9800 р., иначе любую другую программу. Для кредитной программы должны быть следующие данные: сумма выплат, процентная
  ставка, платеж в месяц.

- Сохранение заявки. В заявке должна быть информация: автомобиль, все указанные параметры кредита, кредитная программа,
  дата создания заявки. При отправке должна выполняться валидация всех данных (все поля не должны быть пустыми, поля
  первоначальный взнос, готов платить в месяц, срок кредита, сумма выплат, платеж в месяц должны быть целыми числами,
  поле процентная ставка должна быть числом с плавающей точкой с точностью до десятых долей).

### Описание

- Присутствует docker-compose.
- Присутствует postman проект.
- Присутствует минимальный набор фикстур для отработки требуемых endpoints.
- Кредитные программы реализованы без настройки через БД, так как не было ТЗ.
- CRUD не реализован, так как не было ТЗ.
