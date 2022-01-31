<?php
    require_once "./config.php";
    $c = new mysqli(IPADDRESS, USERNAME, PASSWORD, "", PORTNO);
    $c->multi_query("
        CREATE DATABASE invoicedb;
        USE invoicedb;
        CREATE TABLE admin(
            adminid int PRIMARY KEY auto_increment,
            username varchar(20) NOT NULL unique,
            password varchar(20) NOT NULL
        );
        INSERT INTO admin(username, password) VALUES('admin', '123');
        CREATE TABLE login(
            loginid int PRIMARY KEY auto_increment,
            ipaddress varchar(20) NOT NULL,
            attemptcount int NOT NULL DEFAULT 1,
            lastlogin datetime NOT NULL
        );
        CREATE TABLE clients(
            clientID int PRIMARY KEY auto_increment,
            name varchar(50) NOT NULL,
            email varchar(50) NOT NULL,
            company varchar(20) ,
            address varchar(100) NOT NULL,
            phone varchar(15) NOT NULL
        );
         CREATE TABLE item(
            itemID int PRIMARY KEY auto_increment,
            itemName varchar(200) NOT NULL,
            price int(10) NOT NULL
        );
         CREATE TABLE invoice(
            No int PRIMARY KEY auto_increment,
            invoiceID int  NOT NULL,
            date date NOT NULL,
            quantity int(20) NOT NULL,
            price int (30) NOT NULL,
            amount int (20) NOT NULL,

            clientID int NOT NULL,
            itemID int NOT NULL,
            itemName varchar(200) NOT NULL,
           
            staffName varchar(200) NOT NULL,
        
            FOREIGN KEY(clientID) REFERENCES clients(clientID),
            FOREIGN KEY(staffName) REFERENCES staff(staffName),
            
            FOREIGN KEY(itemID) REFERENCES item(itemID)

         ) ENGINE=INNODB;

         CREATE TABLE staff(
           
            staffName varchar(200) PRIMARY KEY  NOT NULL,
            phoneNo int(20) NOT NULL
        );
                      
    ");
    $c->close();
    
