CREATE TABLE IF NOT EXISTS product
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL comment 'UUID товара',
    product_name VARCHAR(255) NOT NULL comment 'Название товара',
    category_id INT NOT NULL comment 'Категория товара',
    is_active TINYINT(1) DEFAULT 1 NOT NULL comment 'Флаг активности',
    description TEXT comment 'Описание товара',
    thumbnail VARCHAR(255) comment 'Ссылка на картинку',
    price FLOAT NOT NULL comment 'Цена',
    FOREIGN KEY (category_id) REFERENCES category(id)
)
comment 'Товары';

CREATE TABLE IF NOT EXISTS category
(
   id INT AUTO_INCREMENT PRIMARY KEY,
   category_system_name VARCHAR(255) NOT NULL UNIQUE comment 'Системное имя категории'
   category_name VARCHAR(255) NOT NULL comment 'Название категории'
)
comment 'Категории товаров';

CREATE INDEX product_is_active_idx ON product (is_active);
CREATE INDEX product_category_id_idx ON product (category_id);

-- create table if not exists products
-- (
--     id int auto_increment primary key,
--     uuid  varchar(255) not null comment 'UUID товара',
--     category  varchar(255) not null comment 'Категория товара',
--     is_active tinyint default 1  not null comment 'Флаг активности',
--     name text default '' not null comment 'Тип услуги',
--     description text null comment 'Описание товара',
--     thumbnail  varchar(255) null comment 'Ссылка на картинку',
--     price float not null comment 'Цена'
--     )
--     comment 'Товары';
--
-- create index is_active_idx on products (is_active);

