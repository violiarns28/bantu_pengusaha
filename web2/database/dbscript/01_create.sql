CREATE TABLE beone_menu (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  nama varchar(50) NOT NULL,
  route_menu varchar(50) NOT NULL,
  parent_id integer NOT NULL,
  icon varchar(255) DEFAULT NULL,
  PRIMARY KEY (id),
);

CREATE TABLE beone_group (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  nama varchar(50) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY groups_nama_unique (nama)
);


CREATE TABLE beone_access (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  nama varchar(50) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY accesses_nama_unique (nama)
);

CREATE TABLE beone_menu_access (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  access_id int(11) NOT NULL,
  menu_id int(11) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE beone_group_access (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  group_id int(11) NOT NULL,
  menu_id int(11) NOT NULL,
  access_id int(11) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
);
