-- Initialize Database

-- create tables
create table admin(
 loginname varchar(16) primary key,
 passwd varchar(40) not null,
 email varchar(80) not null,
 fname varchar(80),
 name varchar(80),
 comment text
);

create table status(
 statusid int primary key,
 status varchar(16),
 description varchar(80),
 color varchar(16),
 colordef varchar(16)
);

create table product (
 productid serial primary key,
 product varchar(80),
 supplier varchar(80),
 description text
);

create table version (
 versionid serial primary key,
 productid int references product(productid),
 version varchar(32),
 costs_initial decimal(10,2),
 costs_fix decimal(10,2),
 costs_bytime decimal(10,2),
 costs_timeframe int,
 supported boolean,
 comment text
);

create table license (
 licenseid bigserial primary key,
 versionid int references version(versionid),
 project varchar(80),
 adminid varchar(16) references admin(loginname),
 statusid int references status(statusid),
 possessor varchar(80),
 licensenumber varchar(80),
 expiration date,
 comment text
);



-- Stati

insert into status values(
 0, 'spare',
 'can be requested by someone else',
 'green', '#00ff00');

insert into status values(
 1,'used',
 'currently used',
 'yellow','#c0ffc0');

insert into status values(
 2,'need',
 'used but no valid license, needs one',
 'red','#ff0000');

insert into status values(
 3,'pending',
 'used but no valid license, license ordered',
 'orange','#ffc000');

insert into status values(
 4,'upgrading',
 'on transition to another version',
 'blue','#0000ff');

insert into status values(
 5,'in transfer',
 'box is in transfer to another user',
 'blue','#0000ff');

insert into status values(
 20,'FS/OSS',
 'Free Software / Open Source',
 'black','#000000');

insert into status values(
 30,'for free',
 'commercial software free of licensing costs',
 'black','#000000');



-- default user: hello, password: wall

insert into admin(loginname,passwd,email)values(
 'hello',
 'a a1a3165eaa8cb51381b918cdbce7a31f',
 'noemail');


-- set privileges for calm user

grant all privileges on status,admin,product,version,license to calm;

grant all privileges on license_licenseid_seq,product_productid_seq,
version_versionid_seq to calm;
