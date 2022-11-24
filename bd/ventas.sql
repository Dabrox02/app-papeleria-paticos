CREATE DATABASE ventas;
USE ventas;

CREATE TABLE usuarios(
    id_usuario int auto_increment,
    nom_user varchar(50),
    ape_user varchar(50),
    email_user varchar(50),
    pass_user varchar(50),
    fechaCaptura date,
    primary key(id_usuario)
);

CREATE TABLE categorias(
    id_categoria int auto_increment,
    id_usuario int not null,
    nombre_categoria varchar(150),
    fechaCaptura date,
    primary key(id_categoria)
);

CREATE TABLE imagenes(
    id_imagen int auto_increment,
    id_categoria int not null,
    nom_img varchar(500),
    ruta varchar(500),
    fechaSubida date,
    primary key(id_imagen)
);

CREATE TABLE productos(
    id_producto int auto_increment,
    id_categoria int not null,
    id_imagen int not null,
    id_usuario int not null,
    nom_producto varchar(50),
    descripcion varchar(500),
    cantidad int,
    precio float,
    fechaCaptura date,
    primary key(id_producto)
);

CREATE TABLE clientes(
    id_cliente int auto_increment,
    id_usuario int not null,
    nom_cli varchar(200),
    ape_cli varchar(200),
    direccion varchar(200),
    email_cli varchar(200),
    tel_cli varchar(50),
    rfc varchar(200),
    primary key(id_cliente)
);

CREATE TABLE ventas(
    id_venta int not null,
    id_cliente int,
    id_producto int,
    id_usuario int,
    precio float,
    fechaCompra date
);