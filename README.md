# Sumarry
Nisam koristio nijedan framework. Koristio sam cist PHP v7.4.
Pratio sam PSR2 code-style. Nadam se da sam ga ispratio skroz, prvi put sam ga koristio.
U subotu uvece mi je sinulo da radim sve pogresno, pa sam tu celu noc pisao i smisljao sve ispocetka. Koristio sam cURL da kontaktiram API i da uzmem odredjene podatke nazad. Ovaj projekat me je odgurnuo iz comfor zone totalno. Za ovaj kod nije trebalo puno vremena, ali za prethodni koji je bio pogresan mi je trebala cela nedelja. Sve je testirano, sve bi trebalo da radi :)
# Properties
Properties stranicu nisam uradio. Nisam znao kako da uradim tu stranicu iako sam upoznat za CRUD operacijama. Uradjen je request na get properties, i outputovao sam jedan title. JSON Decodovao sam response, stavio ga u array i dalje nisam znao kako da handleujem sa njim. Kako da ga listujem, i kako da ga koristim.
# Rewrite Rules
```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^([^\.]+)$ reset.php?token=$1&email=$2 [QSA]
```

Ovaj rewrite rule radi. Prethodni rewrite rule je strip outovao email $_GET value. Modifikovao sam ga da ne bi cinio tu gresku.
Lokacija .htaccess fajla gde bi trebao ovaj rewrite rule da se stavi je u folderu reset-password, pored reset.php fajla.

