INSERT INTO Band (name, description, founded) VALUES ('Kool & The Gang', 'Nice band','1975-11-11');
INSERT INTO Album (name, band_id, release_date, description) VALUES ('Light of Worlds', 1, '1981-11-11', 'Nice album');
INSERT INTO BandMember(band_id, name, description) VALUES(1, 'Robert Bell', 'Bass player');
INSERT INTO Track(album_id, name, track_length) VALUES(1, 'Summer madness', 400);
INSERT INTO AppUser(name, password) VALUES('bestuser', 'salainen');
INSERT INTO UserAlbum(user_id, album_id) VALUES(1,1);