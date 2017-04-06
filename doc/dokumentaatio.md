# Musiikkitietokanta

## 1. Johdanto
Harjoitustyöni aihe on musiikkitietokanta, johon tallennetaan albumeiden,
muusikoiden ja kappaleiden tietoja, joita käyttäjät voivat tarkastella. Käyttäjät voivat
myös luoda oman albumikokoelmansa sekä tarkastella muiden käyttäjien kokoelmia

## 2. Käynnistys -ja käyttöohje
Sovellukseen pääsee tästä [linkistä](http://hasasami.users.cs.helsinki.fi/musiikkitietokanta/).
Kirjautuminen onnistuu käyttäjätunnuksella "bestuser" ja salasanalla "salainen".
Onnistuneen kirjautumisen jälkeen sovelluksen oikeaan ylälaitaan ilmestyy linkki tällä hetkellä kirjautuneena olevan käyttäjän esittelysivulle.

Yhtyeitä voi tarkastella sivulta "Yhtyeet", jossa voi lisätä uusia yhtyeitä tai siirtyä jonkun tietokannassa olevan yhtyeen esittelysivulle.

Yhtyeen esittelysivulla voi muokata tai poistaa yhtyeen tietoja.

Albumien sivulle pääsee linkistä Albumit, jossa on lista tietokannassa olevista albumeista. Albumin esittelysivulle pääsee painamalla albumin nimeä. Sivulla on myös linkit albumien yhtyeiden sivuille jokaista albumia kohti.

## 3. Käsitekaavio

![alt text](https://github.com/sambo1111/Tsoha-Bootstrap/blob/master/doc/kaavio.jpg)

## 4. Käyttötapauskaavio

![alt text](https://github.com/sambo1111/Tsoha-Bootstrap/blob/master/doc/K%C3%A4ytt%C3%B6tapauskaavio.jpg)

## 5. Käyttäjäryhmät

### Admin
Sovelluksen ylläpitäjä, jonka tehtäviin kuuluu tietokannan ylläpito eli datan lisäys, poisto ja muokkaus.

### Rekisteröitymätön käyttäjä
Käyttäjä, joka ei ole vielä rekisteröitynyt sovellukseen.

### Rekisteröitynyt käyttäjä
Käyttäjä, joka on rekisteröitynyt sovellukseen.

## 6. Käyttötapaukset

### Admin
- Albumien, muusikoiden, kappaleiden ja yhtyeiden lisäys, poisto ja muokkaus

### Kuka tahansa
- Albumien, muusikoiden, kappaleiden ja yhtyeiden tarkasteleminen
- Rekisteröityminen sovellukseen

### Rekisteröitynyt käyttäjä
- Sisään- ja uloskirjautuminen
- Muiden käyttäjien tietojen tarkasteleminen
- Oman albumilistan luominen tietokannassa olevista albumeista
- Albumien, muusikoiden, kappaleiden ja yhtyeiden tarkastelu

## 7. Relaatiokaavio

![alt text](https://github.com/sambo1111/Tsoha-Bootstrap/blob/master/doc/TSOHA_RELAATIOKAAVIO.jpg)

## 8. Järjestelmän tietosisältö

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

