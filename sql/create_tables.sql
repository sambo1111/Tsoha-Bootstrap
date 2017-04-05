CREATE TABLE Band(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  description varchar(400),
  founded DATE
);

CREATE TABLE Album(
  id SERIAL PRIMARY KEY,
  band_id INTEGER REFERENCES Band(id),
  name varchar(50) NOT NULL,
  release_date DATE,
  description varchar(500)
);

CREATE TABLE BandMember(
  id SERIAL PRIMARY KEY,
  band_id INTEGER REFERENCES Band(id),
  name varchar(50) NOT NULL,
  description varchar(400)
);

CREATE TABLE Track(
  id SERIAL PRIMARY KEY,
  album_id INTEGER REFERENCES Album(id),
  name varchar(50) NOT NULL,
  track_length INTEGER
 );

CREATE TABLE AppUser(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  password varchar(50) NOT NULL
 );

CREATE TABLE UserAlbum(
  id SERIAL PRIMARY KEY,
  user_id INTEGER REFERENCES AppUser(id),
  album_id INTEGER REFERENCES Album(id)
 );