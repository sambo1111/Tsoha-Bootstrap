# Musiikkitietokanta

Harjoitustyöni aihe on musiikkitietokanta, johon tallennetaan albumeiden,
muusikoiden ja kappaleiden tietoja, joita käyttäjät voivat tarkastella. Käyttäjät voivat
myös luoda oman albumikokoelmansa sekä tarkastella muiden käyttäjien kokoelmia

## Käyttötapaukset

- Albumeiden, kappaleiden ja artistien/yhtyeiden tietojen lisääminen kantaan (CRUD näille)
- Ylläolevien tarkastelu
- Käyttäjän sisäänkirjautuminen
- Oman kokoelman tekeminen

## Relaatiokaavio

![alt text](https://github.com/sambo1111/Tsoha-Bootstrap/blob/master/doc/TSOHA_RELAATIOKAAVIO.jpg)

## Järjestelmän tietosisältö

### Band
|Attribuutti|Arvojoukko|Kuvailu|
|-----------|----------|-------------------------------------------------|
|name|merkkijono max.50|triviaali|
|description|merkkijono max.400|yhtyeen kuvaus|
|founded|päivämäärä|perustamisvuosi|
|added|päivämäärä|milloin lisätty kantaan|

### Album
|Attribuutti|Arvojoukko|Kuvailu|
|-----------|----------|-------------------------------------------------|
|band_id|kokonaisluku|foreign key bandiin|
|name|merkkijono max.50|triviaali|
|release_date|päivämäärä|milloin albumi on julkaistu|
|added|päivämäärä|milloin lisätty kantaan|
|description|merkkijono max.500|albumin kuvaus|

### BandMember
|Attribuutti|Arvojoukko|Kuvailu|
|-----------|----------|-------------------------------------------------|
|band_id|kokonaisluku|foreign key bandiin|
|name|merkkijono max.50|triviaali|
|description|merkkijono max.400|muusikon kuvaus|
|added|päivämäärä|milloin lisätty kantaan|

### Track
|Attribuutti|Arvojoukko|Kuvailu|
|-----------|----------|-------------------------------------------------|
|album_id|kokonaisluku|foreign key albumiin|
|name|merkkijono max.50|triviaali|
|description|merkkijono max.400|kappaleen kuvaus|
|added|päivämäärä|milloin lisätty kantaan|
|length|kokonaisluku|kappaleen pituus sekunteina|

### AppUser
|Attribuutti|Arvojoukko|Kuvailu|
|-----------|----------|-------------------------------------------------|
|username|merkkijono max.50|käyttäjätunnus|
|password|merkkijono max.50|salasana|

### UserAlbum
|Attribuutti|Arvojoukko|Kuvailu|
|-----------|----------|-------------------------------------------------|
|user_id|kokonaisluku|foreign key useriin|
|album_id|kokonaisluku|foreign key albumiin|

