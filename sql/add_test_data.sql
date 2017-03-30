INSERT INTO Band (name, description, founded, added) VALUES ('Kool & The Gang', 'Nice band','1975-11-11', NOW());
INSERT INTO Album (name, band_id, release_date, added, description) VALUES ('Light of Worlds', 1, '1981-11-11', NOW(), 'Nice album');
INSERT INTO BandMember(band_id, name, description, added) VALUES(1, 'Robert Bell', 'Bass player', NOW());
INSERT INTO Track(album_id, name, length) VALUES(1, 'Summer madness', 400);
INSERT INTO AppUser(name, password) VALUES('bestuser', 'salainen');
INSERT INTO UserAlbum(user_id, album_id) VALUES(1,1);