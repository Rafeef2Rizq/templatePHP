CREATE TABLE if not exists users(
id bigint(20) unsigned not null auto_increment,
email varchar(255) not null,
password varchar(255) not null,
age tinyint(3)  unsigned not null,
country varchar(255) not null,
social_media_url varchar(255) not null,
created_at datetime not null default current_timestamp(),
updated_at datetime not null default current_timestamp(),
primary key(id),
unique key(email)
);