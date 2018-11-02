30/10
16:00

Rewrite van het marktplaats project naar OOP. Voor zover ik heb gezien en getest is alles correct aangepast naar OOP stijl, alles is in ieder geval werkend.
Database export file toegevoegd aan push voor testdoeleinden.

------------------

31/10 09:50
Review van toevoegingen marktplaatsproject voor vandaag:

De meest relevante toevoeging aan het project is nu de mogelijkheid voor gebruikers om advertenties te plaatsen.
Hiervoor is nodig:

Een tabel in de database met de advertenties met op z'n minst een naam van het item, de prijs en de foreign key van de plaatsende gebruiker (Meest simpele is de user id key hiervoor te gebruiken aangezien deze uniek is. Username kan ook, aangezien deze ook uniek is, echter is dit niet future proof. Stel dat in een latere versie gebruikers hun account kunnen wissen en iemand anders een eerder gewiste username opnieuw aanmaakt. WAt voor effect heeft dit op de database? ID key is altijd uniek en auto increment dus kan nooit hergebruikt worden, duidelijk een veiliger en logischer keuze.)

Een invoerpagina. Deze invoerpagina moet een prepared SQL statement uitvoeren op de advertenties database met een insert into.
Dit moet alleen mogelijk zijn als de gebruiker ingelogd is, aangezien we alleen willen dat ingelogde/geregistreerde gebruikers advertenties plaatsen (Vanwege de koppeling met de user id). Er moet dus een sessie check komen met loggedin = true. 

Stap 1 is een correcte tabel aanmaken in de database met foreign key constraints.

------------------

10:50: Tabel aangemaakt met naam, prijs, id (primary key auto increment) en foreign key die verwijst naar user id in tabel users.
Volgende stap is het aanmaken van het invoerveld. Hiervoor kan de HTML code van het registratie formulier grotendeels worden hergebruikt.

11:30: Na overleg met Mike advertentie invoer veld tijdelijk opzij gezet, eerst meer class functionaliteit leren.

---------

2/11
Veel tutorials over OOP en gebruik van classes gekeken en gelezen, een aantal mini oefeningen gemaakt en geupload (zie github), echter de integratie van geheel class-based OOP in het huidige marktplaats project is nog niet gerealiseerd. Dit zou een complete rewrite vereisen. De huidige OOP-stijl gepushte versie gebruikt wel al de OOP manier van schrijven maar nog geen classes. De oefeningen die ik in de afgelopen dagen heb geupload tonen hopelijk voldoende aan dat er een redelijk begrip en beheersing van class-based OOP aanwezig is, in de komende 7 uur zal ik proberen voor zo ver mogelijk (aspecten van) het marktplaats project te herschrijven.

----------

10:20
Verder onderzoek blijft aantonen dat het gebruik van classes bij bijvoorbeeld een inlog/registratie systeem weinig tot geen toegevoegde waarde heeft aangezien het losse stukken code zijn die nergens worden hergebruikt en relatief klein zijn. Naar aanleiding hiervan heb ik besloten me meer te richten op onderzoeken of bijvoorbeeld de zoekfunctie wel met classes kan worden verbeterd danwel herschreven.