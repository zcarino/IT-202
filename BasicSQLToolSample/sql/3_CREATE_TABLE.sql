CREATE TABLE IF NOT EXISTS 'Roles' (
'id' int auto_increment not null,
'role_id' int not null,
'user_id' int not null,
'date_created' timestamp not null default 
current_time,
'date_modified' timestamp not null default
current_time on update current_time,
'is_active' boolean default 1,
PRIMARY KEY ('id')
) CHARACTER SET utf8 COLLATE utf8_general