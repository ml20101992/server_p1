use mxl3773;

insert into server_sport(name) VALUES ('Soccer'),('Basketball');

insert into server_season(year,description) VALUES ('2018','The season to end all seasons');

insert into server_league(name) VALUES('The Ultimate League');

insert into server_slseason VALUES (1,1,1);



insert into server_position(name) VALUES
('Goal Keeper'),('Defender'),('Midfield'),('Attacker');

insert into server_team(name,mascot,sport,league,season,picture,homecolor,awaycolor,maxplayers) VALUES
('Team Rocket','Red Rocket',1,1,1,'rocket.png','red','white',15),
('Team Aqua','Blue Catfish',1,1,1,'aqua.png','blue','cyan',15);

insert into server_player(firstname,lastname,dateofbirth,jerseynumber,team) VALUES
('Jessie','Rocket', '1990-1-1',69,1),
('James','Rocket','1990-2-1',96,1);

